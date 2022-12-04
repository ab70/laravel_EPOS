@extends('admin.layouts.skeleton')
@section('content')
    <div class="container col-md-4">
        <h1>Update Additives</h1>
        <hr>
        <form method="post" action="{{route('additive.update',$adds->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="form-group">
                    <label for="exampleInputEmail1">Additive name</label>
                    <input type="text"  value="{{$adds->name}}" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group  ">
                    <label for="image" class="py-3">Image</label>
                    <input type="file" class="form-control " name="file"  placeholder="Enter Image" value="{{$adds->file}}">
                </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@stop