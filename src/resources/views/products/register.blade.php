@extends('layouts.app')

@section('title', '商品登録')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@section('content')
<div class="product-register-container">
    <h1 class="title">商品登録</h1>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="text" class="form-control" id="price" name="price" placeholder="値段を入力" required>
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" class="form-control-file" id="image" name="image" required>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節 <span class="required">必須</span> <small>(複数選択可)</small></label>
            <div class="season-options">
                <label><input type="checkbox" name="season[]" value="spring"> 春</label>
                <label><input type="checkbox" name="season[]" value="summer"> 夏</label>
                <label><input type="checkbox" name="season[]" value="autumn"> 秋</label>
                <label><input type="checkbox" name="season[]" value="winter"> 冬</label>
            </div>
            @error('season')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea class="form-control" id="description" name="description" placeholder="商品の説明を入力" required></textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection
