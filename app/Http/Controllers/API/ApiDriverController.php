<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class ApiDriverController extends Controller
{
    //API Get list
    public function list(Request $request)
    {
        $driver_query = Driver::with('user');

        if($request->keyword){
            $driver_query->where('name', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('contact', 'LIKE', '%'.$request->keyword.'%');
        }

        if($request->user_id){
            $driver_query->where('user_id', $request->user_id);
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
            $driver_list = $driver_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $driver_list = $driver_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Driver successfully fetched!',
            'data' => $driver_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $driver = Driver::with(['user'])->where('id', $id)->first();

        if($driver){
            return response()->json([
                'message' => 'Driver successfully fetched!',
                'data' => $driver
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}
