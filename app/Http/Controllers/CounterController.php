<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/19/2019
 * Time: 9:51 PM
 */

namespace App\Http\Controllers;


use App\Models\CounterLogEloquent;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function add() {
        return view('pages.add');
    }

    public function saveAdd(Request $rq) {
        $data = $rq->all();

        $item = new CounterLogEloquent();
        $item->fill($data);
        if ($item->save()) {
            return $this->ajaxSuccess();
        }

        return $this->ajaxFailed();
    }
}