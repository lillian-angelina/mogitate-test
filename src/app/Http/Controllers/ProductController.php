<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;


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
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all(); // seasons テーブルのデータを取得
    
        return view('products.show', compact('product', 'seasons'));
    }

    // 商品登録フォーム
    public function create()
    {
        $seasons = Season::all(); // 全ての季節データを取得
        return view('products.create', compact('seasons')); 
    }

    // 商品登録処理
    public function store(ProductRequest $request)
    {    
        // バリデーション
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'required|array',
            'season.*' => 'exists:seasons,id', // 季節IDが `seasons` テーブルに存在するかチェック
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
    
        // 'season' が文字列の場合、配列に変換
        $seasonArray = is_string($request->input('season')) 
            ? explode(',', $request->input('season')) 
            : $request->input('season');
    
        // 配列をカンマ区切りの文字列に変換
        $seasonString = implode(',', $seasonArray);
    
        // 商品の保存
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->file('image')->store('images', 'public'),
            'description' => $request->description,
        ]);
    
        // 選択された季節を `product_season` に保存
        foreach ($request->season as $season_id) {
            ProductSeason::create([
                'product_id' => $product->id,
                'season_id' => $season_id,
            ]);
        }
    
        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }
    
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
    
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'season' => 'nullable|array', // 季節は配列で受け取る
            'season.*' => 'exists:seasons,id' // 各値はseasonsテーブルのidであること
        ]);
    
        // フォームの値を保存
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
    
        // 画像の更新処理
        if ($request->hasFile('image')) {
            // 既存の画像を削除（必要なら）
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
    
            // 新しい画像を保存
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
    
        $product->save(); // 商品情報を保存
    
        // 季節の更新（product_season の中間テーブルを更新）
        if ($request->has('season')) {
            $product->seasons()->sync($request->season); // 選択された季節のみ更新
        } else {
            $product->seasons()->detach(); // 季節の選択がなければ関連を削除
        }
    
        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }
    
    // 商品検索
    public function search(Request $request)
    {
        $query = Product::query();
    
        // 商品名で検索
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', "%{$request->keyword}%");
        }

            // 価格順の並び替え
    if ($request->has('sort_price') && in_array($request->sort_price, ['asc', 'desc'])) {
        $query->orderBy('price', $request->sort_price);
        }
    
        // ページネートを使用して結果を表示
        $products = $query->paginate(6);  // 1ページあたり6件の商品を表示
    
        return view('products.index', compact('products'));
    }
    // 商品削除
    public function destroy($productId)
    {
    $product = Product::findOrFail($productId);
    $product->delete();
    return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

    public function edit($id)
    {
    $product = Product::findOrFail($id);
    $seasons = Season::all();
    return view('products.edit', compact('product', 'seasons'));
    }

}