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
        <label for="name">Категория</label>
        <input value="{{ $product->category->name }}" type="text" id="category" class="form-control" disabled />
    </div>
    <a class="btn btn-primary" style="width:150px"
        href="{{ route('product.edit', [$product->storage->id, $product->id]) }}">
        Редактировать
    </a>
</form>
