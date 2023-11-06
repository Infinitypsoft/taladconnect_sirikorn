<?php

namespace App\Http\Controllers;

use App\Models\block;
use App\Models\site;
use App\Models\site_plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    //
    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = site::select(
                'sites.*',
            )
            // ->join('admins','admins.id','sites.user_edit')
            ->where([
                ['sites.is_delete',0],
            ])
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = site::select('*')
            ->where([
                ['is_delete',0]
            ])
            ->get()
            ->count();

            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page'=> $page,
                'pages'=> $this->calPage($count, $size),
                'count_all' => $count,
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

    public function create(Request $request){
        try{
            DB::beginTransaction();

                $data = $request->all();



                $create = site::create($data);

                // $count_site_plan = ( ceil($request->width) * ceil($request->long) ) * 2;

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

    public function getLisite(){
        try{

            $data = site::select(
                'sites.id',
                'sites.site_name'
            )
            ->where([
                ['sites.is_delete',0],
            ])
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

    public function getById($id){
        try{

            $data = site::select(
                'sites.id',
                'sites.site_name',
                'sites.width',
                'sites.long',
            )
            ->where([
                ['sites.is_delete',0],
                ['sites.id',$id]
            ])
            ->first();

            $data['block_list'] = block::select(
                'blocks.id',
                // 'blocks.tennant_member_id',
                DB::raw('(
                    CASE
                            WHEN (
                                    SELECT contract_blocks.tennant_member_id
                                    FROM contract_block_lists
                                    JOIN contract_blocks ON contract_blocks.id = contract_block_lists.contract_block_id
                                    WHERE contract_block_lists.block_id = blocks.id
                                    AND contract_block_lists.is_delete = 0
                                    AND contract_blocks.doc_type = 2
                                    AND contract_blocks.is_delete = 0
                                    LIMIT 1
                            ) IS NOT NULL THEN
                                (
                                    SELECT contract_blocks.tennant_member_id FROM `contract_block_lists`
                                    JOIN contract_blocks ON contract_blocks.id = contract_block_lists.contract_block_id
                                    WHERE contract_block_lists.block_id = blocks.id
                                    AND contract_block_lists.is_delete = 0
                                    AND contract_blocks.doc_type = 2
                                    AND contract_blocks.is_delete = 0
                                    LIMIT 1
                                )
                            ELSE
                                    blocks.tennant_member_id
                    END
                ) as tennant_member_id'),
                'blocks.block_name',
                'blocks.site_id',
                'blocks.stall_size_id',
                // 'sites.color_site',
                // 'sites.color_table',
                // 'stalls.*',

                'stalls.id as stall_id',
                'stalls.color_stall',
                'stalls.color_table',
                'stalls.radio_annual_fee',
                'stalls.annual_fee',
                'stalls.guarantee_service_rate',
                'stalls.guarantee_water_rate',
                'stalls.guarantee_electricity_rate',
                'stalls.guarantee_hood_rate',
                'stalls.cost_rental_rate',
                'stalls.cost_common_rate',
                'stalls.name',
                'blocks.status',
                'blocks.detail',
                'blocks.arr_index',
                DB::raw('(SELECT GROUP_CONCAT(id) FROM blocks AS bl WHERE bl.site_id = blocks.site_id AND bl.tennant_member_id = blocks.tennant_member_id HAVING COUNT(*) > 1) as other_block'),
            )
            ->join('stalls','stalls.id','blocks.stall_size_id')
            // ->join('sites','sites.id','blocks.site_id')
            ->where([
                ['blocks.is_delete',0],
                ['blocks.site_id',$id]
            ])
            ->get();

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

    public function getDetail($id){
        try{

            $admin = site::select(
                '*'
            )
            ->where([
                ['is_delete',0],
                ['id',$id]
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

    public function delete($id){
        try{
            DB::beginTransaction();
                site::where('id',$id)->update(['is_delete'=> 1 ]);
                // site_plan::where('site_id',$id)->update(['is_delete'=> 1 ]);
                block::where('site_id',$id)->update(['is_delete'=> 1 ]);
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

}

