{{-- filepath: resources/views/admin/orders/report.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Daftar Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>No. Pesanan</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number ?? 'N/A' }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->order_date ? $order->order_date->format('d M Y') : '-' }}</td>
                    <td>{{ $order->product_name }} ({{ $order->quantity }} pcs)</td>
                    <td>{{ ucfirst($order->order_status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
