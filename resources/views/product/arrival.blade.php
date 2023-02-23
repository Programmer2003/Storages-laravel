@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="border p-3 mt-4">
            <div class="row pb-2">
                <h2 class="text-primary">Приход товаров</h2>
                <hr />
            </div>
            <div class="m-3 all-products">
                <div class="array" id="array">
                    @include('partials.arrival-item')
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
            var nameInput = element[0].elements['product_id'];
            var countInput = element[0].elements['count'];
            var categorySelect = element[0].elements['category'];

            console.log(categorySelect);
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

            return element;
        }

        function selectCategory(e) {
            console.log(e)

        }

        function submit() {
            const array = [];
            for (let item of $('#array').children('.array-item')) {
                const form = new FormData(item);
                const obj = {};
                form.forEach((value, key) => (obj[key] = value));
                array.push(obj);
            }

            console.log(JSON.stringify({
                array: array
            }));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('product.array') }}',
                data: JSON.stringify({
                    array: array
                }),
                success: function(res) {
                    toastr.success('Запись добавлена');
                },
                error: function(data) {
                    console.log('error during execution');
                    toastr.error('Ошибка во время выполнения');
                }
            });
        }
    </script>
@endsection
