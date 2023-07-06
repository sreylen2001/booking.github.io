<?php

namespace App\Http\Controllers\Endpoint;

use App\Http\Controllers\Controller;
use App\Models\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpRoleController extends Controller
{
    public function list(Request $request)
    {
        $data['new_roles'] = DB::table('new_roles')->get();
       
        return response()->json([
            'message' => 'Role successfully fetched!',
            'data' => $data
        ], 200);
    }
    public function detail($id)
    {
        $data['new_roles'] = DB::table('new_roles')->where('id', $id)->first();

        if($data){
            return response()->json([
                'message' => 'Role successfully fetched!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}
