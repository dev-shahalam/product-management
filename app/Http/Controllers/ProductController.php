<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductController extends Controller {

    // Create product page

    public function productsPage(Request $request) {

        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');
        $search = $request->input('search', '');

        // Fetch sorted products
        $products = Product::orderBy($sort, $direction)
        ->when($search, function($query) use ($search) {
            // Search by product_id (id) or description (case-insensitive)
            $query->where('product_id', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })->paginate(10);

        // $products = Product::paginate(4);
        return view('index', compact('products', 'sort', 'direction','search'));
    }
    public function createProductPage() {
        return view("create");
    }

    public function viewProduct(Request $request) {
        try {
            $product_id = $request->id;
            $product = Product::where('id', $product_id)->first();
            if ($product) {
//            return $product;
                return view('show', compact('product'));
            } else {
                return redirect()->back()->with('error', 'Product Not Found');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function editProductPage(Request $request) {
        $product_id = $request->id;
        $product = Product::where('id', $product_id)->first();
        if ($product) {
            return view('edit', compact('product'));
        } else {
            return redirect()->back()->with('error', 'Product Not Found');
        }
    }

    public function createProduct(Request $request) {

        try {
            $request->validate([
                'product_id' => 'required|unique:products,product_id,',
                'name' => 'required',
                'price' => 'required|numeric',
                'image' => 'image|nullable',
            ]);
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $t = time();
                $image_name = $t . $image->getClientOriginalName();
                $image_path = "uploads/{$image_name}";

                $image->move(public_path('uploads'), $image_name);

            }
            Product::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $image_path,
            ]);
            return redirect()->route('products')->with('success', 'Product Added Successfully');
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function updateProduct(Request $request) {

        try {
            $product_id = $request->id;
            $product = Product::find($product_id);

            if ($product) {
                $request->validate([
                    'name' => 'required',
                    'price' => 'required|numeric',
                    'stock' => 'required | numeric',
                    'image' => 'image|nullable',
                    'description' => 'required',
                ]);
                // $image_path=$product->image;

                if ($request->hasFile('image')) {

                    if (file_exists(public_path($product->image))) {
                        unlink(public_path($product->image));
                    }

                    $image = $request->file('image');
                    $t = time();
                    $image_name = $t . $image->getClientOriginalName();
                    $image_path = "uploads/{$image_name}";

                    $image->move(public_path('uploads'), $image_name);

                    Product::where('id', $product_id)->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'price' => $request->price,
                        'stock' => $request->stock,
                        'image' => $image_path,
                    ]);
                }

                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'stock' => $request->stock,
                ]);
                return redirect()->route('products')->with('success', 'Product updated');
            } else {
                return redirect()->back()->with('error', 'Product not found');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function deleteProduct(Request $request) {
        $product_id = $request->id;

        $product = Product::find($product_id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product delete');
        } else {
            return redirect()->back()->with('error', 'Product not found');

        }

    }

}
