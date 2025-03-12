@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title', '商品一覧')

@section('content')
<div class="store">
    <!-- 上部タイトル -->
    <div class="store__form">
        <label>商品一覧</label>
        <a class="add-product-btn" href="{{ route('products.create') }}">+ 商品追加</a>
    </div>

    <!-- 検索サイドバーと商品一覧を並べる -->
    <div class="store__content">
        <!-- 検索サイドバー -->
        <aside class="store__sidebar">
            <form class="form" action="{{ route('products.search') }}" method="GET">
                @csrf
                <div class="store__keyword">
                    <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                    <button class="button-submit" type="submit">検索</button>
                </div>
            </form>

            <!-- 並び替えセレクトボックス -->
            <form class="form-second" action="{{ route('products.search') }}" method="GET">
                @csrf
                <label class="form-second__label" for="sort_price">価格順で表示</label>
                <select class="form-second__select" name="sort_price" id="sort_price" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>安い順</option>
                    <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </form>
        </aside>

        <!-- 商品一覧 -->
        <div class="store__products">
            @foreach($products as $product)
                <div class="store__product-item">
                     <!-- 商品画像にリンクを追加 -->
                     <a href="{{ route('products.show', ['productId' => $product->id]) }}">
                    <!-- 商品画像 -->
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <p>画像がありません</p>
                    @endif

                    <!-- 商品名（画像の左下外） -->
                    <div class="product-name">{{ $product->name }}</div>

                    <!-- 商品価格（画像の右下外） -->
                    <div class="product-price">¥{{ number_format($product->price) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ページネーション -->
    <footer>
        <div class="pagination">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </footer>
</div>
@endsection
