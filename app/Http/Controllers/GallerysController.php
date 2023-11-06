<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gallery_infos;
use App\Models\gallerys;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class GallerysController extends Controller
{
    //

    public function getList()
    {
        try {
            $data = gallerys::select(
                'gallerys.id',
                'gallerys.pic',
                'gallerys.pic_path',
                'gallerys.updated_at as updated_date',
            )
                ->get();

            $data_info = gallery_infos::select(
                'gallery_infos.id',
                'gallery_infos.title_thai',
                'gallery_infos.title_eng',
                'gallery_infos.description_thai',
                'gallery_infos.description_eng',
                'gallery_infos.updated_at as updated_date',
                'admins.name as user_edit_name'
            )
                ->join('admins', 'admins.id', 'gallery_infos.user_edit')
                ->get();

            return response()->json([
                'success' => true,
                'data_info' => $data_info[0],
                'data' => $data,
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

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                // 'pic' => 'image|mimes:jpg,jpeg,png|max:2048',
                'title_thai' => 'string|max:255',
                'title_eng' => 'string|max:255',
                'description_thai' => 'string',
                'description_eng' => 'string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $data = $request->all();
            $pic_ids = $request->input('pic_ids');
            if (isset($pic_ids)) {
                $pics = $request->file('pics');

                if (count($pic_ids) !== count($pics)) {
                    return response()->json(['message' => 'Number of IDs and images do not match.'], 400);
                }

                $gallery_data['user_edit'] = auth()->user()->id;

                foreach ($pic_ids as $index => $pic_id) {
                    $new_pic = $pics[$index];
                    if ($new_pic) {
                        $picture = time() . $new_pic->getClientOriginalName();
                        $path = 'upload/images/gallery/' . $picture;

                        $directory = public_path('upload/images/gallery');
                        if (!File::exists($directory)) {
                            File::makeDirectory($directory, 0775, true);
                        }
                        Image::make($new_pic)->save(public_path($path));

                        $gallery_data['pic'] = $picture;
                        $gallery_data['pic_path'] = $path;

                        $create = gallerys::where('id', $pic_id)->update($gallery_data);
                    }
                }
            }

            $gallery_info_data = [
                'title_thai' => $data['title_thai'],
                'title_eng' => $data['title_eng'],
                'description_thai' => $data['description_thai'],
                'description_eng' => $data['description_eng'],
                'user_edit' => auth()->user()->id,
            ];

            $create = gallery_infos::where('id', $request->info_id)->update($gallery_info_data);


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
