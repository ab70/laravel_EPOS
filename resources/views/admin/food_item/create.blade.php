@extends('admin.layouts.skeleton')
@section('content')
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">

            <h1>Create Food Item</h1>
            <hr>
            <form method="post" action="{{route('food-item.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Item name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="text">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter price">
                </div>
                {{--<div class="form-group  ">--}}
                {{--<label for="image" class="py-3">Image</label>--}}
                {{--<input type="file" class="form-control " name="file" placeholder="Enter Image">--}}
                {{--</div>--}}

                <div class="form-group">
                    <label for="text">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description">
                </div>
                <div class="form-group">
                    <label for="sel1">Select Menu:</label>
                    <select class="form-control" id="sel1" name="menu_id">
                        @foreach($menus as $menu)
                            <option value="{{$menu->id}}" class="dropdown-item">{{ $menu->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Select Additive:</label>
                    <select class="form-control" id="sel1" name="additive_id">
                        @foreach($adds as $add)
                            <option value="{{$add->id}}" class="dropdown-item">{{ $add->name }}</option>
                        @endforeach

                    </select>
                </div>

                <!--<div class="form-group">-->
                <!--    <label for="sel1">Add Image</label>-->
                <!--    <div class="form-group  ">-->
                <!--        <input type="file" class="form-control " name="file" placeholder="Enter Image">-->
                <!--    </div>-->
                <!--</div>-->

                <button type="submit" class="btn btn-success">Create </button>
            </form>
        </div>
</div>

<!--        <div class="mt-5">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->

                
<!--            <h1>Add Additives to food item</h1>-->
<!--            <hr>-->
<!--            <form method="post" action="{{route('join.store')}}" enctype="multipart/form-data">-->
<!--                @csrf-->
<!--                <div class="form-group">-->
<!--                    <label for="sel1">Select Additive:</label>-->
<!--                    <select class="form-control" id="sel1" name="additive_id">-->
<!--                        @foreach($adds as $add)-->
<!--                            <option value="{{$add->id}}" class="dropdown-item">{{ $add->name }}</option>-->
<!--                        @endforeach-->

<!--                    </select>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="sel1">Select Food Item:</label>-->
<!--                    <select class="form-control" id="sel1" name="fooditem_id">-->
<!--                        @foreach($items as $item)-->
<!--                            <option value="{{$item->id}}" class="dropdown-item">{{ $item->name }}</option>-->
<!--                        @endforeach-->

<!--                    </select>-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-success">Add </button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
    </div>

@stop