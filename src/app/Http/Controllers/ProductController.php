<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    // 商品一覧を表示
    public function index(Request $request)
    {
        $query = Product::query();

        // 検索機能
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        // 並べ替え機能
        if ($request->has('sort') && in_array($request->input('sort'), ['asc', 'desc'])) {
            $query->orderBy('price', $request->input('sort'));
        }

        // ６件ごとにページネーション
        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    // 商品詳細を表示
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品登録画面を表示
    public function create()
    {
        return view('products.register');
    }

    // 商品を保存
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        // 商品画像を保存
        $imagePath = $request->file('image')->store('images', 'public');

        // 新しい商品を作成
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->image = $imagePath;
        $product->description = $validatedData['description'];
        $product->save();

        // 中間テーブルに季節を保存
        if ($request->has('season')) {
            $product->seasons()->sync($validatedData['season']);
        }

        return redirect()->route('product.index')->with('success', '商品を登録しました');
    }

    // 商品編集画面を表示
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }

    // 商品の更新
    public function update(ProductRequest $request, $productId)
    {
        // 商品を取得
        $product = Product::findOrFail($productId);

        // 商品情報の更新
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 画像の更新処理
        if ($request->hasFile('image')) {
            // 既存の画像がある場合は削除
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            // 新しい画像を保存 (storage/app/public/images に保存)
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // 季節情報を中間テーブルで同期
        if ($request->has('season')) {
            $product->seasons()->sync($request->input('season'));
        }

        // 更新した情報を保存
        $product->save();

        // 商品一覧ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('product.index')->with('success', '商品を更新しました');
    }

    // 商品を削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 画像ファイルの削除
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        // データベースから商品を削除
        $product->delete();

        return redirect()->route('product.index')->with('success', '商品を削除しました');
    }

    // 商品を検索
    public function search(Request $request)
    {
        $query = $request->input('search');
        $products = Product::where('name', 'LIKE', "%$query%")->paginate(10);

        return view('products.index', compact('products'));
    }
}
