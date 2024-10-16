<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        $randomString = Str::random(16);

        $incString = encrypt($randomString);

        $content = 'http://13.115.248.34/QR/' . $incString;

        $qr = QrCode::size(50)->generate($content);

        Table::query()->create([
            'name' => $validateData['name'],
            'qrcode' => $randomString,
            'qr_image' => $qr,
            'restaurant_id' => $validateData['restaurant_id'],
        ]);


        return redirect()->route('admin.table.index')
            ->with('success','Table created successfully');
    }

    public function getTable($qr)
    {
        $qr = decrypt($qr);
        $table = Table::query()->where('qrcode', $qr)->first();
        $products = Product::all();

        return view('products', compact('table', 'products'));
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
