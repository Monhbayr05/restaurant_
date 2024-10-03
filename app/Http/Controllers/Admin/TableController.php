<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    Public function index()
    {
        $restaurants = Restaurant::all();
        $tables = Table::query()->orderby('id')->get();
        return view('admin.table.index', compact('tables', 'restaurants'));
    }
    public function create()
    {
        return view('admin.table.index');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required',
            'restaurant_id'=>'required',
        ]);

        Table::query()->create([
            'name' => $validateData['name'],
            'restaurant_id' => $validateData['restaurant_id'],
        ]);
        return redirect()->route('admin.table.index')
            ->with('success','Table created successfully');
    }
}
