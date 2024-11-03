@extends('layouts.app')

@section('title', '商品一覧')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('content')
<div class="product-list-container">
    <!-- 左側のサイドバー -->
    <div class="sidebar">
        <h1 class="page-title">商品一覧</h1>

        <!-- 検索フォーム -->
        <form action="{{ route('product.index') }}" method="GET">
            <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
            <button type="submit" class="btn-search">検索</button>
        </form>

        <!-- 並べ替え機能 -->
        <div class="sort-dropdown">
            <label for="sort">価格順で表示</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">価格で並べ替え</option>
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>安い順に表示</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
            </select>
        </div>

        <!-- 並び替え条件タグ表示 -->
        @if(request('sort'))
            <div class="sort-tag">
                <span>価格: {{ request('sort') === 'asc' ? '安い順' : '高い順' }}</span>
                <a href="{{ route('product.index', ['search' => request('search')]) }}" class="reset-sort">×</a>
            </div>
        @endif
    </div>

    <!-- 商品一覧と商品追加ボタンの配置 -->
    <div class="main-content">
        <a href="{{ route('product.create') }}" class="btn-primary">+ 商品を追加</a>

        <!-- 商品グリッド -->
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
