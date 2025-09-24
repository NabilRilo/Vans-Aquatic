<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
{
    $categories = \App\Models\Category::with('products')->withCount('products')->get();
    return view('KategoriBarang', compact('categories'));
}

    
}
