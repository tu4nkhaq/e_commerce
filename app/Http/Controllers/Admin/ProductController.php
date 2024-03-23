<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with('category', 'brand','product_images')->get();
        $brands = Brand::get();
        $categories = Categories::get();
        return Inertia::render('Admin/Product/index',['products'=>$products,'brands' => $brands,
        'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        if ($request->hasFile('product_images')) {
            # code...
            $productImages=$request->file('product_images');
            foreach ($productImages as $image){
                $uniqueName=time().'-'.Str::random(10).'.'.$image->getClientoriginalExtension();
                $image->move('product_images',$uniqueName);
                ProductImage::create(['product_id'=>$product->id,'image'=>"product_images/".$uniqueName]);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        // dd($product);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        // Check if product images were uploaded
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');
            // Loop through each uploaded image
            foreach ($productImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public folder with the unique name
                $image->move('product_images', $uniqueName);

                // Create a new product image record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }
        $product->update();
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    public function deleteImage($id)
    {
        $image = ProductImage::where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Image deleted successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
