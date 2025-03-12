@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集削除</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card card-primary">
            <!-- 商品編集フォーム -->
            <form action="{{ route('item.edit', ['id' => $item->id]) }}" method="POST">
                @csrf
                @method('POST') <!-- 編集の場合POSTメソッド -->

                <input type="hidden" name="id" value="{{$item->id}}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{$item->name}}" >
                    </div>

                    <div class="form-group">
                        <label for="type">種別</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="種別" value="{{$item->type}}" >
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" value="{{$item->detail}}">
                    </div>
                </div>

                <div class="card-footer">
                    <!-- 編集ボタン -->
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
            </form>

            <!-- 商品削除フォーム (POSTメソッド) -->
            <form action="{{ route('item.delete', ['id' => $item->id]) }}" method="POST" >
                @csrf
                <!-- 削除処理をPOSTで送信 -->
                <div class="card-footer">
                    <!-- 削除ボタン -->
                    <button type="submit" class="btn btn-danger">削除</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
