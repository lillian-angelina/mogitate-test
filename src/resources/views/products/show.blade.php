{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endsection

@section('title', '商品詳細')

@section('content')
<div class="product-detail">
    <form class="product-detail__form" action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="product-detail__body">
            <!-- 左側：画像 -->
            <div class="product-detail__image">
                <div class="breadcrumb">
                    <a href="{{ route('products.index') }}">商品一覧</a> &gt; {{ $product->name }}
                </div>
                <div class="product-detail__image--img">
                    <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <input type="file" name="image" id="image" onchange="previewImage()">
                </div>
                <!-- 画像の下に商品説明 -->
                <div class="product-detail__description">
                    <label for="description">商品説明</label>
                    <textarea class="product-detail__textarea" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- 右側：商品情報 -->
            <div class="product-detail__info">
                <div class="product-detail__header">
                    <p><label for="name">商品名</label></p>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                </div>

                <div class="product-detail__price">
                    <p><label for="price">価格</label></p>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
                </div>

                <div class="product-detail__season">
                    <p><strong>季節</strong></p>
                        @php
                            // 商品に関連する季節を取得
                            $selectedSeasons = $product->seasons->pluck('id')->toArray();
                        @endphp

                        @foreach ($seasons as $season)
                    <label>
                        <input type="checkbox" name="season[]" value="{{ $season->id }}" 
                                {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                        @endforeach
                </div>
            </div>
        </div>

        <div class="product-detail__footer">
            <a href="{{ route('products.index') }}" class="product-detail__footer--button">戻る</a>
            <button class="product-detail__footer--submit" type="submit">変更を保存</button>
        </div>
    </form>
           <!-- 削除ボタン -->
           <form action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">🗑️</button>
    </form>
</div>

<script>
    // 画像プレビューの処理
    function previewImage() {
        const file = document.getElementById('image').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            document.getElementById('image-preview').src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
