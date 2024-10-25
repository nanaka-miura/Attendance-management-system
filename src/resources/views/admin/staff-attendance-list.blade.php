@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/staff-attendance-list.css') }}">
@endsection

@section('content')
<div class="attendance-list__content">
    <div class="content__header">
        <h2 class="content__header--item">西怜奈さんの勤怠</h2>
    </div>
    <div class="content__menu">
        <a class="previous-month" href="">前月</a>
        <p class="current-month">2024/10</p>
        <a class="next-month" href="">翌月</a>
    </div>
    <table class="table">
        <tr class="table__row">
            <th class="table__header">
                <p class="table__header--item">日付</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">出勤</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">退勤</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">休憩</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">合計</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">詳細</p>
            </th>
        </tr>
        <tr class="table__row">
            <td class="table__description">
                <p class="table__description--item">10/21(水)</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">9:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">18:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">1:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">8:00</p>
            </td>
            <td class="table__description">
                <a class="table__item--detail-link" href="">詳細</a>
            </td>
        </tr>
        <tr class="table__row">
            <td class="table__description">
                <p class="table__description--item">10/21(水)</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">9:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">18:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">1:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">8:00</p>
            </td>
            <td class="table__description">
                <a class="table__item--detail-link" href="">詳細</a>
            </td>
        </tr>
        <tr class="table__row">
            <td class="table__description">
                <p class="table__description--item">10/21(水)</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">9:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">18:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">1:00</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">8:00</p>
            </td>
            <td class="table__description">
                <a class="table__item--detail-link" href="">詳細</a>
            </td>
        </tr>
    </table>
    <div class="csv-button">
        <button class="csv-button__submit">CSV出力</button>
    </div>
</div>
@endsection
