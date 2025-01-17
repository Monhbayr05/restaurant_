<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('restaurant_id', Auth::user()->restaurant_id)->get();

        return view('manager.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'name' => 'required|max:255',
           'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('thumbnail')) {
            $file = request()->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/thumbnail'), $filename);

            $validatedData['thumbnail'] = 'uploads/category/thumbnail/' . $filename;
        } else {
            $validatedData['thumbnail'] = null;
        }

        Category::create([
            'name' => $validatedData['name'],
            'thumbnail' => $validatedData['thumbnail'],
            'restaurant_id' => Auth::user()->restaurant_id,
        ]);
        return redirect()->route('manager.category.index');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->withErrors(['error' => 'Category not found.']);
        }

        if ($request->hasFile('thumbnail')) {
            // Хуучин зургийг устгах
            $destination = $category->thumbnail;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            // Шинэ зургийг хадгалах
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/thumbnail'), $filename);

            $validatedData['thumbnail'] = 'uploads/category/thumbnail/' . $filename;
        } else {
            $validatedData['thumbnail'] = $category->thumbnail; // Хуучин зургаа хадгалах
        }

        // Засвар хийх
        $category->update([
            'name' => $validatedData['name'],
            'thumbnail' => $validatedData['thumbnail'],
            'restaurant_id' => Auth::user()->restaurant_id,
        ]);

        return redirect()->route('manager.category.index');
    }


    public function destroy($id)
    {
        $category = Category::query()->find($id);
        $destination = $category->thumbnail;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $category->delete();
        return redirect()->route('manager.category.index');
    }
}
