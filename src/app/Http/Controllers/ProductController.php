<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    // 商品一覧
    public function index()
    {
        $products = Product::paginate(6); // ここで $products を取得
        return view('products.index', compact('products')); // ビューに渡す
    }

    // 商品詳細
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品登録フォーム
    public function create()
    {
        return view('products.create');
    }

    // 商品登録処理
    public function store(Request $request)
    {
            // バリデーション
$request->validate([
    'name' => 'required|string',
    'price' => 'required|numeric|min:0|max:10000',
    'season' => 'required|array',
    'season.*' => 'in:春,夏,秋,冬',
    'description' => 'required|string|max:120',
    'image' => 'required|image|mimes:png,jpeg|max:2048',
], [
    'name.required' => '商品名を入力してください',
    'price.required' => '値段を入力してください',
    'price.numeric' => '数値で入力してください',
    'price.min' => '値段は0円以上で入力してください',
    'price.max' => '値段は10000円以下で入力してください',
    'season.required' => '季節を選択してください',
    'season.array' => '季節を選択してください',
    'season.*.in' => '季節は「春、夏、秋、冬」から選択してください',
    'description.required' => '商品説明を入力してください',
    'description.max' => '商品説明は120文字以内で入力してください',
    'image.required' => '商品画像を登録してください',
    'image.image' => 'アップロードするファイルは画像である必要があります',
    'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
]);

    // 画像のアップロード処理
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public');
    } else {
        // 画像が指定されていない場合はエラーメッセージを返す
        return back()->withErrors(['image' => '商品画像は必須です。']);
    }

    // 商品の保存
    Product::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'image' => $imagePath,
        'description' => $request->input('description'),
        'season' => implode(',', $request->input('season')), // 配列をカンマ区切りの文字列に変換
    ]);

    return redirect()->route('products.index');
    }

    // 商品更新フォーム
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }

    // 商品更新処理
    public function update(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable'
        ]);

        $product = Product::findOrFail($productId);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    // 商品検索
    public function search(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('keyword')) {
            $query->where('name', 'like', "%{$request->keyword}%");
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }

    // 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}