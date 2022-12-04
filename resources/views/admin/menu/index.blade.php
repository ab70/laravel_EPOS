@extends('admin.layouts.skeleton')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
        
    <h2>Food Category List</h2>
    <table class="table table-hover" id="myTable">
        <thead>
        <tr>
            <th scope="col">Menu</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($menus as $menu)

            <tr>
                {{--<th scope="row">{{$menu->id}}</th>--}}
                <td >{{$menu->name}}</td>
                <td><a href="{{ URL::route('menu.edit',$menu->id) }}"><button class="btn btn-dark">EDIT</button></a></td>
                 <td>
                    <form action="{{ route('menu.destroy',$menu->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@stop
