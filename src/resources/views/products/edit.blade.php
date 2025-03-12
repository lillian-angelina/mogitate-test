@extends('layouts.app')

@section('content')
    <h1>商品編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        <label>商品名: <input type="text" name="name" value="{{ $product->name }}"></label>
        <label>価格: <input type="number" name="price" value="{{ $product->price }}"></label>
        <label>説明: <textarea name="description">{{ $product->description }}</textarea></label>
        <button type="submit">更新</button>
    </form>
    <a href="{{ route('products.index') }}">戻る</a>
@endsection
