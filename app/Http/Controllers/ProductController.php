<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::whereHas('user', function ($query) {
            $query->where('is_admin', true);
        })->get();
        return view('products.index', compact('products'));
    }

    public function apiIndex(){
        $products = Product::all();
        return response()->json($products);
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        if(!Auth::check() || !Auth::user()->is_admin){
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image')->store('products', 'public'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.products.create')->with('success', 'Product added');
    }
}
