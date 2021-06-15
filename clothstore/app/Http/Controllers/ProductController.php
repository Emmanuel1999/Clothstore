    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        return response()->json([
            'status' => true
        ]);
    }

    public function create(Request $request){
        /**
         * Function to create a product 
         */
        $this->validate($request,[
            'admins_id'=>'required',
            'name'=>'required',
            'category_id'=>'required',
            'brand'=>'required',
            'description'=>'required',
            'amount'=>'required',
            'availability' => 'required',

        ]);

        $product = new Product;
        $product->admins_id = $request->admins_id;
        $product->name = $request->name;   
        $product->category_id = $request->category_id;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->amount = $request->amount;
        $product->availability = $request->availability;
        
        $product -> save();

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
        
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        /**
         * Function to update a Product
         */
        $product->admins_id = $request->admins_id;
        $product->name = $request->name;   
        $product->category_id = $request->category_id;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->amount = $request->amount;
        $product->availability = $request->availability;
        
        $product->save();

        return response()->json([
            'status' => true,
            'success' => 'Updated Successfully',
            'data' => $product
        ]);
    } 

    public function getSingleProduct($id){
        $product = Product::find($id);

        /**
         * Function to get a Single Product in
         * the database
         */

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    public function getAllProduct(){
        /**
         * Function to get all Products in
         * the database
         */
        return response()->json([
            'status' => true,
            'data' => Product::all()
        ]);
    }

    public function getCategory($id){
        /**
         * Function to get the products under a particular 
         *  category
         */
        $product = Category::find($id)->product;

        foreach($product as $product) {
            return response()->json([
                'status' => true,
                'data' => $product
            ]);
        }
    }
  
    public function delete($id){
        /**
         * Function  to delete a single product in a database
         */
        $product = Product::findorfail($id)->delete();

        return response()->json([
            'status' => true,
            'success' => 'Deleted Successfully'
        ], 200);
    }

    public function deleteAll(){
        /**
         * Function  to delete a multiple products in a database
         */
        $product = Product::findorfail()->delete();

        return response()->json([
            'status' => true,
            'success' => 'Multiple Products Deleted Successfully!'
        ], 200);
    }

    public function topproduct(){
        /**
         * Function to get the top 10 most ordered products
         */
        $product = Product::where('status', 1)->orderBy('amount', 'desc')->take(10);

        return response()->json([
            'status' => true,
            'data' => $product
        ]);

    }
}
