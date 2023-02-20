@extends('layouts.main')
@section('content')
    <div class="wrapper list">
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list__group">
                    <a class="list__item" data-bs-toggle="collapse" href="#category{{ $category->id }}" role="button"
                        aria-expanded="false" aria-controls="category{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                    <ul class="collapse list__group" id="category{{ $category->id }}">
                        @foreach ($category->descendants() as $descendant)
                            <li class="list__group">
                                <a class="list-group-item-title list__item" data-bs-toggle="collapse"
                                    href="#category{{ $descendant->id }}" role="button" aria-expanded="false"
                                    aria-controls="category{{ $descendant->id }}">
                                    {{ $descendant->name }}
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ $descendant->descendants()->count() }}
                                    </span>
                                </a>
                                <ul class="collapse list__group" id="category{{ $descendant->id }}">
                                    @foreach ($descendant->descendants() as $descendant)
                                        <li class="list__group">
                                            <a class="list-group-item-title list__item" data-bs-toggle="collapse"
                                                href="#category{{ $descendant->id }}" role="button" aria-expanded="false"
                                                aria-controls="category{{ $descendant->id }}">
                                                {{ $descendant->name }}
                                                <span class="badge bg-primary rounded-pill">
                                                    {{ $descendant->productsCount() }}
                                                </span>
                                            </a>
                                            @if ($descendant->productsCount())
                                                <ul class="collapse list__group" id="category{{ $descendant->id }}">
                                                    @foreach ($descendant->products as $product)
                                                        @include('partials.list-item', [
                                                            'product' => $product,
                                                        ])
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

        <div class="product" id="product">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            for (let item of $('.get-product')) {
                console.log(item);
                $(item).on('click', getProduct);
            }
        })

        function getProduct() {
            let id = $(this).data('id');
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: `/products/${id}`,
                dataType: "html",
                success: function(res) {
                    $('#product').html(res);
                },
                error: function(data) {
                    console.log('error during execution');
                    toastr.error('Ошибка во время операции');
                }
            });
        }
    </script>
@endsection
