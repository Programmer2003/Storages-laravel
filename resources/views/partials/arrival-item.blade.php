<form action="#" class="array-item p-4 border show">
    <div class="toggle-buttons">
        <a onclick="toggleProduct(event)" class="btn btn-secondary toggle-button" >
            <i class="bi bi-arrow-down-circle"></i>
        </a>
        <a onclick="deleteProduct(event)" class="btn btn-danger toggle-button" >
            <i class="bi bi-x-circle"></i>
        </a>
    </div>
    <div class="product-info">
        <div class="mb-3">
            <label for="" class="form-label">Группа</label>
            <select class="form-select" id="category">
                <option value="1">
                    Молочные продукты
                </option>
                <option value="2">
                    Молоко
                </option>
                <option value="3">
                    Коровье молоко
                </option>
                <option value="4">
                    Сгущенное, сухое молоко
                </option>
                <option value="5">
                    Кефир, кисломолчные изделия
                </option>
                <option value="6">
                    Кефир, бифидопродукты
                </option>
                <option value="7">
                    Закваски
                </option>
                <option value="8">
                    Мясные продукты
                </option>
                <option value="9">
                    Свининна
                </option>
                <option value="10">
                    Разделка охлажденная из свинины
                </option>
                <option value="11">
                    Копчености из свинины
                </option>
                <option value="12">
                    Полуфабрикаты
                </option>
            </select>
        </div>
        <div class="mb-3 ">
            <label for="" class="form-label">Товар</label>
            <select class="form-select" name="product_id" id="products">
            </select>
        </div>
        <div class="mb-3 ">
            <label for="name">Количество </label>
            <input type="text" value="1" name="count" class="form-control" required />
            <div class="invalid-feedback">
                Введите количество.
            </div>
        </div>
    </div>
    <div class="product__short-info">
        <div class="fs-2">Товар: <span id="product-name">Молоко стерилизованное 2.8%</span></div>
        <div class="fs-2">Количество: <span id="product-count"> 1 </span></div>
    </div>
</form>