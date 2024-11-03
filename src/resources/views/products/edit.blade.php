@extends('layouts.app')

@section('title', '商品編集 - ' . $product->name)
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@section('content')
<div class="product-edit-container">
    <nav class="breadcrumb">
        <a href="{{ route('product.index') }}">商品一覧</a> &gt; {{ $product->name }}
    </nav>

    <!-- 商品画像 -->
    <div class="product-image">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    </div>

    <!-- 商品編集フォーム -->
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <!-- 商品名 -->
    <label for="name">商品名</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力" required>
    @error('name')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <!-- 価格 -->
    <label for="price">値段</label>
    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力" required>
    @error('price')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <!-- 季節 -->
    <label>季節</label>
    <div class="season-options">
        <label><input type="checkbox" name="season[]" value="春" {{ in_array('春', explode(',', $product->season)) ? 'checked' : '' }}> 春</label>
        <label><input type="checkbox" name="season[]" value="夏" {{ in_array('夏', explode(',', $product->season)) ? 'checked' : '' }}> 夏</label>
        <label><input type="checkbox" name="season[]" value="秋" {{ in_array('秋', explode(',', $product->season)) ? 'checked' : '' }}> 秋</label>
        <label><input type="checkbox" name="season[]" value="冬" {{ in_array('冬', explode(',', $product->season)) ? 'checked' : '' }}> 冬</label>
    </div>
    @error('season')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <!-- 商品説明 -->
    <label for="description">商品説明</label>
    <textarea name="description" id="description" rows="4" placeholder="商品の説明を入力" required>{{ old('description', $product->description) }}</textarea>
    @error('description')
        <div class="error-message">{{ $message }}</div>
    @enderror

    <!-- 商品画像 -->
    <label for="image">商品画像</label>
    <input type="file" name="image" id="image">
    <p class="current-image">現在の画像: {{ $product->image }}</p>
    @error('image')
        <div class="error-message">{{ $message }}</div>
    @enderror


        <!-- ボタン -->
        <div class="button-group">
            <a href="{{ route('product.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-save">変更を保存</button>
        </div>
    </form>

    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">ゴミ箱</button>
    </form>

</div>
@endsection
