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
                <th>Comments</th>
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
                <td class="h-full flex flex-col align-top">
                    @foreach ($feed->comments as $comment )
                    <div class="p-3 flex gap-5 items-center border-b">
                        <div class="flex gap-2 text-sm">
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>