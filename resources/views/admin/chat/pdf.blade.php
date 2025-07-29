<!DOCTYPE html>
<html>

<head>
    <title>Record Chats Report</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Record Chats Report</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Chat</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recordChats as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->chat }}</td>
                    <td>{{ $record->created_at->format('d M Y, H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">No chat records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
