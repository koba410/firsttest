@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Contact</h2>
        </div>
        <form class="form" action="/confirm" method="POST">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--name">
                        <input type="text" name="first_name" placeholder="例：山田" value="{{ old('first_name') }}" />
                        <input type="text" name="last_name" placeholder="例：太郎" value="{{ old('last_name') }}" />
                    </div>
                    <div class="form__error">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        @error('last_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--radio">
                        <input type="radio" name="gender" value="1" checked="checked"> 男性
                        <input type="radio" name="gender" value="2"> 女性
                        <input type="radio" name="gender" value="3"> その他
                    </div>
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--tel">
                        <input type="tel" name="phone1" placeholder="080" value="{{ old('phone1') }}"><span> - </span>
                        <input type="tel" name="phone2" placeholder="1234" value="{{ old('phone2') }}"><span> - </span>
                        <input type="tel" name="phone3" placeholder="5678" value="{{ old('phone3') }}">
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('phone1')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('phone2')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('phone3')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
                            value="{{ old('address') }}" />
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例：千駄ヶ谷区マンション101"
                            value="{{ old('building') }}" />
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}" @if (old('category_id', $inputTerm ?? '') == $category['id']) selected @endif>
                                    {{ $category['content'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="資料をいただきたいです" value="{{ old('detail') }}"></textarea>
                    </div>
                    <div class="form__error">
                        <!--バリデーション機能を実装したら記述します。-->
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面へ</button>
            </div>
        </form>
    </div>
@endsection
