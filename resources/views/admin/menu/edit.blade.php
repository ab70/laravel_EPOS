@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
            <h1>Edit Food Category</h1>
            <hr>
            <form method="post" action="{{route('menu.update',$menu->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Update Cateogry name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{$menu->name}}">
                </div>
                <button type="submit" class="btn btn-success">UPDATE</button>
            </form>
            <div class="form-group pt-2">
                <form method="post" action="{{route('menu.update',$menu->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </div>
        </div >
    </div>
    </div>


@stop