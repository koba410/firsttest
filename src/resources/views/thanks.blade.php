@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__background">
        <p class="thanks__background-word">Thank you</p>
    </div>
    <div class="thanks__content">
        <div class="thanks__heading">
            <h2>お問い合わせありがとうございました</h2>
        </div>
        <div class="home__button">
            <a class="home__button-submit" href="/">HOME</a>
        </div>
    </div>
@endsection
