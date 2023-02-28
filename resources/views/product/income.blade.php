@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="border p-3 mt-4">
            <div class="row pb-2">
                <div class="d-flex justify-content-between">
                    <h2 class="text-primary">Приход товаров. Номер ТТН: {{ $TTH }}</h2>
                    <a href="{{ route('product.create', $storage) }}" class="btn text-warning">Добавить продукт</a>
                </div>
                <hr />
            </div>
            <div class="m-3 all-products">
                <div class="array" id="array">
                    @include('partials.income-item', ['categories' => $categories])
                </div>

                <button class="btn btn-success add-item" id="addItem"><i class="bi bi-plus-circle"></i></button>
            </div>
            <button onclick="submit()" class="btn btn-primary" style="width:150px">
                Оформить приход
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary" style="width:150px">
                Вернуться назад
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addItem').on('click', addItem);
            addItem();
            $('#array').children()[0].remove();
        })

        function addItem() {
            var item = createItem();
            $('#array').append(item);
        }

        function toggleProduct(event) {
            $(event.target).parents('form').toggleClass('show');
        }

        function deleteProduct(event) {
            $(event.target).parents('form').remove();
        }

        function createItem() {
            var element = $('.array-item:last').clone();
            element.on('submit', function(e) {
                e.preventDefault();
            })

            let button = element.children('.toggle-button');
            $(button).on('click', toggleProduct);

            var name = element.find('#product-name');
            var count = element.find('#product-count');
            var price = element.find('#product-price');
            var nameInput = element[0].elements['product_id'];
            var countInput = element[0].elements['count'];
            var priceInput = element[0].elements['price'];
            var categorySelect = element[0].elements['category'];


            $(categorySelect).on('change', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '/category',
                    data: {
                        id: this.selectedOptions[0].value
                    },
                    success: function(res) {
                        let select = element.find('#products');
                        select.html(res);
                        $(name).text(select[0].options.item(0).text);
                    },
                    error: function(data) {
                        console.log('error during execution');
                        toastr.error('Ошибка во время выполнения');
                    }
                });
            });

            $(nameInput).on('change', function(e) {
                $(name).text(this.selectedOptions[0].text);
            })

            $(countInput).on('change', function(e) {
                $(count).text(this.value);
            })

            $(priceInput).on('change', function(e) {
                $(price).text(this.value);
            })

            return element;
        }

        function submit() {
            // var forms = document.querySelectorAll('.needs-validation')
            // var pass = true;
            // Array.prototype.slice.call(forms)
            //     .forEach(function(form) {
            //         console.log(form.checkValidity());

            //         if (!form.checkValidity()) {
            //             console.log(1);
            //             pass = false;
            //         }
            //         form.classList.add('was-validated')
            //     });
            // console.log(pass);
            // return;

            const array = [];
            for (let item of $('#array').children('.array-item')) {
                const form = new FormData(item);
                const obj = {};
                form.forEach((value, key) => (obj[key] = value));
                array.push(obj);
            }

            const json = {
                'array': array,
                'TTH': {{ $TTH }}
            }
            console.log(json);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('product.income_store') }}',
                data: json,
                success: function(res) {
                    console.log(res);
                    toastr.success('Приход оформлен, номер ТТН: {{ $TTH }}');
                },
                error: function(data) {
                    console.log('error during execution');
                    toastr.error('Ошибка во время выполнения');
                }
            });
        }
    </script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
