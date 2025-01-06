<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::where('restaurant_id', Auth::user()->restaurant_id)->get();

        return view('manager.table.index', compact('tables'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'name' => 'required',
        ]);
        $randomString = Str::random(16);

        $incString = encrypt($randomString);

        $appUrl = 'https://foodbazalt.online';

        $content = $appUrl .'/QR/' . $incString;

//        dd($content);

        $qr = QrCode::size(300)->margin(0)->generate($content);

        Table::query()->create([
            'name' => $validatedData['name'],
            'qrcode' => $randomString,
            'qr_image' => $qr,
            'restaurant_id' => Auth::user()->restaurant_id,
        ]);

        return redirect()->route('manager.table.index')->with('success', 'Ширээ амжилттай үүслээ.');
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
        $validatedData = $request->validate([
           'name' => 'required',
        ]);
        Table::query()->findOrFail($id)->update([
           'name' => $validatedData['name'],
           'restaurant_id' => Auth::user()->restaurant_id,
        ]);
        return redirect()->route('manager.table.index')->with('success', 'Ширээ амжилттай шинэчлэгдлээ.');
    }

    public function destroy( $id)
    {
        $table = Table::query()->findOrFail($id);
        if($table){
            $table->delete();
            return redirect()->route('manager.table.index')->with('delete', 'Ширээ амжилттай устлаа.');
        }
        else {
            return redirect()->route('manager.table.index')
                ->with('error', 'Ширээ олдсонгүй.');
        }
    }
}
