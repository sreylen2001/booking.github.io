<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\DB;


class ApiRegionController extends Controller
{
    //API Get list
    public function list(Request $request)
    {
        $region_query = DB::table('regions');
        if($request->keyword){
            $region_query->where('region_name', 'LIKE', '%'.$request->keyword.'%');
            
        }
        if($request->sortBy && in_array($request->sortBy, ['id', 'created_at'])){
            $sortBy = $request -> sortBy;
        }else{
            $sortBy = 'id';
        }

        if($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])){
            $sortOrder = $request -> sortOrder;
        }else{
            $sortOrder = 'desc';
        }
        if($request->perPage){
            $perPage = $request -> perPage;
        }else{
            $perPage = 5;
        }

        if($request->paginate){
            $region_list = $region_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $region_list = $region_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Region successfully fetched!',
            'data' => $region_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $region = Region::where('id', $id)->first();

        if($region){
            return response()->json([
                'message' => 'Region successfully fetched!',
                'data' => $region
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}
