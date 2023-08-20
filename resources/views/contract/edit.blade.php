@extends('adminlte::page')

@section('title', '契約編集')

@section('content_header')
    <h1>契約編集</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            {{-- エラーの表示 --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 編集画面 --}}
    <div class="card">
        <form action="{{ route('contract.update', $contract->id) }}" method="post">
            @csrf @method('PUT')
            <div class="card-body">
                {{-- 商品名入力 --}}
                <div class="form-group">
                    <label for="name">商品名</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $contract->name) }}" placeholder="商品名" />
                </div>
                {{-- 価格入力 --}}
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value="{{ old('price', $contract->price) }}" placeholder="価格" />
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <a class="btn btn-default" href="{{ route('contract.index') }}" role="button">戻る</a>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-primary">編集</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop