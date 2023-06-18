<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;


class ApiDestinationController extends Controller
{
    //API Get list
    public function list(Request $request)
    {
        $destination_query = DB::table('destinations');
        if($request->keyword){
            $destination_query->where('destination_name', 'LIKE', '%'.$request->keyword.'%');
            
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
            $destination_list = $destination_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $destination_list = $destination_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Destination_name successfully fetched!',
            'data' => $destination_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $destination = Destination::where('id', $id)->first();

        if($destination){
            return response()->json([
                'message' => 'Destination successfully fetched!',
                'data' => $destination
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}
