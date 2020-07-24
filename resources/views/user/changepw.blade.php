@extends('layouts.master')

@section('content')
<div class="text-center mt-5">
    <h1 class="color-2F91CD font-weight-normal mb-3">變更密碼</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-4">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row align-items-center justify-content-center">
    <div class="col-4">
        <form action="{{ route('user.changepw') }}" method="post">
            <div class="form-group">
                <label for="password">舊密碼<span class="required">*</span></label>
                <input type="password" id="oldpassword" name="oldpassword"class="form-control">
            </div>
            <div class="form-group">
                <div class="d-flex inline-flex">
                    <label for="password">新密碼<span class="required">*</span></label>
                    <small class="form-text text-muted ml-auto">密碼長度應大於6位</small>
                </div>
                <input type="password" id="newpassword" name="newpassword"class="form-control">
            </div>
            <div class="form-group">
                <label for="password">確認新密碼<span class="required">*</span></label>
                <input type="password" id="confirmnewpassword" name="confirmnewpassword"class="form-control">
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit"class="btn btn-outline-info px-3">確認變更</button>
                {{csrf_field()}}
            </div>
        </form>
    </div>
</div>
@endsection