<form action="#" class="array-item p-4 border needs-validation">
    <div class="toggle-buttons">
        <a onclick="toggleProduct(event)" class="btn btn-secondary toggle-button">
            <i class="bi bi-arrow-down-circle"></i>
        </a>
        <a onclick="deleteProduct(event)" class="btn btn-danger toggle-button">
            <i class="bi bi-x-circle"></i>
        </a>
    </div>
    <div class="product-info">
        <div class="mb-3">
            <label for="" class="form-label">Группа</label>
            <select class="form-select" id="category">
                @foreach ($categories as $item)
                    <option value='{{ $item->id }}'>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 ">
            <label for="" class="form-label">Товар</label>
            <select class="form-select" name="product_id" id="products">
                @foreach ($categories[0]->products ?? [] as $product)
                    <option value='{{ $product->id }}'>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 ">
            <label for="name">Количество </label>
            <input type="text" value="1" name="count" class="form-control" required />
            <div class="invalid-feedback">
                Введите количество.
            </div>
        </div>
        <div class="mb-3 ">
            <label for="price">Цена за единицу </label>
            <input type="text" value="1" min="0.1" step="any" name="price" class="form-control"
                required />
            <div class="invalid-feedback">
                Введите цену.
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
            <div class="d-inline"> Цена:
                <span id="product-price" class="text-info">
                    1
                </span>
                р.
            </div>
        </div>
    </div>
</form>
