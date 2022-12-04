@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">

            
        <h1>Create Food Category</h1>
        <hr>
        <form method="post" action="{{route('menu.store')}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Category name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
@stop