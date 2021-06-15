<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true
        ]);
    }

    public function create(Request $request){
        /**
         * Function creates new Category.
         */
        $this->validate($request,[

            'admins_id' => 'required',
            'Name'=>'required',
        ]);

        $category = new Category;

        $category->admins_id = $request->admins_id;
        $category->Name =$request->Name;
        
        $category->save();

        return response()->json([
            'status' => true,
            'success' => 'Created Successfully',
            'data' => $category
        ]);

        
        }
    

    public function getCategoryProducts(Request $Request, $id)
        {
            /**
             * Get the products under the category
             */
            $category = Category::find($id);
            $category_products = $category->products->where('category_id', $id)->get();


        }

        public function category(){
            return response()->json([
                'status' => true,
                'data' => Category::all()
            ]);
        }
    
        public function SingleCategory($id){
            /**
             * Function to get a single category
             */
            $category = Category::find($id);
    
            return response()->json([
                'status' => true,
                'data' => $category
            ]);
        }

        public function update(Request $request, $id){
            /**
             * Function to update Category
             */
            $category = Category::find($id);
                
            $category->admins_id = $request->admins_id;
            $category->Name =$request->Name;
                
                $category -> save();
    
                return response()->json([
                    'status' => true,
                    'success' => 'update successful',
                    'data' => $category
                ]);
        }
      
        public function destroy($id){
            /**
             * Function to delete a Particular 
             * category
             */
            Category::findorfail($id)->delete();
    
            return response()->json([
                'status' => true,
                'success' => 'Deleted Successfully'
            ], 200);
        }
    

}
       
