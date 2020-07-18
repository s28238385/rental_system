@extends('layouts.master')
@section('content')

    
    <div class="text-center mt-5">
        <h1 style="font-family:Microsoft JhengHei ;color:#219F94;">變更密碼</h1>
        <div class="row  align-items-center justify-content-center">
        <div class="col-md-5 ">
            @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>
    </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-4">
                <form action="{{route('user.changepw')}}"method="post">

                    <div class="form-group">
                        <label for="password">舊密碼</label>
                        <input type="password" id="oldpassword" name="oldpassword"class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">新密碼</label>
                        <input type="password" id="newpassword" name="newpassword"class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">確認新密碼</label>
                        <input type="password" id="confirmnewpassword" name="confirmnewpassword"class="form-control">
                    </div>
                    
                
            </div>
        </div>
        <div class="row align-items-center justify-content-center"><button type="submit"class="btn btn-outline-info">確認變更</button>
            {{csrf_field()}}</div>
        </form>
         


@endsection