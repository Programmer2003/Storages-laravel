@extends('layouts.main')
@section('content')
    <div class="container">
        <form method="patch" action="{{ route('product.store') }}" class="needs-validation" id="editForm" novalidate>
            @csrf
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Редактирование товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input value="{{ $product->name }}" type="text" id="name" name="name" class="form-control"
                        required />
                    <div class="invalid-feedback">
                        Введите название.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input value="{{ $product->price }}" type="number" min="0.1" step="any" id="price"
                        name="price" class="form-control" required />
                    <div class="invalid-feedback">
                        Цена должна быть от 10 копеек.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleSelect1" class="form-label">Группа</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            <option @if ($category->id == $product->category_id) selected @endif value='{{ $category->id }}'>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:150px">
                    Обновить
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
            //form validation and product update
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                this.classList.add('was-validated');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('product.update', $product->id) }}',
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(res) {
                        console.log(res);
                        //toastr.success('Запись успешно обновлена');
                    },
                    error: function(data) {
                        console.log('error during execution');
                        //toastr.error('Ошибка во время выполнения');
                    }
                });

            })
        })
    </script>

    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
