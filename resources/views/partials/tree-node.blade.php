{{-- @if ($category->productsCount()) --}}
<li class="list__group">
    @if (!$ancestor)
        <a class="list-group-item-title list__item" data-bs-toggle="collapse" href="#category{{ $category->id }}"
            role="button" aria-expanded="false" aria-controls="category{{ $category->id }}">
            {{ $category->name }}
            <span class="badge bg-primary rounded-pill">
                {{ $category->productsCount() }}
            </span>
        </a>
        @if ($category->productsCount())
            <ul class="collapse list__group" id="category{{ $category->id }}">
                @foreach ($category->products as $product)
                    @include('partials.list-item', [
                        'product' => $product,
                    ])
                @endforeach
            </ul>
        @endif
    @else
        <a class="list__item" data-bs-toggle="collapse" href="#category{{ $category->id }}" role="button"
            aria-expanded="false" aria-controls="category{{ $category->id }}">
            {{ $category->name }}
        </a>
        <ul class="collapse list__group " id="category{{ $category->id }}">
            @foreach ($category->descendants() as $descendant)
                @include('partials.tree-node', [
                    'ancestor' => $descendant->descendantsCount(),
                    'category' => $descendant,
                ])
            @endforeach
        </ul>
    @endif
</li>
