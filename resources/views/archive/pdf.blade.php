<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h2>Feed Archive</h2>
    <table>
        <thead>
            <tr>
                <th>Media</th>
                <th>Date</th>
                <th>Caption</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feeds as $feed)
            <tr>
                <td>
                    @if($feed->media_type === 'photo')
                        <img src="{{ storage_path('app/public/' . $feed->media_path) }}" width="100">
                    @else
                        [Video not shown]
                    @endif
                </td>
                <td>{{ $feed->created_at->format('Y-m-d') }}</td>
                <td>{{ $feed->caption }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>