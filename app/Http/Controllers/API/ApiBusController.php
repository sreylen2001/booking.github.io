<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;


class ApiBusController extends Controller
{
    //API Get list
    public function list(Request $request)
    {
        $bus_query = Bus::with('user');

        if($request->keyword){
            $bus_query->where('bus_number', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('bus_plate_number', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('capacity', 'LIKE', '%'.$request->keyword.'%');
            
        }
        
        if($request->user_id){
            $bus_query->where('user_id', $request->user_id);
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
            $bus_list = $bus_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $bus_list = $bus_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Bus successfully fetched!',
            'data' => $bus_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $bus = Bus::with(['user'])->where('id', $id)->first();

        if($bus){
            return response()->json([
                'message' => 'Bus successfully fetched!',
                'data' => $bus
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}
