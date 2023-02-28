@extends('layouts.main')
@section('content')
    <div class="wrapper list">
        <ul class="list-group ">
            <div class="d-flex justify-content-between">
                <a href="{{ route('product.income', $storage) }}" class="btn btn-info">Оформить приход</a>
                <a href="{{ route('product.sales', $storage) }}" class="btn btn-danger">Продажи</a>
                <a href="{{ route('product.expense', $storage) }}" class="btn btn-warning">Оформить расход</a>
            </div>
            @foreach ($categories as $category)
                @include('partials.tree-node', [
                    'ancestor' => $category->descendantsCount(),
                    'category' => $category,
                ])
            @endforeach
        </ul>

        <div class="product" id="product">
            {{-- @include('partials.product', ['product' => $storage->categories[12]->products[0]]) --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            for (let item of $('.get-product')) {
                $(item).on('click', getProduct);
            }
        })

        function getProduct() {
            let id = $(this).data('id');
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
