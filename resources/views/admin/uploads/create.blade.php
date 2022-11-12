@extends('admin.layout.app')
@section('content')
<div class="container">
    <div class="table"></div>
  <form class="col-md-5" action="{{route('admin-store-files')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">

          <select name="user" class="form-select" >
              <option value="" selected>Select User</option>
              @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->username}}</option>
              @endforeach

          </select>
          @if($errors->has('user'))
              <span class="text-danger"> {{ $errors->first('user') }}</span>
          @endif
      </div>

      <div class="form-group">
          <br>
              <label for="formFile" class="form-label">Default file input example</label>
          <input name="zips[]" class="form-control" type="file"  multiple>
          @if($errors->has('zips.*'))
              @foreach($errors->get('zips.*') as $key=>$errors)
                  @foreach($errors as $err)
                      <span class="text text-danger"> {{ $err }}</span>
                  @endforeach
              @endforeach
          @endif
      </div>
      <div class="form-group">
          <br>
          <button  type="submit" class="btn btn-primary">Upload</button>
      </div>


  </form>
</div>
@endsection
