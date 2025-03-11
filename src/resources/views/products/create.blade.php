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
        <input class="item-name__sub" type="text" name="name" id="name" value="{{ old('name', $product['name']) }}" required>
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
        <p class="item-name__main" for="price">値段<span class="from_item--required">必須</span></p>
        <input class="item-name__sub" type="number" name="price" id="price" value="{{ old('price', $product['price']) }}" required>
        <div class="form__error">
            @error('price')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
    
        <p class="item-name__main" for="image">商品画像<span class="from_item--required">必須</span></p>
        <input class="item-name__sub" type="file" name="image" id="image" required>
        @error('image')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <p class="season__group">季節<span class="from_item--required">必須</span><span class="from_item--text">複数選択可</span></p>
        <div class="season__options">
            <label>
                <input type="checkbox" name="season[]" value="春" {{ is_array(old('season')) && in_array('春', old('season')) ? 'checked' : '' }}> 春
            </label>
            <label>
                <input type="checkbox" name="season[]" value="夏" {{ is_array(old('season')) && in_array('夏', old('season')) ? 'checked' : '' }}> 夏
            </label>
            <label>
                <input type="checkbox" name="season[]" value="秋" {{ is_array(old('season')) && in_array('秋', old('season')) ? 'checked' : '' }}> 秋
            </label>
            <label>
                <input type="checkbox" name="season[]" value="冬" {{ is_array(old('season')) && in_array('冬', old('season')) ? 'checked' : '' }}> 冬
            </label>
        </div>
        @error('season')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="item__explamation">
            <p class="item__explanation--label" for="description">商品説明<span class="from_item--required">必須</span></p>
            <textarea class="item__explanation--textarea" name="description" id="description" required>{{ old('description', $product['description']) }}</textarea>
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
