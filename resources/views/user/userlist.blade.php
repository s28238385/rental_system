@extends('layouts.master')
@section('content')
<?php
    use Illuminate\Support\Facades\DB;
    $users=DB::table('users')->get();
?>
@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif
<table class="table table-hover ">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">name</th>
      <th scope="col">role</th>
      <th scope="col">email</th>
      <th scope="col">control</th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach($users as $user)
    {
        ?> 
        <tr class="<?php if($user->role=="user")echo "table-success";else echo "table-warning"?>"> 
            <th scope="row"><?=$user->id;?></th>
            <td><?=$user->name; ?></td>
            <td><?=$user->role; ?></td>
            <td><?=$user->email; ?></td>
            <td><a href="{{route('user.resetpassword',['id'=>$user->id])}}">修改密碼</a> <span >@if($user->id!=Auth::user()->id)<a  onclick="return confirm('確定刪除帳號?')"href="{{route('user.deleteacc',['id'=>$user->id])}}">刪除帳號<i class="fa fa-trash"></i></a>@endif</span></td>
        </tr>

        <?php
    }
?>
  </tbody>
</table><br><hr>

  <form method="get" action="{{route('user.signup')}}">
    <button type="submit" class="btn btn-outline-success btn-lg btn-block">新增使用者</button>

    {{csrf_field()}}
   
</form> 


@endsection
@section('script')
@endsection 