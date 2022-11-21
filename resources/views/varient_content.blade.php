<h2>{{ $product->name }}</h2>
@foreach ($product->options as $key => $item)
    <div>
        <strong>{{ $key }}</strong>
        @foreach ($item as $el)
            <span class="badge bg-success">{{ $el }}</span>
        @endforeach
    </div>
@endforeach