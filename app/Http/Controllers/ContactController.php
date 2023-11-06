<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function getList()
    {
        try {

            // $page = request()->page ? request()->page : 1;
            // $size = request()->size ? request()->size : 8;
            // $search = request()->search ? request()->search : "";

            // $offset = $this->calSkip($page, $size);

            $data = contact::select(
                'contacts.*',
                'contacts.updated_at as updated_date',
                'admins.name as user_edit_name'
            )
                ->join('admins', 'admins.id', 'contacts.user_edit')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data[0],
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

            $validator = Validator::make($request->all(), [
                // 'pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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
                $path = 'upload/images/contact/' . $picture;

                $directory = public_path('upload/images/contact');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0775, true);
                }

                Image::make($pic_from_request)->save(public_path($path));

                $data['pic'] = $picture;
                $data['pic_path'] = $path;
            }

            $data['user_edit'] = auth()->user()->id;
            $create = contact::create($data);

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


    public function update(Request $request){
        try{
            DB::beginTransaction();

                $validator = Validator::make($request->all(), [
                    // 'pic' => 'image|mimes:jpg,jpeg,png|max:2048',
                    // 'title_thai' => 'string|max:255',
                    // 'title_eng' => 'string|max:255',
                    // 'description_thai' => 'string',
                    // 'description_eng' => 'string',
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
                    $path = 'upload/images/contact/' . $picture;

                    $directory = public_path('upload/images/contact');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                $create = contact::where('id',$request->id)->update($data);


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
}
