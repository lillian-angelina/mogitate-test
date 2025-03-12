{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endsection

@section('title', '商品詳細')

@section('content')
<div class="product-detail">
    <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="product-detail__body">
            <!-- 左側：画像 -->
            <div class="product-detail__image">
                <div class="breadcrumb">
                    <a href="{{ route('products.index') }}">商品一覧</a> &gt; {{ $product->name }}
                </div>
                <p>現在の画像:</p>
                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <p>画像を変更:</p>
                <input type="file" name="image" id="image" onchange="previewImage()">

                <!-- 画像の下に商品説明 -->
                <div class="product-detail__description">
                    <label for="description">商品説明:</label>
                    <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- 右側：商品情報 -->
            <div class="product-detail__info">
                <div class="product-detail__header">
                    <label for="name">商品名:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                </div>

                <div class="product-detail__price">
                    <label for="price">価格:</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
                </div>

                <div class="product-detail__season">
                    <p><strong>季節</strong></p>
                    @php
                                // データが配列ではなく、カンマ区切りの文字列で保存されている場合を考慮
                                $selectedSeasons = is_array($product->season) ? $product->season : explode(',', $product->season);
                    @endphp

                    <label><input type="checkbox" name="season[]" value="春" {{ in_array(trim('春'), $selectedSeasons) ? 'checked' : '' }}> 春</label>
                    <label><input type="checkbox" name="season[]" value="夏" {{ in_array(trim('夏'), $selectedSeasons) ? 'checked' : '' }}> 夏</label>
                    <label><input type="checkbox" name="season[]" value="秋" {{ in_array(trim('秋'), $selectedSeasons) ? 'checked' : '' }}> 秋</label>
                    <label><input type="checkbox" name="season[]" value="冬" {{ in_array(trim('冬'), $selectedSeasons) ? 'checked' : '' }}> 冬</label>
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
        <button type="submit" class="delete-button">🗑️ 削除</button>
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
