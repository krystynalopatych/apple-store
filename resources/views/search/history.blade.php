<h2>Your Recent Searches</h2>

<ul>
    @forelse ($history as $item)
        <li>{{ $item }}</li>
    @empty
        <li>No recent searches.</li>
    @endforelse
</ul>
