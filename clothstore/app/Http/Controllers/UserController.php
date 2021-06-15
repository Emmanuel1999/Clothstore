<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true
        ]);
    }

    public function create(Request $request)
    /**
     * Function to create a User otherwise called Client
     */
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);
            $user = new User;
            $user->name = $request->name;   
            $user->email = $request->email;
            $user->address = $request->address;
            $user->LGA = $request->LGA;
            $user->state = $request->state;
            $user->phone_number = $request->phone_number;
            $user->password = $request->password;

            $user->save();

            return response()->json([
                'status' => true,
                'success' => 'Created Successfully',
                'data' => $user
            ]);

    }

    public function update(Request $request, $id){
        /**
         * Function to update single user
         *  details in the database
         */
        $user = User::find($id);

        $user->name = $request->name;   
        $user->email = $request->email;
        $user->address = $request->address;
        $user->LGA = $request->LGA;
        $user->state = $request->state;
        $user->phone_number = $request->phone_number; 
        
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully!',
            'data' => $user
        ]);
    }

    public function updateUsers()
    /**
     * Function to Update multiple
     * users in the database
     */
    {
       $user = User::all();

       $user->name = $request->name;
       $user->email = $request->email;
       $user->address = $request->address;
       $user->LGA = $request->LGA;
       $user->state = $request->state;
       $user->phone_number = $request->phone_number;

       $user->save();

       return response()->json([
           'status' => true,
           'message' => 'Multiple Users Updated!',
           'data' => $user
       ]);
        
    }

}
