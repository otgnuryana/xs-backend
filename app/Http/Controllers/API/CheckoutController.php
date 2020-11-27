<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        // request semua data kecuali transaction_details
        // data ini akan disimpan ke model transaction
        $data = $request->except('transaction_details');

        // uuid sebagai identifier transaksi
        $data['uuid'] = 'TXS' . mt_rand(10000, 99999) . mt_rand(100, 999);

        // panggil modelnya
        $transaction = Transaction::create($data);
        // karena $transaction sudah membuat data maka
        foreach ($request->transaction_details as $product) {
            // membuat array untuk transactiondetail
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction->id,
                'products_id' => $product,
            ]);

            // mengurangi stock/quantity
            // cari dalam product, setiap orang membeli produk kurangi stok atau quantity
            Product::find($product)->decrement('quantity');
        }
        // details() adalah relasi, untuk menyimpan transaction_details :
        $transaction->details()->saveMany($details);
        // mengembalikan data Responseformatter
        return ResponseFormatter::success();
    }
}
