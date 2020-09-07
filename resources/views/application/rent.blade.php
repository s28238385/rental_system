@extends('layouts.master')

@section('title')
    設備借出
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/select_all.js') }}"></script>
@endsection

@section('content')
    <div class="my-3">
        <div class="card p-3">
            <div class="d-flex inline-flex align-items-end">
                <h2 class="text-primary mb-0">基本資料</h2>
                <div class="ml-auto">
                    <a href="{{ route('application.return', ['application_id' => $application->id]) }}" type="button" class="btn btn-outline-success px-3 mx-1 {{ ($application->status != '已歸還')? '' : 'disabled' }}">歸還</a>
                    <a href="{{ route('application.information', ['application_id' => $application->id]) }}" type="button" class="btn btn-outline-primary px-3 mx-1">詳細資料</a>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <p>申請編號：{{ $application->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>申請狀態：{{ $application->status }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>申請時間：{{ $application->created_at }}</p>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-6">
                        <p>姓名：{{ $application->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>身分：{{ $application->identity }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>手機/分機：{{ $application->phone }}</p>
                    </div>
                    @if (!is_null($application->certificate))
                        <div class="col-md-6">
                            <p>抵押證件：{{ $application->certificate }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{ route('application.rent', ['application_id' => $application->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="card p-3 mt-3">
                <div class="d-flex inline-flex align-items-end">
                    <h2 class="text-primary">借用項目</h2>
                    <div class="ml-auto mr-3">
                        <input type="checkbox" id="all">
                        <label for="all">全部借出</label>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="align-middle">種類</td>
                                <td class="align-middle">項目</td>
                                <td class="align-middle">數量</td>
                                <td class="align-middle">借出</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($rent_key) && $rent_equipments->isEmpty())
                                <tr>
                                    <td class="align-middle" colspan="5">所有申請設備皆已借出或歸還</td>
                                </tr>
                            @endif
                            @if (!empty($rent_key))
                                <tr>
                                    <td class="align-middle">{{ $rent_key->classroom }}鑰匙</td>
                                    <td class="align-middle">{{ $rent_key->key_type }}</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">
                                        <input type="checkbox" name="key_rent" id="rentkey" value="{{ $rent_key->id }}">
                                        <label for="rentkey">借出</label>
                                    </td>
                                </tr>
                            @endif
                            @if (!$rent_equipments->isEmpty())
                                @foreach ($rent_equipments as $rent_equipment)
                                    <tr>
                                        <td class="align-middle">{{ $rent_equipment->genre }}</td>
                                        <td class="align-middle">{{ $rent_equipment->item }}</td>
                                        <td class="align-middle">{{ $rent_equipment->quantity }}</td>
                                        <td class="align-middle">
                                            @if ($rent_equipment->status === '無庫存')
                                                <p class="mb-1">無庫存</p>
                                            @else
                                                <input type="checkbox" name="rent[]" id="rent{{ $rent_equipment->id }}" value="{{ $rent_equipment->id }}">
                                                <label for="rent{{ $rent_equipment->id }}">借出</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        <button type="submit" class="btn btn-success px-4" {{ (empty($rent_key) && $rent_equipments->isEmpty())? 'disabled' : '' }}>確認借出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection