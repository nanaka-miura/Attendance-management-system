@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/staff-list.css') }}">
@endsection

@section('content')
<div class="staff-list__content">
    <div class="content__header">
        <h2 class="content__header--item">スタッフ一覧</h2>
    </div>
    <table class="table">
        <tr class="table__row">
            <th class="table__header">
                <p class="table__header--item">名前</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">メールアドレス</p>
            </th>
            <th class="table__header">
                <p class="table__header--item">月次勤怠</p>
            </th>
        </tr>
        <tr class="table__row">
            <td class="table__description">
                <p class="table__description--item">山田　太郎</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">taro.y@coachtech.com</p>
            </td>
            <td class="table__description">
                <a class="table__item--detail-link" href="">詳細</a>
            </td>
        </tr>
        <tr class="table__row">
            <td class="table__description">
                <p class="table__description--item">西　怜奈</p>
            </td>
            <td class="table__description">
                <p class="table__description--item">reina.n@coachtech.com</p>
            </td>
            <td class="table__description">
                <a class="table__item--detail-link" href="">詳細</a>
            </td>
        </tr>
    </table>
</div>
@endsection
