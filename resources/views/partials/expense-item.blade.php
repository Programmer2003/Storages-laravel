<form action="#" class="array-item p-4 border needs-validation show">
    <div class="toggle-buttons">
        <a onclick="toggleProduct(event)" class="btn btn-secondary toggle-button">
            <i class="bi bi-arrow-down-circle"></i>
        </a>
        <a onclick="deleteProduct(event)" class="btn btn-danger toggle-button">
            <i class="bi bi-x-circle"></i>
        </a>
    </div>
    <div class="product-info">
        <div class="mb-3 ">
            <label for="" class="form-label">Товар</label>
            <select class="form-select" name="product_id" id="products">
                @foreach ($products ?? [] as $product)
                    <option value='{{ $product->id }}'>{{ $product->name }} (осталось {{ $product->products_left }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 ">
            <label for="name">Количество </label>
            <input type="text" value="1" max="10" name="count" class="form-control" required />
            <div class="invalid-feedback">
                Введите количество.
            </div>
        </div>

        <div class="d-flex">
            <div class="mb-3 w-100">
                <label for="startPrice"> Закупочная цена </label>
                <input type="text" value="10" id="startPrice" class="form-control" required disabled />
                <div class="invalid-feedback">
                    Введите цену.
                </div>
            </div>
            <div class="mb-3 w-100  mx-3">
                <label for="margin"> Наценка (%) </label>
                <input type="text" id="margin" value="10" min="1" class="form-control" required />
                <div class="invalid-feedback">
                    Введите цену.
                </div>
            </div>
            <div class="mb-3 w-100">
                <label for="price"> Итоговая цена </label>
                <input type="text" value="11" name="price" step="any" class="form-control" required
                    readonly />
                <div class="invalid-feedback">
                    Введите цену.
                </div>
            </div>
        </div>
    </div>
    <div class="product__short-info">
        <div class="fs-2">Товар:
            <span id="product-name" class="text-info">
                {{ $categories[0]->products[0]->name ?? 'Не выбран' }}
            </span>
        </div>
        <div class="fs-2">
            <div class="d-inline"> Количество:
                <span id="product-count" class="text-info">
                    1
                </span>
            </div>
            <div class="d-inline"> Розничная цена:
                <span id="product-price" class="text-info">
                    1
                </span>
                р.
            </div>
        </div>
    </div>
</form>
