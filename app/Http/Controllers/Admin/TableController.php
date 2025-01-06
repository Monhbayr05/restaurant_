<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $tables = Table::query()->orderby('id')->get();
        return view('admin.table.index',
            compact('tables', 'restaurants'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
        ]);

        $randomString = Str::random(16);

        $incString = encrypt($randomString);

        $appUrl = 'https://restaurant_.test';

        $content = $appUrl .'/QR/' . urlencode($incString);

//        dd($content);

        $qr = QrCode::size(300)->margin(0)->generate($content);

        Table::query()->create([
            'name' => $validateData['name'],
            'qrcode' => $randomString,
            'qr_image' => $qr,
            'restaurant_id' => $validateData['restaurant_id'],
        ]);


        return redirect()->route('admin.table.index')
            ->with('success', 'Ширээ амжилттай үүслээ.');
    }

    public function getTable($qr)
    {
        $qr = decrypt($qr);

        $table = Table::query()->where('qrcode', $qr)->first();
        $product = Product::all();
        $categories = Category::all();





        if (!$table) {
            abort(404, 'Table not found');
        }

        return Inertia::render(
            'Order',
            [
                'tableId' => $table->id,
                'products' => $product,
                'categories' => $categories,
            ]
        );
    }


    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $validateData = $request->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
        ]);
        Table::query()->findOrFail($id)->update([
            'name' => $validateData['name'],
            'restaurant_id' => $validateData['restaurant_id'],
        ]);
        return redirect()->route('admin.table.index')
            ->with('success', 'Ширээ амжилттай шинэчлэгдлээ.');
    }

    public function destroy($id)
    {
        $table = Table::query()->findOrFail($id);

        if ($table)
        {
            $table->delete();
            return redirect()->route('admin.table.index')
                ->with('delete', 'Ширээ амжилттай устлаа.');
        } else {
            return redirect()->route('admin.table.index')
                ->with('error', 'Ширээ олдсонгүй.');
        }
    }
}
