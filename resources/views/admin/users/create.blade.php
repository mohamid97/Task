@extends('admin.layout.app')
@section('content')
<div class="container">
    <div class="table"></div>
    <form class="col-md-5" action="{{route('users.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputUsername" class="form-label">Username</label>
            <input name="username" value="{{old('username')}}" placeholder="Type username" type="text" class="form-control" id="exampleInputUsername" required>
            @if($errors->has('username'))
                <span class="text text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input name="name" value="{{old('name')}}" placeholder="Type name" type="text" class="form-control" id="exampleInputName" required>
            @if($errors->has('name'))
                <span class="text text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input placeholder="Type Your Email" value="{{old('email')}}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div  id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            @if($errors->has('email'))
                <span class="text text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input  name="password" placeholder="*******"  type="password" class="form-control" id="exampleInputPassword1" required>
            @if($errors->has('password'))
                <span class="text text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">conform password</label>
            <input name="password_confirmation" placeholder="*******" type="password" class="form-control" id="exampleInputPassword1" required>
            @if($errors->has('password_confirmation'))
                <span class="text text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
