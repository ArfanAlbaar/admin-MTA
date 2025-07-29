<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan (READ)
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10); // Ambil data terbaru & paginasi
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan (UPDATE part 1)
     */
    public function edit(Order $order)
    {
        // Daftar status yang bisa dipilih di form
        $statuses = ['pending', 'shipping', 'completed', 'cancelled'];
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    /**
     * Menyimpan perubahan pada pesanan (UPDATE part 2)
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'order_status' => 'required|in:pending,shipping,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Update data di database
        $order->update($request->all());

        // Redirect kembali ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }
    public function downloadPdf()
    {
        $orders = Order::all();
        $pdf = PDF::loadView('admin.orders.report', compact('orders'));
        return $pdf->download('report-orders.pdf');
    }
}
