@extends('admin.layout.app')
@section('content')

    <div class="container">
        <div class="table"></div>
        <form class="col-md-5" action="{{route('users.update' , $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label"> Username </label>
                <input  name="username" value="{{$user->username}}" placeholder="Type username" type="text" class="form-control" id="exampleInputUsername" required>
                @if( $errors->has('username') )
                    <span class="text text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Name</label>
                <input name="name" value="{{$user->name}}" placeholder="Type name" type="text" class="form-control" id="exampleInputName" required>
                @if($errors->has('name'))
                    <span class="text text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input placeholder="Type Your Email" name="email" value="{{$user->email}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @if($errors->has('email'))
                    <span class="text text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
