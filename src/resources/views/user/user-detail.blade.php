@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/user-detail.css') }}">
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
                    <input class="form__input form__input--name" type="text" name="name" value="{{ $user->name }}"readonly>
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">日付</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="2023年">
                    <input class="form__input"  type="text" value="{{ $attendanceRecord['date'] }}">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">出勤・退勤</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="{{ $attendanceRecord['clock_in'] }}">
                    <p>〜</p>
                    <input class="form__input" type="text" value="{{ $attendanceRecord['clock_out'] }}">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">休憩</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="{{ $attendanceRecord['break_in'] }}">
                    <p>〜</p>
                    <input class="form__input" type="text" value="{{ $attendanceRecord['break_out'] }}">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">休憩2</p>
                <div class="form__input-group">
                    <input class="form__input" type="text" value="{{ $attendanceRecord['break2_in'] }}">
                    <p>〜</p>
                    <input class="form__input" type="text" value="{{ $attendanceRecord['break2_out'] }}">
                </div>
            </div>
            <div class="form__group">
                <p class="form__header">備考</p>
                <div class="form__input-group">
                    <textarea class="form__textarea" name="comment" id="">{{ $attendanceRecord['comment'] }}</textarea>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button--submit">修正</button>
        </div>
    </form>
</div>
@endsection