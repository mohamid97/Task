@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="table"></div>
        <div class="add">
            <a href="{{route('users.create')}}"> <button class="btn btn-primary">Add New User </button></a>
        </div>
        <hr>
        <table id="example" class="display " style="width:100%">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">email</th>
                <th scope="col">created_at</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->created_at}} </td>
                    <td style="display: flex">
                        <a href="{{route('users.edit' , $item->id)}}">
                            <button class="btn btn-sm btn-primary">Edit</button>
                        </a>
                        |
                       <a><form action="{{route('users.destroy' , $item->id)}}" method="POST">
                               @csrf
                               @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form></a> |
                        <a href="{{route('admin-delete-files' , $item->id)}}">
                                <button class="btn btn-sm btn-danger">Delete Files</button>

                        </a>

                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
