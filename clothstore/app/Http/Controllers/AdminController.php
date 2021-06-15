<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        
            $admin = new Admin;
            
            $admin->name = $request->name;
            $admin->contact = $request->contact;
            $admin->email = $request->email;
            $admin->password = $request->password;

            $admin -> save();

            return response()->json([
                'status' => true,
                'success' => 'Created Successfully',
                'data' => $admin
            ]);
    }

    public function update(Request $request, $id){
        $admin = Admin::find($id);

        $admin->name = $request->name;
        $admin->contact = $request->contact;
        $admin->password = $request->password;

        $admin -> save();

        return response()->json([
            'status' => true,
            'success' => 'Updated Successfully',
            'data' => $admin
        ]);

    }

    public function getSingleAdmin($id){
        $admin = Admin::find($id);

        return response()->json([
            'status' => true,
            'data' => $admin
        ]);
    }

    public function getAllAdmin(){
        
        return response()->json([
            'status' => true,
            'data' => Admin::all()
        ]);
    }

    public function destroy($id){
        $admin = Admin::findorfail($id)->delete();

        return response()->json([
            'status' => true,
            'success' => 'Deleted Successully',
            
        ], 200);
    }

}