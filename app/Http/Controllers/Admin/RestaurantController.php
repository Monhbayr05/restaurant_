<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{


    public function index()
    {
        $restaurants = Restaurant::query()->orderBy('id', 'asc')->get();
        return view('admin.restaurant.index', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'phone_number' => 'required|max:100',
            'slug' => 'required|unique:restaurants|string|max:100',
            'location' => 'required|string|max:100',
        ]);
        Restaurant::query()->create([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
            'slug' => $validatedData['slug'],
            'location' => $validatedData['location'],
        ]);
        return redirect()->route('admin.restaurant.index')
            ->with('success', 'Ресторан амжилттай үүслээ.');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::query()->findOrFail($id);
        return view('admin.restaurant.index', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'phone_number' => 'required|max:100',
            'slug' => 'required|unique:restaurants|string|max:100',
            'location' => 'required|string|max:100',
        ]);
        Restaurant::query()->findOrFail($id)->update([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
            'slug' => $validatedData['slug'],
            'location' => $validatedData['location'],
        ]);
        return redirect()->route('admin.restaurant.index')
            ->with('success', 'Ресторан амжилттай шинэчлэгдлээ.');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::query()->find($id);

        if ($restaurant) {
            $restaurant->delete();
            return redirect()->route('admin.restaurant.index')
                ->with('delete', 'Ресторан амжилттай устлаа.');
        }

        return redirect()->route('admin.restaurant.index')
            ->with('error', 'Ресторан олдсонгүй');
    }
}
