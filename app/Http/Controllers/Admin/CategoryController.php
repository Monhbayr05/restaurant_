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
        ]);
        Category::query()->create([
            'name'=>$validatedData['name'],
            'restaurant_id'=>$validatedData['restaurant_id'],
        ]);
        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
        ]);
        Category::query()->find($id)->update([
            'name'=>$validatedData['name'],
            'restaurant_id'=>$validatedData['restaurant_id'],
        ]);
        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $categories=Category::query()->find($id);
        if($categories){
            $categories->delete();
            return redirect()->route('admin.category.index')
                ->with('success', 'Category deleted successfully.');
        }
        else{
            return redirect()->route('admin.category.index')
                ->with('error', 'Category not found.');
        }
    }
}
