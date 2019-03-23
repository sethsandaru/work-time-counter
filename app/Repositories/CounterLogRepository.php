<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/23/2019
 * Time: 11:16 AM
 */

namespace App\Repositories;

use App\Models\CounterLogEloquent;

class CounterLogRepository extends BaseRepository
{
    protected function baseSource() : string
    {
        return CounterLogEloquent::class;
    }

    public function getList($data = [], $limit = 10) {
        $query = $this->getQuery();
        $query->orderBy('id', 'DESC');

        $keyword = $data['keyword'] ?? null;
        if (!empty($keyword)) {
            $query->where(function($qr) use ($keyword) {
                $qr->where('title', 'LIKE', '%' . $keyword . '%');
                $qr->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        $date_from = $data['date_from'] ?? null;
        if (!empty($date_from)) {
            $date_from = date_create_from_format('d/m/Y', $date_from);
            $query->whereDate('created_at', '>=', $date_from);
        }

        $date_to = $data['date_to'] ?? null;
        if (!empty($date_to)) {
            $date_to = date_create_from_format('d/m/Y', $date_to);
            $query->where('created_at', '<=', $date_to);
        }

        return $query->paginate($limit);
    }
}