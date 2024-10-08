<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index(){
        $products = Product::query()->orderBy('name', 'asc')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    // Store a newly created product
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|unique:products|string|max:100',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_limit' => 'required|integer|min:0',
        ]);

        // Handling thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products/thumbnail', $filename);

            $validatedData['thumbnail'] = 'uploads/products/thumbnail' . $filename;
        }else{
            $validatedData['thumbnail'] = null;
        }


        $product = Product::query()->create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'thumbnail' => $validatedData['thumbnail'],
            'quantity_limit' => $validatedData['quantity_limit'],
            'status' => $request->input('status', 0), // Default status is 0 if not provided
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/images';

            $i = 1;
            foreach($requests->hasFile('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $fileName = time() . $i++ . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $fileName;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect()->route('admin.product.index')
            ->with('success', 'Product created successfully');
    }

    public function image($id)
    {
        $product = Product::query()->findOrFail($id);
        return view('admin.product.image', compact('product'));
    }

    public function storeImage(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/images/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Image Deleted successfully.');
    }

    public function imageDestroy($id)
    {
        $image = ProductImage::query()->findOrFail($id);
        if(File::exists($image->image))
        {
            File::delete($image->image);
        }
        $image->delete();
        return redirect()->back()->with('message','Image deleted successfully.');
    }

    // Show the form for editing the specified product
    public function edit($id){
        $product = Product::query()->findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    // Update the specified product
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,' . $id . '|string|max:100',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_limit' => 'required|integer|min:0',
        ]);

        $product = Product::query()->findOrFail($id);

        // Handle thumbnail upload if there's a new one
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $product->update(['thumbnail' => $path]);
        }

        $product->update([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'quantity_limit' => $validatedData['quantity_limit'],
            'status' => $request->input('status', 0), // Default status is 0 if not provided
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Product updated successfully');
    }

    // Remove the specified product
    public function destroy($id){
        $product = Product::query()->find($id);

        if ($product) {
            $product->delete();
            return redirect()->route('admin.product.index')
                ->with('success', 'Product deleted successfully');
        }

        return redirect()->route('admin.product.index')
            ->with('error', 'Product not found');
    }
}
