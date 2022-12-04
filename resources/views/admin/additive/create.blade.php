@extends('admin.layouts.skeleton')
@section('content')
    <div class="container col-md-4">
        <h1>Add Additives</h1>
        <hr>
        <form method="post" action="{{route('additive.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Additive name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>
            <div class="form-group  ">
                <label for="image" class="py-3">Image</label>
                <input type="file" class="form-control " name="file" placeholder="Enter Image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@stop