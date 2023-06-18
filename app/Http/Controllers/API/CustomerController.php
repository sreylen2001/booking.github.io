<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $data['customers'] = DB::table('customers')->where('status', '1')->paginate(5);
        return view('admins.admin_customers.index', $data);
        
    }
    public function create(){
        $data['customers'] = DB::table('customers')->get();
        return view('admins.admin_customers.create', $data);
    }

    public function save(Request $request){

        $data['id'] = $request->id;
        $data['user_id'] = Auth::user()->id;
        $data['name'] = $request->name;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['nationality'] = $request->nationality;

        $i = DB::table('customers')->insert($data);

        if($i){
            return redirect()->route('admin.admin_customer');
        }else{
            return redirect()->route('admin_customer.create');
        }
    }

    public function edit($id){
        $data['customers'] = DB::table('customers')->find($id);
        return view('admins.admin_customers.edit', $data);
    }
    
    public function update(Request $request){
        $data['name'] = $request->name;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['nationality'] = $request->nationality;

        $i = DB::table('customers')->where('id', $request->id)->update($data);
        if($i){
            session()->flash('message', ['success', 'Customer information is updated successfully!']);
            return redirect()->route('admin.admin_customer');
        }else{
            session()->flash('message', ['error', 'Customer information is updated Fail!']);
        }
    }

    public function delete($id){

        $affected = DB::table('customers')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_customer');
        }
    }
}
