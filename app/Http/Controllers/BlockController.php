<?php

namespace App\Http\Controllers;

use App\Models\block;
use App\Models\site_plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    //

    public function getList()
    {
        try {

            $data = block::select(
                'blocks.*',
                'stalls.*',
            )
            ->join('stalls','stalls.id','blocks.stall_size_id')
            ->get();

            return response()->json([
                'success' => true,
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


    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $data['arr_index'] = json_encode($request->arr_index);
            // dd($data);

            // unset($data['arr_site_plan']);
            // $data['tennant_member_id'] = auth()->user()->id;
            $create = block::create($data);
            // site_plan::whereIn('id', $request->arr_site_plan)
            // ->update([
            //     'block_id' => $create->id,
            // ]);

            // for ($i = 1; $i <= $count_site_plan; $i++) {
            //     $arr_obj[] = [
            //         'site_id' => $create->id,
            //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     ];
            // }

            // $create_site_plan = site_plan::insert($arr_obj);

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

    public function getByid($id)
    {
        try {

            $data = block::select(
                'blocks.block_name',
                'blocks.id',
                'blocks.stall_size_id',
                'blocks.status',
                'blocks.site_id',
                'blocks.tennant_member_id'
            )
                ->where([
                    ['blocks.is_delete', 0],
                    ['blocks.id', $id]
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

    public function getDetail($id)
    {
        try {

            $admin = block::select(
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
            $data = $request->all();
            block::where('id', $request->id)->update($data);
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
            $update = block::where('id', $id)->update(['status' => request()->status]);
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
            block::where('id', $id)->update(['is_delete' => 1]);
            // site_plan::where('block_id',$id)->update(['block_id'=> null ]);
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

    public function deleteAll()
    {
        try {
            DB::beginTransaction();
            block::where('site_id',  request()->id)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 3);
                })
                ->update(['is_delete' => 1]);
            // $blocks = Block::where('site_id', 1)
            //     ->orWhere('status', 0)
            //     ->orWhere('status', 3)
            //     ->get();

            // dd($blocks);

            // foreach ($blocks as $block) {
            //     $block->is_delete = 1;
            //     $block->save();
            // }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "delete all success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getListToCreateStore(){
        try {

            $data = block::select(
                'blocks.id',
                'blocks.block_name',
            )
            // ->leftJoin('store_block_lists','store_block_lists.block_id','')
            ->leftJoin('store_block_lists', function ($join) {
                $join->on('store_block_lists.block_id', '=', 'blocks.id')
                    ->where('store_block_lists.is_delete', '=', '0');
            })
            ->where([
                ['blocks.tennant_member_id',request()->tennant_member_id],
                ['blocks.is_delete',0],
            ])
            ->whereRaw('store_block_lists.id IS NULL')
            ->get();

            return response()->json([
                'success' => true,
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
}
