@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__heading">
        <h2>商品登録</h2>
    </div>
    <div class="register-form__inner">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="register-form__contents">
                <div class="register-form__input-group">
                    <div class="register-form__group">
                        <div class="register-form__label-group">
                            <label class="register-form__label" for="name">商品名<span class="register-form__required">必須</span></label>
                        </div>
                        <input class="register-form__input" type="text" name="name" id="name" placeholder="商品名を入力" >
                        <p class="register-form__error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                        </p>
                    </div>
                    <div class="register-form__group">
                        <div class="register-form__label-group">
                            <label class="register-form__label" for="price">値段<span class="register-form__required">必須</span></label>
                        </div>
                        <input class="register-form__input" type="number" name="price" id="price" placeholder="値段を入力" >
                        <p class="register-form__error-message">
                        @error('price')
                        {{ $message }}
                        @enderror
                        </p>
                    </div>
                    <div class="register-form__group">
                        <div class="register-form__label-group">
                            <label class="register-form__label">商品画像<span class="register-form__required">必須</span></label>
                        </div>
                        <input class="image__select-btn btn" type="file" name="image" accept=".png,.jpeg,.jpg" value="ファイルを選択" >
                        <p class="register-form__error-message">
                        @error('image')
                        {{ $message }}
                        @enderror
                        </p>
                    </div>
                    <div class="register-form__group">
                        <div class="register-form__label-group">
                            <label class="register-form__label">季節<span class="register-form__required">必須</span></label>
                        </div>
                        <div class="register-form__season-inputs">
                            @foreach($seasons as $season)
                            <div class="register-form__season-option">
                                <label class="register-form__season-label">
                                <input class="register-form__season-input" name="season[]" type="checkbox" value="{{ $season->id }}" {{ (is_array(old('season')) && in_array($season->id, old('season'))) ? 'checked' : '' }} >
                                    <span class="register-form__season-text">{{ $season['name'] }}</span>
                                </label>
                            </div>
                            @endforeach
                        <p class="register-form__error-message">
                            @error('season')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="register-form__input-description">
                    <div class="register-form__label-group">
                        <label class="register-form__label" for="description">商品説明<span class="register-form__required">必須</span></label>
                    </div>
                    <textarea class="register-form__textarea" name="description" id="" cols="30" rows="10" placeholder="商品の説明を入力" >{{ old('description') }}</textarea>
                    <p class="register-form__error-message">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__btn-inner">
                    <button type="button" class="register-form__back-btn" onclick="location.href='{{ route('products.index') }}'">戻る</button>
                    <input class="register-form__send-btn" type="submit" value="登録" name="send">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection