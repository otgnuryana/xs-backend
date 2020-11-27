<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        //fungsi untuk ngambil data
        // sama seperti mengambil data di cms hanya saja disini tidak menggunakan view tapi menggunakan respon formatter
        if ($id) {
            // cari data dengan id ini cari dengan galleries
            $product = Product::with('galleries')->find($id);

            if ($product)
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk tidak ditemukan', 404);
        }
        if ($slug) {
            // cari data dengan id ini cari dengan galleries
            $product = Product::with('galleries')->where('slug', $slug)->first();

            if ($product)
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk tidak ditemukan', 404);
        }

        $product = Product::with('galleries');

        if ($name)
            $product->where('name', 'like', '%' . $name . '%');

        if ($type)
            $product->where('type', 'like', '%' . $type . '%');

        if ($price_from)
            $product->where('price', '>=', $price_from);

        if ($price_to)
            $product->where('price', '<=', $price_to);

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
