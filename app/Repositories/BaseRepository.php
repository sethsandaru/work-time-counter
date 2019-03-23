<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/23/2019
 * Time: 11:17 AM
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract protected function baseSource() : string;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getQuery() {
        /**
         * @var Model $eloquent
         */
        $eloquent = $this->baseSource();
        return $eloquent::query();
    }
}