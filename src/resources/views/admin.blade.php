@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('login_or_logout')
    <form class="form" action="/logout" method="post">
        @csrf
        <button class="header-nav__button">logout</button>
    </form>
@endsection

@section('content')
    <div class="admin-container">
        <h1 class="admin-title">Admin</h1>

        <div class="admin-search">
            <form action="/admin/search" method="GET">
                @csrf
                <input type="text" class="search-input" name="keyword" placeholder="名前やメールアドレスを入力してください"
                    value="{{ request('keyword') }}">
                <select class="search-select_gender" name="gender">
                    <option value="">性別</option>
                    <option value="">全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
                <select class="search-select_category" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                            {{ request('category_id') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['content'] }}</option>
                    @endforeach
                </select>
                <input type="date" class="search-date" name="date" value="{{ request('date') }}">
                <button class="search-button">検索</button>
                <input class="reset-button" type="reset" value="リセット">
            </form>
        </div>
        <div class="admin-controls">
            <form action="/admin/export" method="GET">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button class="export-button">エクスポート</button>
            </form>
            <div class="pagination">
                {{ $contacts->links('vendor.pagination.custom') }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->gender }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact['category']['content'] }}</td>
                        <td><a href="#modal-{{ $contact->id }}" class="detail-button">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- モーダルウィンドウ -->
        @foreach ($contacts as $contact)
            <div id="modal-{{ $contact->id }}" class="modal">
                <div class="modal-content">
                    <a href="#" class="close">×</a>
                    <table class="modal-table">
                        <tr>
                            <th>お名前</th>
                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td>{{ $contact->gender }}</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{{ $contact->tell }}</td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>{{ $contact->address }}</td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td>{{ $contact->building ?? 'なし' }}</td>
                        </tr>
                        <tr>
                            <th>お問い合わせの種類</th>
                            <td>{{ $contact['category']['content'] }}</td>
                        </tr>
                        <tr>
                            <th>お問い合わせ内容</th>
                            <td>{{ $contact->detail }}</td>
                        </tr>
                    </table>
                    <form action="{{ route('admin.contact.delete', ['id' => $contact->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="button-container">
                            <button class="delete-button">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endsection
