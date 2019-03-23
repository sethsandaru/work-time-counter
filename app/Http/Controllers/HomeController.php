<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/19/2019
 * Time: 8:42 PM
 */

namespace App\Http\Controllers;

use App\Libraries\AssetManager;
use App\Repositories\CounterLogRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const LIMIT = 15;

    public function index(Request $rq) {
        $data = $rq->all();

        // retrieve
        $repo = new CounterLogRepository();
        $notes = $repo->getList($data, static::LIMIT);

        //return view
        AssetManager::addJs(asset('js/pages/index.js'));

        return view('pages.index', [
            'notes' => $notes
        ]);
    }
}