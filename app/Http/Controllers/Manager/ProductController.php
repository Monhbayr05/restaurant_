<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('category', function ($query) {
           $query->where('restaurant_id', Auth::user()->restaurant_id);
        })->get();

        return view('manager.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('restaurant_id', Auth::user()->restaurant_id)->get();

        return view('manager.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' =>'nullable',
            'quantity_limit' => 'required',
        ]);


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products/thumbnail/', $filename);

            $validatedData['thumbnail'] = 'uploads/products/thumbnail/' . $filename;
        } else {
            $validatedData['thumbnail'] = null;
        }


        $products = Product::query()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'thumbnail' => $validatedData['thumbnail'],
            'quantity_limit' => $validatedData['quantity_limit'],
            'status' =>$request->status == true ? 1 : 0,
        ]);

        return redirect()->route('manager.product.index')
            ->with('success', 'Бүтээгдэхүүн амжилттай үүслээ.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);

        return view('manager.product.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'quantity_limit' => 'required',
        ]);

        $product = Product::findOrFail($id);


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products/thumbnail', $filename);

            $validatedData['thumbnail'] = 'uploads/products/thumbnail/' . $filename;
        } else {
            $validatedData['thumbnail'] = $product->thumbnail;
        }


        $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'thumbnail' => $validatedData['thumbnail'],
            'quantity_limit' => $validatedData['quantity_limit'],
            'status' => $request->status == true ? 1 : 0,
        ]);


        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/images';


            foreach ($product->productImages as $image) {
                $image->delete();
            }

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $fileName = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $fileName);
                $finalImagePathName = $uploadPath . '/' . $fileName;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect()->route('manager.product.index')
            ->with('success', 'Бүтээгдэхүүн амжилттай шинэчлэгдлээ.');
    }


    public function image($id)
    {
        $product = Product::query()->findOrFail($id);
//        dd($product);
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

        return redirect()->back()->with('success', 'Зураг амжилттай байршлаа.');
    }


    public function imageDestroy($id)
    {
        $image = ProductImage::query()->findOrFail($id);

        if (File::exists($image->image)) {
            File::delete($image->image);
        }

        $image->delete();

        return redirect()->back()->with('delete', 'Зураг амжилттай устлаа.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
                $image->delete();
            }
        }

        $product->delete();

        return redirect()->route('manager.product.index')->with('delete', 'Бүтээгдэхүүн болон бүх зураг амжилттай устгагдлаа.');
    }
}
