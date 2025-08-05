<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $sort = $request->get('sort', 'latest');
    $search = $request->get('search');

    $query = Product::query();

    // Search functionality
    if ($search) {
        $searchTerm = '%' . strtolower(trim($search)) . '%';
        $query->where(function ($q) use ($searchTerm) {
            $q->whereRaw('LOWER(brand) LIKE ?', [$searchTerm])
              ->orWhereRaw('LOWER(type) LIKE ?', [$searchTerm])
              ->orWhereRaw('LOWER(description) LIKE ?', [$searchTerm]);
        });
    }

    // Sorting options
    switch ($sort) {
        case 'latest':
            $query->orderBy('created_at', 'desc');
            break;
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        case 'brand_asc':
            $query->orderBy('brand', 'asc');
            break;
        case 'brand_desc':
            $query->orderBy('brand', 'desc');
            break;
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'stock_asc':
            $query->orderBy('stock', 'asc');
            break;
        case 'stock_desc':
            $query->orderBy('stock', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $products = $query->get();

    return view('product', [
        'title' => 'Produk - PT Smart',
        'products' => $products
    ]);
}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'brand' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'price' => 'required|integer|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
            ]);

            $product = new Product();
            $product->brand = $validatedData['brand'];
            $product->type = $validatedData['type'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->description = $validatedData['description'] ?? null;
            $product->save();

            Log::info('Produk berhasil dibuat', [
                'product_id' => $product->id,
                'data' => $product->toArray()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data' => $product
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal saat membuat produk', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Gagal membuat produk', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Product $product)
    {
        try {
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'brand' => $product->brand,
                    'type' => $product->type,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'description' => $product->description,
                    'created_at' => $product->created_at->format('d-m-Y H:i:s'),
                    'updated_at' => $product->updated_at ? $product->updated_at->format('d-m-Y H:i:s') : null,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $productName = $product->brand;
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk "' . $productName . '" berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('edit-product', [
            'title' => 'Edit Produk - PT Smart',
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'brand' => $validatedData['brand'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }
}
