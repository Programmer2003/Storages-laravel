@extends('layouts.main')
@section('content')
    <div class="container">
        <form action="{{ route('product.destroy', $product->id) }}" id="deleteForm">
            @csrf
            @method('delete')
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Удаление товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input value="{{ $product->name }}" type="text" id="name" class="form-control" disabled />
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input value="{{ $product->price }}" type="number" min="0.1" step="any" id="price"
                        class="form-control" disabled />
                </div>
                <div class="mb-3">
                    <label for="name">Категория</label>
                    <input value="{{ $category->name }}" type="text" id="category" class="form-control" disabled />
                </div>
                <button id="button" data-deleted="0" type="submit" class="btn btn-danger" style="width:150px">
                    Удалить
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary" style="width:150px">
                    Вернуться назад
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            //form validation and product delete/recover
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //check if we want to delete element or restore
                if ($('#button').data("deleted") === 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('product.destroy', $product->id) }}.php',
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(res) {
                            console.log(res['code']);
                            toastr.success('Запись удалена');
                            $('#button').data("deleted", 1);
                            $('#button').text("Восстановить");
                        },
                        error: function(data) {
                            console.log('error during execution');
                            toastr.error('Ошибка во время выполнения');
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'recoverPost.php',
                        data: {},
                        dataType: "json",
                        success: function(res) {
                            console.log(res['code']);
                            toastr.info('Запись восстановлена');
                            history.pushState("delete", "delete", `delete.php?id=${res['id']}`)
                            $('#recordId').val(res['id']);
                            $('#button').data("deleted", 0);
                            $('#button').text("Удалить");
                        },
                        error: function(data) {
                            console.log(data);
                            console.log('error during execution');
                            toastr.error('Ошибка во время выполнения');
                        }
                    });
                }

            })
        })
    </script>
@endsection
