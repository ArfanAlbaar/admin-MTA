{{-- filepath: resources/views/admin/returns/report.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Return</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h2>Laporan Return</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Return</th>
                <th>No. Pesanan</th>
                <th>Pelanggan</th>
                <th>Produk Return</th>
                <th>Tanggal Return</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $return)
                <tr>
                    <td>{{ $return->return_code }}</td>
                    <td>{{ $return->order_number }}</td>
                    <td>{{ $return->customer_name }}</td>
                    <td>{{ $return->return_product_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($return->return_date)->format('d M Y') }}</td>
                    <td>{{ $return->status_return }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
