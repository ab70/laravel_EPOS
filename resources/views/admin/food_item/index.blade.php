@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">

            
    <h2>Food Item List</h2>
    <table class="table table-hover w-100" id="myTable">
        <thead>
        <tr>
            <th scope="col">Item</th>
            <th scope="col">Category</th>
            <!--<th scope="col">Image</th>-->
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Additive</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            {{--{{dd($item->additive['name'])}}--}}
            <tr>
                {{--<th scope="row">{{$menu->id}}</th>--}}
                <td >{{$item->name}}</td>
                <td >{{$item->menu['name']}}</td>
                <!--<td><img  height="60" width="60" src="{{URL::asset("storage/food_image/$item->file")}}" alt=""></td>-->
                <td >{{$item->description}}</td>
                <td >{{$item->price}}</td>
                <td >
                    {{--{{dd($data)}}--}}
                    @foreach($data as $x )
                        {{--{{dd($x->fooditem_id)}}--}}
                        @if($item->additive_id == $x->id)
                            <img height="50" width="50" src="{{URL::asset("storage/additive_image/$x->file")}}" alt="">
                        @endif
                    @endforeach
                </td>
                <td><a role="button" type="button" class="btn btn-dark" href="{{ URL::route('food-item.edit',$item->id) }}">EDIT</a></td>
                 <td>
                     <form action="{{ route('food-item.destroy',$item->id)}}" method="post">
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

