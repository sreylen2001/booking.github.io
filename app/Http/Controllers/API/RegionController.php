<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $regions = Region::where('status', '1')->paginate(5);
        return view('admins.regions.city_list', compact('regions'));
    }

    public function create(){
        $data['regions'] = DB::table('regions')->get();
        return view('admins.regions.add_region', $data);
    }
 
    public function save(Request $request){
        $this->region_validation($request);

        $region_name = $request->get('region_name');

        $insertRegion = [
            'region_name' => $region_name,
        ];
        //dd($insertRegion);
        $i = DB::table('regions')->insert($insertRegion);

        if($i){
            Session::flash('msg', 'Region Register Successfully!');
            return redirect()->route('admin.admin_region');
        }else{
            return redirect()->route('admin_region.create');
        }
    }

    public function region_validation(Request $request){
        $rules = [
            'region_name' => 'required'
        ];
    }

    public function edit($id){
        $data['regions'] = DB::table('regions')->find($id);
        return view('admins.regions.city_edit', $data);
    }
    
    public function update(Request $request){
        $data['region_name'] = $request->region_name;

        $i = DB::table('regions')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Region information is updated successfully!']);
            return redirect()->route('admin.admin_region');
        }else{
            session()->flash('message', ['error', 'Region information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('regions')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_region');
        }
    }
}
