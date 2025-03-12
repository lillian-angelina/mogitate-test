@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('title', '商品登録')

@section('content')
    <div class="title">
        <p>商品登録</p>
    </div>
<form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="item-name">
        <p class="item-name__main" for="name">商品名<span class="from_item--required">必須</span></p>
        <input class="item-name__sub" type="text" name="name" id="name"  placeholder="商品名を入力" value="{{ old('name', $product['name'] ?? '') }}">
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
        <p class="item-name__main" for="price">値段<span class="from_item--required">必須</span></p>
        <input class="item-name__sub" type="number" name="price" id="price" placeholder="値段を入力" value="{{ old('price', $product['price'] ?? '') }}">
        <div class="form__error">
            @error('price')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
    
        <p class="item-name__main" for="image">商品画像<span class="from_item--required">必須</span></p>

        <!-- 画像のプレビュー -->
        <div class="image-preview">
            <img id="image-preview" src="{{ asset('storage/images/your-image.jpg') }}" alt="Image Preview" style="display: none;">
        </div>
        
        <input class="picture" type="file" name="image" id="image" onchange="previewImage()">

        @error('image')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <p class="season__group">季節<span class="from_item--required">必須</span><span class="from_item--text">複数選択可</span></p>
        <div class="season__options">
            <label>
                <input class="season__options--season" type="checkbox" name="season[]" value="春" {{ is_array(old('season')) && in_array('春', old('season')) ? 'checked' : '' }}> 春
            </label>
            <label>
                <input class="season__options--season" type="checkbox" name="season[]" value="夏" {{ is_array(old('season')) && in_array('夏', old('season')) ? 'checked' : '' }}> 夏
            </label>
            <label>
                <input class="season__options--season" type="checkbox" name="season[]" value="秋" {{ is_array(old('season')) && in_array('秋', old('season')) ? 'checked' : '' }}> 秋
            </label>
            <label>
                <input class="season__options--season" type="checkbox" name="season[]" value="冬" {{ is_array(old('season')) && in_array('冬', old('season')) ? 'checked' : '' }}> 冬
            </label>
        </div>
        @error('season')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="item__explamation">
            <p class="item__explanation--label" for="description">商品説明<span class="from_item--required">必須</span></p>
            <textarea class="item__explanation--textarea" name="description" id="description" placeholder="商品の説明を入力">{{ old('description', $product['description'] ?? '') }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="item-button">
            <button class="item-button__edit" type="button" onclick="history.back()">戻る</button>
            <button class="item-button__submit" type="submit">登録</button>
        </div>
    </div>
</form>

@endsection

@section('scripts')
    <script>
        // 画像プレビュー表示の関数
        function previewImage() {
            const file = document.getElementById('image').files[0]; // 選択されたファイル
            const reader = new FileReader(); // ファイルリーダーのインスタンス作成

            reader.onloadend = function () {
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = reader.result; // プレビュー画像を設定
                imagePreview.style.display = 'block'; // プレビュー画像を表示
            }

            if (file) {
                reader.readAsDataURL(file); // ファイルをDataURLとして読み込む
            } else {
                // ファイルが選択されなかった場合
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = ''; // プレビュー画像をリセット
                imagePreview.style.display = 'none'; // プレビューを非表示
            }
        }
    </script>
@endsection
