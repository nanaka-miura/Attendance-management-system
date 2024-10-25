@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-application-detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__header">
        <h2 class="content__header--item">勤怠詳細</h2>
    </div>
    <form class="applied-form" action="">
        <div class="applied-form__content">
            <div class="applied-form__group">
                <p class="applied-form__header">名前</p>
                <div class="applied-form__input-group">
                    <input class="applied-form__input" type="text" name="name" value="西　怜奈" readonly>
                </div>
            </div>
            <div class="applied-form__group">
                <p class="applied-form__header">日付</p>
                <div class="applied-form__input-group">
                    <input class="applied-form__input" type="text" value="2023年" readonly>
                    <input class="applied-form__input"  type="text" value="10月21日" readonly>
                </div>
            </div>
            <div class="applied-form__group">
                <p class="applied-form__header">出勤・退勤</p>
                <div class="applied-form__input-group">
                    <input class="applied-form__input" type="text" value="9:00" readonly>
                    
                    <p>〜</p>

                    <input class="applied-form__input" type="text" value="18:00" readonly>
                </div>
            </div>
            <div class="applied-form__group">
                <p class="applied-form__header">休憩</p>
                <div class="applied-form__input-group">
                    <input class="applied-form__input" type="text" value="12:00" readonly>
                    <p>〜</p>
                    <input class="applied-form__input" type="text" value="13:00" readonly>
                </div>
            </div>
            <div class="applied-form__group">
                <p class="applied-form__header">休憩2</p>
                <div class="applied-form__input-group">
                    <input class="applied-form__input" type="text" readonly>
                    <p>〜</p>
                    <input class="applied-form__input" type="text" readonly>
                </div>
            </div>
            <div class="applied-form__group">
                <p class="applied-form__header">備考</p>
                <div class="applied-form__input-group">
                    <textarea class="applied-form__textarea" name="comment" id="" readonly>電車遅延のため</textarea>
                </div>
            </div>
        </div>
        <div class="applied-form__button">
            @if()
            <button class="applied-form__button--submit">承認</button>
            @elseif
            <button class="approved-form__button--submit">承認済み</button>
        </div>
    </form>
</div>
@endsection
