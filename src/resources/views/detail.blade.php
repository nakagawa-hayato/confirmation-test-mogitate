@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail-form">
    <div class="detail-form__inner">
        <div class="breadcrumb">
            <a href="{{ route('products.index') }}">商品一覧</a> > <span>{{ $product->name ?? '商品名' }}</span>
        </div>
        <form action="{{ route('products.update', ['productId' => $product->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="detail-form__contents">
                <div class="detail-form__contents-group">
                    <div class="detail-form__image-select">
                        @if (!empty($product->image))
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="card-image-preview">
                        @endif
                        <input class="image__select-btn btn" type="file" name="image" accept=".png,.jpeg,.jpg" value="ファイルを選択">
                        <p class="detail-form__error-message">
                            @error('image')
                            {{ $message }}
                            @enderror
                            </p>
                    </div>
                    <div class="detail-form__input-group">
                        <div class="detail-form__group">
                            <label class="detail-form__label" for="name">商品名</label>
                            <input class="detail-form__input" type="text" name="name" id="name" placeholder="商品名を入力" value="{{ old('name', $product->name) }}">
                            <p class="detail-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                            </p>
                        </div>
                        <div class="detail-form__group">
                            <label class="detail-form__label" for="price">値段</label>
                            <input class="detail-form__input" type="number" name="price" id="price" placeholder="値段を入力" value="{{ old('price', $product->price) }}">
                            <p class="detail-form__error-message">
                            @error('price')
                            {{ $message }}
                            @enderror
                            </p>
                        </div>
                        <div class="detail-form__group">
                            <label class="detail-form__label">季節</label>
                            <div class="detail-form__season-inputs">
                                @php
                                    // DBの関連づけから選択されたseason_id一覧を取得
                                    $selectedSeasons = old('season') ?? $product->seasons->pluck('id')->toArray();
                                @endphp

                                @foreach($seasons as $season)
                                    <div class="register-form__season-option">
                                        <label class="register-form__season-label">
                                            <input class="register-form__season-input"
                                                name="season[]"
                                                type="checkbox"
                                                value="{{ $season->id }}"
                                                {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                                            <span class="register-form__season-text">{{ $season->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <p class="detail-form__error-message">
                                    @error('season')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-form__input-description">
                    <label class="detail-form__label" for="description">商品説明</label>
                    <textarea class="detail-form__textarea" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                    <p class="detail-form__error-message">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="detail-form__btn-area">
                <div class="detail-form__btn-inner">
                    <button type="button" class="detail-form__back-btn" onclick="location.href='{{ route('products.index') }}'">戻る</button>
                    <input class="detail-form__send-btn" type="submit" value="変更を保存" name="send">
                </div>
            </div>
        </form>

        <div class="detail-form__delete-area">
            <form class="detail-form__delete-form" action="{{ route('products.delete', ['productId' => $product->id]) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class="detail-form__delete-btn">🗑</button>
            </form>
        </div>
    </div>
</div>
@endsection
