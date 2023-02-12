@extends('layouts.main')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('product.store') }}" class="needs-validation" id="createForm" novalidate>
            @csrf
            <div class="border p-3 mt-4">
                <div class="row pb-2">
                    <h2 class="text-primary">Добавление товара</h2>
                    <hr />
                </div>
                <div class="mb-3">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" class="form-control" required />
                    <div class="invalid-feedback">
                        Введите название.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price">Цена</label>
                    <input type="number" min="0.1" step="any" id="price" name="price" class="form-control"
                        required />
                    <div class="invalid-feedback">
                        Цена должна быть от 10 копеек.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleSelect1" class="form-label">Группа</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $item)
                            <option selected value='{{ $item->id }}'>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:150px">
                    Добавить
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
        //form validation and product insert
        $(function() {
            $('#createForm').on('submit', function(e) {
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
                    type: 'POST',
                    url: '{{ route('product.store') }}',
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(res) {
                        //toastr.success('Запись добавлена');
                    },
                    error: function(data) {
                        console.log('error during execution');
                        toastr.error('Ошибка во время выполнения');
                    }
                });
            })
        })
    </script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
