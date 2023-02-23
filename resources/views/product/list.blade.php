@extends('layouts.main')
@section('content')
    <div class="wrapper list">
        <ul class="list-group ">
            @foreach ($categories as $category)
                @include('partials.tree-node', [
                    'ancestor' => $category->descendantsCount(),
                    'category' => $category,
                ])
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
