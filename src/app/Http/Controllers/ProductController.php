<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();

        // 🔍 検索条件（商品名または説明）
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // ↕️ ソート条件（価格順）
        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        // 📄 ページネーション
        $products = $query->paginate(6)->appends($request->all());

        return view('products', compact('products', 'keyword', 'sort'));
    }



    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all(); // ← これを追加
        return view('detail', compact('product','seasons'));
    }


    public function update(ProductRequest $request, $productId)
    {
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
        }

        $product = Product::findOrFail($productId);

        // 画像が新しくアップロードされた場合のみ更新
        if ($request->hasFile('image')) {
            // 古い画像がある場合は削除
            if ($product->image && \Storage::exists('public/' . $product->image)) {
                \Storage::delete('public/' . $product->image);
            }

            // 新しい画像を保存
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // 商品情報を更新
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // 中間テーブル（季節）も更新
        $product->seasons()->sync($request->season);

        return redirect()->route('products.index');
    }


    public function destroy(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // 中間テーブル（seasonsとの多対多）も解除する
        $product->seasons()->detach();

            // 画像を削除（存在すれば）
        if ($product->image && \Storage::exists('public/' . $product->image)) {
            \Storage::delete('public/' . $product->image);
        }

        // 商品本体を削除
        $product->delete();

        return redirect()->route('products.index');
    }


    public function showRegisterForm()
    {
        $product = new Product(); // 空のインスタンス（formで使う場合）
        $seasons = Season::all();
        return view('register', compact('product', 'seasons'));
    }


    public function register(ProductRequest $request)
    {
    if ($request->has('back')) {
            return redirect()->route('products.index')->withInput();
        }

    $imagePath = $request->file('image')->store('images','public');
    $image = 'storage/' . $imagePath;


    // products テーブルに登録
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    // 中間テーブルに登録（多対多）
    $product->seasons()->attach($request->season);

    return redirect()->route('products.index');
    }
}
