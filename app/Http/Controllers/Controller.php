<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function returnJson($data = []) {
        return response()->json($data);
    }

    protected function ajaxSuccess($data = '') {
        return $this->returnJson([
            'code' => 200,
            'message' => $data
        ]);
    }

    protected function ajaxFailed($data = '', $code = 400) {
        return $this->returnJson([
            'code' => $code,
            'message' => $data
        ]);
    }
}
