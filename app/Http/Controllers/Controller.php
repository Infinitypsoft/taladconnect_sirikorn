<?php

namespace App\Http\Controllers;

use App\Models\Zg_access_log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    // public function createAdminAccssLog($data){
    //     $create = Zg_access_log::create($data);
    //     return $create;
    // }

    public function calSkip($page, $size) {
        return ($page - 1) * $size;
    }

    public function calPage($count, $size) {
        return ceil($count / $size);
    }



}
