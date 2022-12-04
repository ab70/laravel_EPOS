@extends('admin.layouts.skeleton')
@section('content')
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">

                  
                <h1>Update Food Item</h1>
                <hr>

                <form method="post" action="{{route('food-item.update',$item->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="exampleInputEmail1">Item name</label>
                        <input type="text" class="form-control" value="{{$item->name}}" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="text">Price</label>
                        <input type="text" class="form-control" value="{{$item->price}}" name="price" placeholder="Enter price">
                    </div>
                    <!--<div class="form-group  ">-->
                    <!--    <label for="image" class="py-3">Image</label>-->
                    <!--    <input type="file" class="form-control " value="{{$item->file}}" name="file" placeholder="Enter Image">-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="text">Description</label>
                        <input type="text" class="form-control" value="{{$item->description}}" name="description" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Select Menu</label>
                        <select class="form-control" name="menu_id">
                        <option value="0" disabled selected>Select Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" {{ $item->menu_id == $menu->id ? 'selected' : ''}} class="dropdown-item">{{ $menu->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Update Additive:</label>
                        <select class="form-control" id="sel1" name="additive_id">
                            @foreach($adds as $add)
                                <option value="{{$add->id}}" {{ $item->additive_id == $add->id ? 'selected' : ''}} class="dropdown-item">{{ $add->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>

            </div>
        </div>
                {{--<div class="mt-5">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-body">--}}
                    {{--<h1>Update Additives to food item</h1>--}}
                    {{--<hr>--}}
                            {{--{{dd()}}--}}
                    {{--<form method="post" action="{{route('join.update')}}" enctype="multipart/form-data">--}}
                        {{--@csrf--}}
                        {{--@method('PUT')--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="sel1">Update Additive:</label>--}}
                            {{--<select class="form-control" id="sel1" name="additive_id">--}}
                                {{--@foreach($adds as $add)--}}
                                    {{--<option value="{{$add->id}}" class="dropdown-item">{{ $add->name }}</option>--}}
                                {{--@endforeach--}}

                            {{--</select>--}}

                            {{--<button type="submit" class="btn btn-success " >Update</button>--}}

                        {{--</div>--}}

                    {{--</form>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div></div>--}}
@stop