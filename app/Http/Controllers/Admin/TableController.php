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
        return view('admin.table.index',
            compact('tables', 'restaurants'));
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
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $validateData = $request->validate([
            'name'=>'required',
            'restaurant_id'=>'required',
        ]);
        Table::query()->findOrFail($id)->update([
           'name'=>$validateData['name'],
           'restaurant_id'=>$validateData['restaurant_id'],
        ]);
        return redirect()->route('admin.table.index')
            ->with('success','Table updated successfully');
    }
    public function destroy($id)
    {
        $table = Table::query()->findOrFail($id);

        if($table)
        {
            $table->delete();
            return redirect()->route('admin.table.index')
                ->with('success','Table deleted successfully');
        }
        else
        {
            return redirect()->route('admin.table.index')
                ->with('error','Table not found');
        }
    }
}
