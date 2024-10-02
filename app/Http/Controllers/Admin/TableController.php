<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TableController extends Controller
{
    Public function index()
    {
        return view('admin.table.index');
    }
}
