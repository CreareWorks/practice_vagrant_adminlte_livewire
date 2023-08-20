{{-- adminLTEの基本構造 --}}
{{-- adminLTEのテンプレートを継承 --}}
@extends('adminlte::page')
{{-- タイトル --}}
@section('title', 'ChangeUserName')
{{-- ヘッダー --}}
@section('content_header')
    <h1>ChangeUserName</h1>
@stop
{{-- 本文 --}}
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

    <form action="{{route ('changeName')}}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="name">
        <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('変更してもよろしいですか?');">
            変更
        </button>
    </form>
    
    {{-- message --}}
    @if (session('message'))
        <div class="alert alert-info alert-dismissible mt-5">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{session('message')}}
        </div>
    @endif

@stop
{{-- adminLTE 標準CSS読み込み --}}
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
{{-- js読み込み --}}
@section('js')
    <script> console.log('動作確認!'); </script>
@stop
