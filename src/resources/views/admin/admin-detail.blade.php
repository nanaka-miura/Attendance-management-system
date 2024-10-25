@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__header">
        <h2 class="content__header--item">勤怠詳細</h2>
    </div>
    <form class="form" action="">
        <div class="form__content">
            <div class="form__group">
                <p class="form__header">名前</p>
                <div class="form__input-group">
                    <input class="form__input form__input--name" type="text" name="name" value="西　怜奈"readonly>
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">日付</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="2023年">
                    <input class="form__input"  type="text" value="10月21日">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">出勤・退勤</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="9:00">
                    <p>〜</p>
                    <input class="form__input" type="text" value="18:00">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">休憩</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="12:00">
                    <p>〜</p>
                    <input class="form__input" type="text" value="13:00">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">休憩2</p>
                <div class="form__input-group">
                    <input class="form__input" type="text">
                    <p>〜</p>
                    <input class="form__input" type="text">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">備考</p>
                <div class="form__input-group">
                    <textarea class="form__textarea" name="comment" id=""></textarea>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button--submit">修正</button>
        </div>
    </form>
</div>
@endsection
