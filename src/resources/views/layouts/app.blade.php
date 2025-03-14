<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'mogitate')</title>
    
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    @yield('css') {{-- 各ページごとのCSS --}}
</head>
<body>
    <header class="header">
        <label><a href="{{ route('products.index') }}">mogitate</label>
    </header>

    <main>
    @yield('content')
  </main>

    @yield('scripts')

</body>
</html>
