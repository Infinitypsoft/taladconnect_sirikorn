<?php

namespace App\Http\Controllers;

use App\Models\market_setting;
use Illuminate\Http\Request;

class MarketSettingController extends Controller
{
    //

    public function getDetail()
    {
        try {

            $data = market_setting::select(
                '*'
            )
            ->where([
                ['id', 1]
            ])
            ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
