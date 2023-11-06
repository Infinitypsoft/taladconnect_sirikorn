<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Zg_access_log;
use App\Models\Zg_admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    // public function register(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'admin_email' => 'required|string|email|max:255',
    //         'admin_password' => 'required|string|min:8'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()
    //         ]);
    //     }

    //     $check = Zg_admin::where([['is_delete',0],['admin_email',$request->admin_email]])->first();
    //     if($check){
    //         return response()->json([
    //             'success' => false,
    //             'message' => "email นี้ถูกใช้งานแล้ว"
    //         ], 200);
    //     }



    //     $admin = Zg_admin::create([
    //         'admin_email' => $request->admin_email,
    //         'admin_password' => Hash::make($request->admin_password),
    //         'role' => 0 ,
    //     ]);

    //     $token = $admin->createToken('auth_token')->plainTextToken;

    //     $this->createAdminAccssLog([
    //         'admin_id' => $admin->id,
    //         'log_ip' => $request->ip(),
    //         'log_detail' => "สมัครสมาชิก",
    //     ]);

    //     Zg_admin::where('id',$admin->id)->update([
    //         'last_login' => Carbon::now()->format('Y-m-d H:i:s')
    //     ]);

    //     return response()
    //         ->json([
    //             'success' => true,
    //             'data' => $admin,
    //             'access_token' => $token,
    //         ]);
    // }

    // public function login(Request $request)
    // {
        
    // }

    public function login(Request $request)
    {

        $admin = Admin::where('tel', $request['tel'])->where('is_delete',0)->first();

        if (! ( $admin && Hash::check($request->password, $admin->password) === true ) ) {
            return response()->json(['success'=>false,'message' => 'Unauthorized'], 401);
        } else {

            $admin = Admin::where('tel', $request['tel'])->where('is_delete',0)->first();

            if ($admin->status == false) {
                return response()->json(['message' => 'Your Account is Not Activated. Please Contact To Administrator'], 401);
            }

            $token = $admin->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Hi ' . $admin->name . ', welcome to home',
                'access_token' => $token,
                'role' => $admin->role,
            ]);
        }
    }

    // public function logout()
    // {
    //     auth()->user()->tokens()->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'You have successfully logged out and the token was successfully deleted'
    //     ]);
    // }

}
