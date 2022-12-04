@extends('admin.layouts.skeleton')
@section('content')
    <div class="container col-md-4">
        <h1>Add Toppings</h1>
        <hr>
        <form method="post" action="{{route('topping.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Topping name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="text">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Enter price">
            </div>

            <div class="form-group">
                <label for="sel1">Select Menu:</label>
                <select class="form-control" id="sel1" name="menu_id">
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}" class="dropdown-item">{{ $menu->name }}</option>
                    @endforeach

                </select>
            </div>

            <button type="submit" class="btn btn-primary">ADD</button>
        </form>
    </div>

@stop