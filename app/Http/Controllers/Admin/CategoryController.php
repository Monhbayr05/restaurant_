<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $categories = Category::query()->orderBy('id')->get();
        return view('admin.category.index', compact('categories', 'restaurants'));
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
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

        Category::query()->create([
            'name' => $validatedData['name'],
            'restaurant_id' => $validatedData['restaurant_id'],
            'thumbnail' => $validatedData['thumbnail'],
        ]);
        return redirect()->route('admin.category.index')
            ->with('success', 'Категори амжилттай үүслээ.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
        ]);

        $category_id = decrypt($id);
        $category = Category::query()->find($category_id);

        $category->update([
            'name' => $validatedData['name'],
            'restaurant_id' => $validatedData['restaurant_id'],
        ]);
        return redirect()->route('admin.category.index')
            ->with('success', 'Категори амжилттай шинэчлэгдлээ.');
    }

    public function destroy($id)
    {
        $category = Category::query()->find($id);
        if ($category)
        {
            $category->delete();
            return redirect()->route('admin.category.index')
            ->with('delete', 'Категори амжилттай устлаа.');
        }
        else {
            return redirect()->route('admin.category.index')
                ->with('error', 'Категори олдсонгүй.');
        }
    }
}
