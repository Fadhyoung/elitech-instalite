<table>
    <thead>
        <tr>
            <th>Media</th>
            <th>Date Posted</th>
            <th>Caption</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($feeds as $feed)
        <tr>
            <td>{{ $feed->media_url ?? 'fanuhi_media' }}</td>
            <td>{{ $feed->created_at->format('Y-m-d') }}</td>
            <td>{{ $feed->caption }}</td>
            <td>
                {!! $feed->comments->pluck('comment')->implode('<br>') !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
