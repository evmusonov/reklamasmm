@if ($menu)
    <ul class="list-unstyled">
        @foreach ($menu as $item)
            <li><a href="{{ $item->link }}">{{ $item->title }}</a></li>
        @endforeach
    </ul>
@endif
