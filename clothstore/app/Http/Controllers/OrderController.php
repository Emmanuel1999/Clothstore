<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
        ]);
    }

    public function newOrder(Request $request)
    /**
     * Function to make an Order with single Product or
     * multiple products.
     */
    {
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'order' => 'present|array',
        ]);
            $user = new User;
            $user->name = $request->name;   
            $user->email = $request->email;
            $user->address = $request->address;
            $user->LGA = $request->LGA;
            $user->state = $request->state;
            $user->phone_number = $request->phone_number;
            $user->password = $request->password;

            $user -> save();

           $order = [];
           $collection = collect($request->order);
           $user_orders = $collection->map(function($orders) use ($order, $user) {
               $order = [
                   'users_id' => $user->id,
                   'products_id' => $orders['products_id'],
                   'quantity' => $orders['quantity'],
                    'totalAmount' => $orders['totalAmount'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()

               ];
                     return $order;
           });

            Orders::insert($user_orders->toArray());

               return response()->json([
                   'status' => true,
                   'data' => $user_orders
               ]);
        }



        public function update(Request $request, $id){
            /**
             * Function to update Order status from Pending to
             * Completed or Cancelled
             */
            $order = Orders::find($id);

            $order->quantity = $request->quantity;
            $order->products_id = $request->products_id;
            $order->status = $request->status;
            $order->total = $request->total;
            $order->name = $request->name;   
            $order->email = $request->email;
            $order->address = $request->address;
            $order->LGA = $request->LGA;
            $order->state = $request->state;
            $order->phone_number = $request->phone_number; 
            
            $order->save();

            if ($order->status==0){
                $order -> status = 'Pending';
                    
            }elseif ($order->status==1){
                $order -> status = 'Delivered';
        
            }else ($order->status==2){
                $order -> status = 'Cancelled'
            
            };

            return response()->json([
                'status' => true,
                'success' => 'update successful',
                'data' => $order
            ]);
            
    }
    public function getSingleOrder($id){
        /**
         * Function to get Single Order
         */
        $order = Orders::find($id);

        return response()->json([
            'status' => true,
            'data' => $order
        ]);
    }

    public function getAllOrder(){
        /**
         * Function to fetch all orders
         */
        return response()->json([
            'status' => true,
            'data' => Orders::all()
        ]); 
    }

    public function topOrder(){
        /**
         * This function fetches the highest total amount
         * of orders ordered 
         */
        $order = Orders::where('status', '0')->orderBy('totalAmount', 'desc')->take(10)->get();

        return response()->json([
            'status' => true,
            'data' => $order
        ]);

    }

    public function countOrder()
    /**
     * This function counts the Total, pending, Delivered
     * and Cancelled Orders and return them as a figure.
     */
    {
        $order = Orders:: all();
        $total = $order -> count();
        $pending = $order -> where('status','Pending')-> count();
        $confirmed = $order -> where('status','Delivered')-> count();
        $cancelled = $order -> where('status','Cancelled')-> count();

        return response()->json([
            'status' => true,
            'data' => [$total,$pending,$confirmed,$cancelled]
        ]);
    }

    

    public function moveUser($id)
    /**
     * Useful for replicating User details from orders to the 
     * User details and assigning a ForeignId called User_id to 
     * the Order table.  
     */
    {
        $order = Orders::find($id);
        
       $name = $order->name;
       $email = $order->email;
       $address = $order->address;
       $LGA = $order->LGA;
       $state = $order->state;
       $phone_number = $order->phone_number;

         $order->replicate();
        
        $user = new User;

        $user->name = $name;   
        $user->email = $email;
        $user->address = $address;
        $user->LGA = $LGA;
        $user->state = $state;
        $user->phone_number = $phone_number;

        $user->save();

        return response()->json([
            'status' => true,
            'success' => 'Moved Successfully!',
            'data' => $user
        ]);
    }

    public function orderSummary()
    /**
     * Function to get number of total Orders, pending, 
     * delivered and cancelled also generating the
     * individual sums for each. 
     */
    {
        $order = Orders:: all();
        $total = $order -> count();
        $pending = $order -> where('status','Pending')-> count();
        $confirmed = $order -> where('status','Delivered')-> count();
        $cancelled = $order -> where('status','Cancelled')-> count();
        $totalOrder =$order -> sum('total');
        $pend = $order -> where('status','Pending')->sum('total');
        $confirm = $order -> where('status','Delivered')->sum('total');
        $cancel = $order -> where('status','Cancelled')->sum('total');

        return response()->json([
            'status' => true,
            'data' => [$total,$pending,$confirmed,$cancelled,$totalOrder,$pend,$confirm,$cancel]
        ]);
    }

}



