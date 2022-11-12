@extends('users.layout.app')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" >
@endsection
@section('content')
    <div class="container">
        <div class="table"></div>
        <table id="example" class="display " style="width:100%">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">File Name</th>
                <th scope="col">File Type</th>
                <th scope="col">File size</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <th scope="row">{{$file->id}}</th>
                    <td>{{$file->user->name}}</td>
                    <td>{{$file->file_name}}</td>
                    <td>{{$file->file_type}}</td>
                    <td>{{$file->file_size}} bytes</td>
                    <td>
                       <form action="{{route('upload-files.destroy' , $file->id)}}" method="post">
                              @csrf
                               @method("delete")
                               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                       </form>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({

            });
        });
    </script>
@endsection
