@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
@endsection

@section('content')
<div class="list-form">
    <div class="list-heading">
        <h2 class="list-heading__heading">商品一覧</h2>
        <form action="{{ route('register.form') }}" method="POST">
            @csrf
            <input class="header__link" type="submit" value="+ 商品を追加">
        </form>
    </div>
    <div class="list-form__inner">
        <div class="list-form__group">
            <div class="list-form__group-sidebar">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="search-form__card">
                        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ $keyword ?? ''}}">
                        <input class="list-form__search-btn btn" type="submit" value="検索">
                    </div>
                    <div class="sort-form__price">
                        <h3 class="sort-form__label">価格順で表示</h3>
                        <div class="sort-form__select-inner">
                            <div class="sort-form__select-wrapper">
                                <select class="sort-form__select" name="sort" onchange="this.form.submit()">
                                    <option disabled {{ request('sort') === null ? 'selected' : '' }}>価格で並べ替え</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                                </select>
                                <input type="hidden" name="input" value="{{ request('input') }}">
                            </div>
                            @if(request('sort'))
                                <div class="sort-tag">
                                    <span class="sort-tag__label">{{ request('sort') === 'asc' ? '低い順に表示' : '髙い順に表示' }}</span>
                                    <a href="{{ route('products.index', array_filter(request()->except('sort'))) }}" class="sort-tag__close">×</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class=list-form__contents-inner>
                <div class="list-form__group-contents">
                    @forelse($products as $product)
                        <div class="card-content">
                            <a href="{{ route('products.detail', ['productId' => $product ->id]) }}">
                            <img class="card" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"></a>
                            <div class="info">
                                <p class="name">{{ $product->name }}</p>
                                <p class="price">¥{{ number_format($product->price) }}</p>
                            </div>
                        </div>
                    @empty
                        <p>該当する商品が見つかりませんでした。</p>
                    @endforelse
                    <div class="pagination">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection