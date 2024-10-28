@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin-application-list.css') }}">
@endsection

@section('content')
<div class="application-list__content">
    <div class="content__header">
        <h2 class="content__header--item">申請一覧</h2>
    </div>
    <div class="application__tab">
        <input class="application__tab--input" id="tab1" type="radio" name="tab_item" checked>
        <label class="application__tab--label" for="tab1">承認待ち</label>
        <input class="application__tab--input" id="tab2" type="radio" name="tab_item">
        <label class="application__tab--label" for="tab2">承認済み</label>
        <div class="tab__content" id="content1">
            <table class="table">
                <tr class="table__row">
                    <th class="table__header">
                        <p class="table__header--item">状態</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">名前</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">対象日時</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">申請理由</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">申請日時</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">詳細</p>
                    </th>
                </tr>
                <tr class="table__row">
                    <td class="table__description">
                        <p class="table__description--item">承認待ち</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">西怜奈</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">2024/10/21</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">遅延のため</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">2024/10/21</p>
                    </td>
                    <td class="table__description">
                        <a class="table__item--detail-link" href="">詳細</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="tab__content" id="content2">
            <table class="table">
                <tr class="table__row">
                    <th class="table__header">
                        <p class="table__header--item">状態</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">名前</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">対象日時</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">申請理由</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">申請日時</p>
                    </th>
                    <th class="table__header">
                        <p class="table__header--item">詳細</p>
                    </th>
                </tr>
                <tr class="table__row">
                    <td class="table__description">
                        <p class="table__description--item">承認待ち</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">山田太郎</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">2024/10/21</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">遅延のため</p>
                    </td>
                    <td class="table__description">
                        <p class="table__description--item">2024/10/21</p>
                    </td>
                    <td class="table__description">
                        <a class="table__item--detail-link" href="">詳細</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
