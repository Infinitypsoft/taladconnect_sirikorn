<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function getList()
    {
        try {
            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 10;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page, $size);

            $data = Admin::select(
                'admins.*',
                'created_at as created_date',

                DB::raw('IF(dashboard_view_report = 1, 1, 0) as title_dashboard'),
                DB::raw('IF(
                    manage_request_view_request = 1 OR
                    manage_request_change_status = 1, 1, 0) as title_manage_request'),
                DB::raw('IF(
                    manage_rental_view_rental = 1 OR
                    manage_rental_view_report = 1, 1, 0) as title_manage_rental'),
                DB::raw('IF(
                    tenant_member_view_tenant = 1 OR
                    tenant_member_add_tenant = 1 OR
                    tenant_member_edit_tenant = 1 OR
                    tenant_member_publicize_shop = 1, 1, 0) as title_tenant_member'),
                DB::raw('IF(
                    manage_user_view_user = 1 OR
                    manage_user_add_user = 1 OR
                    manage_user_edit_user = 1, 1, 0) as title_manage_user'),
                DB::raw('IF(manage_market_view_market = 1, 1, 0) as title_manage_market'),
                DB::raw('IF(
                    manage_seo = 1 OR
                    manage_slide_cover = 1 OR
                    manage_article = 1 OR
                    manage_contact = 1 OR
                    manage_review = 1 OR
                    manage_gallery = 1 OR
                    manage_reward_standard = 1, 1, 0) as title_manage'),

            )
                ->where([
                    ['is_delete', 0],
                    ['id', '!=', auth()->user()->id]
                ])
                ->whereRaw('(name LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = Admin::select('*')
                ->where([
                    ['is_delete', 0],
                    ['id', '!=', auth()->user()->id]
                ])
                ->whereRaw('(name LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%" )')
                ->get()
                ->count();

            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
                'message' => "get data success!"
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            $check = Admin::where([
                ['is_delete', 0],
                ['tel', $request->tel]
            ])->first();
            if ($check) {
                return response()->json([
                    'success' => false,
                    'message' => "เบอร์โทรศัพท์ นี้ถูกใช้งานแล้ว"
                ], 200);
            }

            $validator = Validator::make($request->all(), [
                'pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'name' => 'required|string|max:255',
                // 'email' => 'required|string|email|max:255',
                'tel' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $data = $request->all();

            unset($data['pic']);
            if ($request->hasFile('pic')) {
                $pic_from_request = $request->file('pic');
                $picture = time() . $pic_from_request->getClientOriginalName();
                $path = 'upload/images/admin/' . $picture;

                $directory = public_path('upload/images/admin');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0775, true);
                }

                Image::make($pic_from_request)->save(public_path($path));

                $data['pic'] = $picture;
                $data['pic_path'] = $path;
            }

            $data['password'] = Hash::make($request->password);

            $create = Admin::create($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "create data success!"
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getById($id)
    {
        try {

            $admin = Admin::select(
                '*'
            )
                ->where([
                    ['is_delete', 0],
                    ['id', $id]
                ])
                ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $admin
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        try {

            $admin = Admin::select(
                '*'
            )
                ->where([
                    ['is_delete', 0],
                    ['id', $id]
                ])
                ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $admin
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();


            $check = Admin::where([
                ['is_delete', 0],
                ['tel', $request->tel],
                ['id', '!=', $request->id]
            ])->first();
            if ($check) {
                return response()->json([
                    'success' => false,
                    'message' => "tel นี้ถูกใช้งานแล้ว"
                ], 200);
            }

            $validator = Validator::make($request->all(), [
                // 'pic' => 'image|mimes:jpg,jpeg,png|max:2048',
                // 'name' => 'required|string|max:255',
                // 'email' => 'required|string|email|max:255',
                // 'tel' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $data = $request->all();
            unset($data['pic']);
            if ($request->hasFile('pic')) {
                $pic_from_request = $request->file('pic');
                $picture = time() . $pic_from_request->getClientOriginalName();
                $path = 'upload/images/admin/' . $picture;

                $directory = public_path('upload/images/admin');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0775, true);
                }

                Image::make($pic_from_request)->save(public_path($path));

                $data['pic'] = $picture;
                $data['pic_path'] = $path;
            }

            if($request->password){
                $data['password'] = Hash::make($request->password);
            }

            $create = Admin::where('id', $request->id)->update($data);


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update data success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateStatus($id)
    {
        try {
            DB::beginTransaction();

            $update = Admin::where('id', $id)->update(['status' => request()->status]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update status success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $update = Admin::where('id', $id)->update(['is_delete' => 1]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "delete success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8'
            ]);

            // $admin = Admin::where('id', $request->id)->first();
            if ($validator->fails() === True) {
                return response()->json(['success' => false, 'message' => "รหัสผ่านไม่ถูกต้อง!"], 200);
            }
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $update = Admin::where('id', $request->id)->update($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "change password success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
