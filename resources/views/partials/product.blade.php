<form class="needs-validation" id="editForm" novalidate>
    <div class="row pb-2">
        <h2 class="text-primary">Товар</h2>
        <hr />
    </div>
    <div class="mb-3">
        <label for="name">Название</label>
        <input value="{{ $product->name }}" type="text" id="name" name="name" class="form-control" required />
        <div class="invalid-feedback">
            Введите название.
        </div>
    </div>
    <div class="mb-3">
        <label for="price">Цена</label>
        <input value="{{ $product->price }}" type="number" min="0.1" step="any" id="price" name="price"
            class="form-control" required />
        <div class="invalid-feedback">
            Цена должна быть от 10 копеек.
        </div>
    </div>
    <div class="mb-3">
        <label for="name">Категория</label>
        <input value="{{ $product->category->name }}" type="text" id="category" class="form-control" disabled />
    </div>
</form>
