@extends('layouts.main')
@section('content')
    <div class="wrapper main" id="choice">
        <div class="storages">
            @foreach ($storages as $storage)
                <a href="{{ route('product.index', $storage->id) }}" class='storage' data-group='{{ $storage['id'] }}'>
                    <div class='storage__img'>
                        <img src='{{ asset('img/' . $storage['img']) }}' alt='{{ $storage['type'] }}'>
                    </div>
                    <div class='storage__text'>
                        {{ $storage['type'] }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
