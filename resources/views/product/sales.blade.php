@extends('layouts.main')
@section('content')
    <div class="wrapper container-fluid" id="show">
        <div class="table__info" id="tableInfo">
            <div class="table__storage" id="storageName">
                {{ $storage->name }}
            </div>
            <div class="table__name" id="storageType">
                {{ $storage->type }}
            </div>
        </div>
        <div class="table-all">
            <table class="table table-bordered table-striped" style="width:100%" id="table">
                <thead>
                    <tr>
                        <th width='40%'>
                            Название
                        </th>
                        <th width='25%'>
                            Осталось на складе
                        </th>
                        <th width='25%'>
                            Продано на сумму
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td> {{ $product->name }} </th>
                            <td> {{ $product->products_left }} </td>
                            <td> {{ $product->sum }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="fs-2">
            Итого продано на: <span class="text-info"> {{ $products->sum('sum') }} р.</span>
        </div>
    </div>
@endsection
