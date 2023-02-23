@foreach ($products as $product)
    <option selected value='{{ $product->id }}'>{{ $product->name }}</option>
@endforeach
