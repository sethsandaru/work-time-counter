<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/19/2019
 * Time: 8:42 PM
 */

namespace App\Http\Controllers;

use App\Models\CounterLogEloquent;

class HomeController extends Controller
{
    const LIMIT = 15;

    public function index() {
        $notes = CounterLogEloquent::query()->orderBy('id', 'DESC')->paginate(static::LIMIT);

        return view('pages.index', [
            'notes' => $notes
        ]);
    }
}