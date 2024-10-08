@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection


@section('content')
    <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Contact</h2>
        </div>
        <form class="form" action="/contacts" method="POST">
            @csrf
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" name="name" value="{{ $name }}" readonly />
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            <input type="text" name="gender_name" value="{{ $gender_name }}" readonly />
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            <input type="tel" name="phone" value="{{ $phone }}" readonly />
                            <input type="hidden" name="tell" value="{{ $tell }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            <input type="text" name="category" value="{{ $category['content'] }}" readonly />
                            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form__button-zone">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                </div>
                <div class="form__button">
                    <input class="form__button-back"
                    type="button" onclick="history.back()" value="修正">
                </div>
            </div>
        </form>
    </div>
@endsection
