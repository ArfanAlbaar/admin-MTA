<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ReturnOrderResource;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Order;

class ReturnOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:50|exists:orders,order_number|unique:returns,order_number',
            'return_reason' => 'required|string',
            'customer_name' => 'required|string',
            'picture_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bank_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'name_bank_number' => 'nullable|string',
            'resi' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            // 'status_return' => 'required|in:Menunggu Persetujuan,Disetujui,Ditolak,Menunggu Barang Diterima,Barang Diterima,Selesai,Dibatalkan' // Hapus validasi ini
        ], [
            'order_number.exists' => 'Nomor pesanan tidak ditemukan.',
            'order_number.unique' => 'Pengajuan return untuk nomor pesanan ini sudah ada.',
        ]);

        if ($request->hasFile('picture_proof')) {
            $file = $request->file('picture_proof');
            $path = $file->store('returns', 'public');
            $validated['picture_proof'] = $path;
        }


        // Find product name by order number
        $productName = Order::where('order_number', $validated['order_number'])->value('product_name');

        $return = ReturnOrder::create([
            ...$validated,
            'return_product_name' => $productName,
            'return_date' => now(),
            'status_return' => 'Menunggu Persetujuan', // Set default
        ]);

        // Generate return_code
        $returnDateFormatted = Carbon::parse($return->return_date)->format('Ymd');
        $customReturnCode = "{$return->id}/MTA/{$returnDateFormatted}/{$return->order_number}/R";


        $return->return_code = $customReturnCode;
        $return->save();

        // 5. Kembalikan response sukses dengan data pesanan yang sudah diformat
        return new ReturnOrderResource($return);
    }

    public function showByReturnCode($return_code)
    {
        $return = ReturnOrder::where('return_code', $return_code)->firstOrFail();
        return new ReturnOrderResource($return);
    }
}
