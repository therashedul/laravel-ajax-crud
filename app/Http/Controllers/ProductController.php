<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator ;

// use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsindex()
    {
        $products = Product::latest()->paginate(5);     
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productsstore(Request $request)
    {
           $request->validate([
                'name'=>'required',
                'price'=>'required'
    
            ],[
                'name.required'=>' Name is requeired',
                'price.required'=>' Price is requeired'
           ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->category = $request->category;
        $product->save();
        return response()->json(['status' => "success"]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productsedit(Product $product)
    {
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productsupdate(Request $request, Product $product)
    {
        $request->validate([
                'name'=>'required',
                'price'=>'required'
    
            ],[
                'name.required'=>' Name is requeired',
                'price.required'=>' Price is requeired'
           ]);
        Product::where('id', $request->id)->update([
            "name"=>$request->name,
            "price"=>$request->price,
            "category"=>$request->category,
            "status"=>$request->status,
        ]);
        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productsdestroy(Request $request)
    {
        Product::find($request->id)->delete();
          return response()->json(['status' => "success"]);
    } 
    /**
     * pagination the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productspagination(Request $request)
    {
        $products = Product::latest()->paginate(5);     
        return view('products.pagination-index', compact('products'))->render();
    } 
    public function productssearch(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('price', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(5);
            if ($products->count() >= 1) {
                return view('products.pagination-index', compact('products'))->render();
            } else {
                return response()->json(['status' => "Nothing Found"]);
            }
        }
    }
}