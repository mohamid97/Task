@extends('users.layout.app')
@section('content')
    <div class="container">
        <form class="upload-form col-md-5" action="{{route('upload-files.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <div class="form-text text-danger">
                @if($errors->has('file'))
                    {{ $errors->first('file') }}
                @endif
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection()
