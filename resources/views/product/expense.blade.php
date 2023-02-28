@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="border p-3 mt-4">
            <div class="row pb-2">
                <h2 class="text-primary">Приход товаров. Номер ТТН: {{ $TTH }}</h2>
                <hr />
            </div>
            <div class="m-3 all-products">
                <div class="array" id="array">
                    @include('partials.expense-item', ['products' => $products])
                </div>

                <button class="btn btn-success add-item" id="addItem"><i class="bi bi-plus-circle"></i></button>
            </div>
            <button onclick="submit()" class="btn btn-primary" style="width:150px">
                Оформить расход
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
            var productSelect = element[0].elements['products'];

            var marginInput = element[0].elements['margin'];
            var startPrice = element[0].elements['startPrice'];

            $(productSelect).on('change', function(e) {
                const json = {
                    'id': this.selectedOptions[0].value,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/getProduct',
                    data: json,
                    success: function(res) {
                        console.log(res);
                        let select = element.find('#startPrice');
                        select.val(res);
                    },
                    error: function(data) {
                        console.log('error during execution');
                        toastr.error('Ошибка во время выполнения');
                    }
                });
            });

            $(marginInput).on('input', function(e) {

                priceInput.value = parseInt(startPrice.value) + startPrice.value * this.value / 100;
                $(price).text(startPrice.value);
            })

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
            const array = [];
            for (let item of $('#array').children('.array-item')) {
                const form = new FormData(item);
                const obj = {};
                form.forEach((value, key) => (obj[key] = value));
                array.push(obj);
            }

            // let json = JSON.stringify({
            //     array: array,
            //     TTH: {{ $TTH }}
            // })


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
                url: '{{ route('product.expense_store') }}',
                data: json,
                success: function(res) {
                    console.log(res);
                    toastr.success('Расход оформлен, номер ТТН: {{ $TTH }}');
                },
                error: function(data) {
                    console.log('error during execution');
                    toastr.error('Ошибка во время выполнения');
                }
            });
        }
    </script>
@endsection
