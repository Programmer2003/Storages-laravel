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
            <div class="text-end">
                <a href="{{ route('product.create', $storage->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> &nbsp; Добавить товар
                </a>
            </div>
        </div>
        <div class="table-all">
            <table class="table table-bordered table-striped" style="width:100%" id="table">
                <thead>
                    <tr>
                        <th width='40%'>
                            Название
                        </th>
                        <th width='20%'>
                            Срок годности
                        </th>
                        <th width='25%'>
                            Группа
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td> {{ $product->name }} </th>
                            <td> {{ $product->expiration }} </th>
                            <td> {{ $product->category->name }} </td>
                            <td>
                                <div class='w-75 btn-group' role='group'>
                                    <a href='{{ route('product.edit', [$storage->id, $product->id]) }}'
                                        class='btn btn-primary mx-2'><i class='bi bi-pencil-square'></i> Edit</a>
                                    <a href='{{ route('product.delete', $product->id) }}' class='btn btn-danger mx-2'><i
                                            class='bi bi-trash-fill'></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
