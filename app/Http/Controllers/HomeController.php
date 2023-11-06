<?php

namespace App\Http\Controllers;

use App\Models\block;
use App\Models\content;
use App\Models\review;
use App\Models\site;
use App\Models\stall;
use App\Models\store;
use App\Models\store_recommen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {

        try {
            $content = content::select(
                'contents.id',
                'contents.title_thai',
                'contents.sub_title_thai',
                'contents.description_thai',
                'contents.title_eng',
                'contents.sub_title_eng',
                'contents.description_eng',
                'contents.pic_path',
                'contents.created_at'
            )->where([
                ['contents.status',1],
                ['contents.is_delete',0]
            ])
            ->limit(5)
            ->get();

            $stall_size = stall::select(
                'name',
                'pic_path',
                'size_w',
                'size_h',
                'color_stall',
                'color_table'
            )
            ->where([
                ['is_delete',0],
                ['status',1]
            ])
            ->get();

            $site = site::select(
                'id',
                'site_name'
            )
            ->where([
                ['is_delete',0],
            ])
            ->get();

            $review = review::select(
                'id',
                'name',
                'rating',
                'comment'
            )
            ->where([
                ['is_delete',0],
                ['review_approval',1],
                ['review_type',0]
            ])
            ->paginate(1);

            $store_recommen = store_recommen::select('stores.id','stores.store_name','stores.created_at','stores.pic_path')->join('stores','stores.id','store_recommens.store_id')->get();

            return view('frontend.home',compact('content','stall_size','site','review','store_recommen'));
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->route('home');
        }
    }

    public function getSiteById($id){
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

                'stalls.id as stall_id',
                'stalls.color_stall',
                'stalls.color_table',
                'stalls.cost_rental_rate',
                'stalls.cost_common_rate',
                'stalls.name',
                'blocks.status',
                'blocks.detail',
                'blocks.arr_index',
                DB::raw('(SELECT GROUP_CONCAT(id) FROM blocks AS bl WHERE bl.site_id = blocks.site_id AND bl.tennant_member_id = blocks.tennant_member_id HAVING COUNT(*) > 1) as other_block'),
                DB::raw('(
                    SELECT store_block_lists.store_id
                    FROM store_block_lists
                    JOIN stores ON stores.id = store_block_lists.store_id
                    WHERE store_block_lists.block_id = blocks.id
                    AND store_block_lists.is_delete = 0
                    AND stores.is_delete = 0
                    AND stores.tennant_member_id = blocks.tennant_member_id
                ) as store_id')
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

    public function getListReviewMarket(){

        try {

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 10;

            $offset = $this->calSkip($page, $size);

            $data = review::select(
                'id',
                'name',
                'rating',
                'comment'
            )
            ->where([
                ['is_delete',0],
                ['review_approval',1],
                ['review_type',0]
            ])
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = review::select(
                'id',
                'name',
                'rating',
                'comment'
            )
            ->where([
                ['is_delete',0],
                ['review_approval',1],
                ['review_type',0]
            ])
            ->get()
            ->count();

            return response()->json([
                'success' => true,
                'data'=>$data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
                'message' => "get data success!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function ReviewMarket(Request $request){
        try {
            DB::beginTransaction();
                $data = $request->all();
                unset($data['_token']);
                review::create($data);
            DB::commit();
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('home');
        }
    }

    public function store()
    {
        try {
            $stall_size = stall::select(
                'name',
                'pic_path',
                'size_w',
                'size_h',
                'color_stall',
                'color_table'
            )
            ->where([
                ['is_delete',0],
                ['status',1]
            ])
            ->get();
            $site = site::select('id','site_name')->where([['is_delete',0],]) ->get();
            $store_recommen = store_recommen::select('stores.id','stores.store_name','stores.created_at','stores.pic_path')->join('stores','stores.id','store_recommens.store_id')->get();
            return view('frontend.store',compact('stall_size','store_recommen','site'));
        } catch (\Throwable $th) {

            return redirect()->route('home');
        }
    }

    public function filterStore(Request $request){
        try {

            $store_type = request()->store_type ? request()->store_type : '';
            $product_type = request()->product_type ? request()->product_type : '';
            $price_min = request()->price_min ? request()->price_min : 0 ;
            $price_max = request()->price_max ? request()->price_max : 9999999 ;
            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 10;

            $sort = request()->sort ? request()->sort : "asc";

            $offset = $this->calSkip($page, $size);

            $data = store::select(
                'stores.id',
                'stores.pic_path',
                'stores.product_1_pic_path',
                'stores.product_2_pic_path',
                'stores.product_3_pic_path',
                'stores.product_4_pic_path',
                'stores.store_name',
                'stores.store_type',
                'stores.product_type',
                'stores.description_short',
                'stores.store_name_eng',
                'stores.store_type_eng',
                'stores.product_type_eng',
                'stores.description_short_eng',
                'stores.price_min',
            )
            ->where([
                ['is_delete',0]
            ])
            ->whereRaw('(
                stores.store_type LIKE "%' . $store_type . '%"
                AND stores.product_type LIKE "%' .$product_type . '%"
            )')
            ->whereBetween('price_min', [$price_min, $price_max])
            ->orderBy('id',$sort)
            ->offset($offset)
            ->limit($size)
            ->get();


            $count = store::select(
                'stores.id',
                'stores.pic_path',
                'stores.product_1_pic_path',
                'stores.product_2_pic_path',
                'stores.product_3_pic_path',
                'stores.product_4_pic_path',
                'stores.store_name',
                'stores.store_type',
                'stores.product_type',
                'stores.description_short',
                'stores.store_name_eng',
                'stores.store_type_eng',
                'stores.product_type_eng',
                'stores.description_short_eng',
                'stores.price_min',
            )
            ->where([
                ['is_delete',0]
            ])
            ->whereRaw('(
                stores.store_type LIKE "%' . $store_type . '%"
                AND stores.product_type LIKE "%' .$product_type . '%"
            )')
            ->whereBetween('price_min', [$price_min, $price_max])
            ->orderBy('id',$sort)
            ->get()
            ->count();




            return response()->json([
                'success' => true,
                'data'=>$data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
                'message' => "get data success!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getStoreById($id){
        try {

            $data = store::select(
                'stores.id',
                'stores.pic_path',
                'stores.product_1_pic_path',
                'stores.product_2_pic_path',
                'stores.product_3_pic_path',
                'stores.product_4_pic_path',
                'stores.store_name',
                'stores.store_type',
                'stores.product_type',
                'stores.description_short',
                'stores.store_name_eng',
                'stores.store_type_eng',
                'stores.product_type_eng',
                'stores.description_short_eng',
                'stores.price_min',
            )
            ->where([
                ['stores.is_delete',0],
                ['stores.id',$id]
            ])
            ->first();

            return response()->json([
                'success' => true,
                'data'=>$data,
                'message' => "get data success!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function storeDetail()
    {
        try {

            $store = store::select(
                'id',
                'store_name',
            )
            ->where([
                ['id',request()->store_id],
                ['is_delete',0]
            ])
            ->first();

            // dd(request()->all());
            return view('frontend.store_detail');
        } catch (\Throwable $th) {
            return redirect()->route('home');
        }

    }

    public function new()
    {
        try {

            $search = request()->search ?  request()->search : '' ;

            $content = content::select(
                'contents.id',
                'contents.title_thai',
                'contents.sub_title_thai',
                'contents.description_thai',
                'contents.title_eng',
                'contents.sub_title_eng',
                'contents.description_eng',
                'contents.pic_path',
                'contents.created_at'
            )->where([
                ['contents.status',1],
                ['contents.is_delete',0]
            ])
            ->whereRaw('(
                (
                    contents.title_thai LIKE "%' . $search . '%"
                    OR contents.sub_title_thai LIKE "%' .$search . '%"
                ) OR
                (
                    contents.title_eng LIKE "%' . $search . '%"
                    OR contents.sub_title_eng LIKE "%' .$search . '%"
                )
            )')
            ->paginate(8);

            return view('frontend.new',compact('content','search'));
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->route('home');
        }

    }

    public function newDetail()
    {
        try {

            $content = content::select(
                'contents.*',
            )->where([
                ['contents.status',1],
                ['contents.is_delete',0],
                ['contents.id',request()->id]
            ])
            ->first();


            $other = content::select(
                'contents.id',
                'contents.title_thai',
                'contents.sub_title_thai',
                'contents.description_thai',
                'contents.title_eng',
                'contents.sub_title_eng',
                'contents.description_eng',
                'contents.pic_path',
                'contents.created_at'
            )->where([
                ['contents.status',1],
                ['contents.is_delete',0],
                ['contents.id','!=',request()->id]
            ])
            ->inRandomOrder()
            ->take(4)
            ->get();

            return view('frontend.new_detail',compact('content','other'));
        } catch (\Throwable $th) {
            return redirect()->route('home');
        }

    }

}
