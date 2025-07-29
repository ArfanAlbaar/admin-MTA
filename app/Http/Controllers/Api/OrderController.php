<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
            'color' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'shipping_method' => 'required|string',
            'shipping_cost' => 'required|integer',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 1. Ambil data produk terkait
        $product = Product::findOrFail($request->product_id);

        // 2. Simpan bukti pembayaran
        $paymentProofPath = $request->file('payment_proof')->store('proofs', 'public');

        // 3. Buat pesanan di database terlebih dahulu untuk mendapatkan ID
        $order = Order::create([
            'product_id' => $product->id,
            'product_name' => $product->name, // Ambil nama produk
            'quantity' => $request->quantity,
            'size' => $request->size,
            'color' => $request->color,
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'shipping_method' => $request->shipping_method,
            'shipping_cost' => $request->shipping_cost,
            'payment_proof' => $paymentProofPath,
            'notes' => $request->notes,
            'order_date' => Carbon::now()->toDateString(), // Tanggal otomatis
        ]);

        // 4. Buat ID custom dan simpan
        $orderDateFormatted = Carbon::parse($order->order_date)->format('Ymd');
        $customOrderNumber = "{$order->id}/MTA/{$orderDateFormatted}/{$product->id}";

        $order->order_number = $customOrderNumber;
        $order->save();

        // 5. Kembalikan response sukses dengan data pesanan yang sudah diformat
        return new OrderResource($order);
    }
}
