@extends('admin.layouts.skeleton')
@section('content')
    <h2>Topping List</h2>
    <table class="table table-dark" id="myTable">
        <thead>
            <tr>
                <th scope="col">Toppings</th>
                <th scope="col">Menu</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($toppings as $topping)
                {{--{{dd($items)}}--}}
                <tr>
                    {{--<th scope="row">{{$menu->id}}</th>--}}
                    <td >{{$topping->name}}</td>
                    <td >{{$topping->menu['name']}}</td>
                    <td >{{$topping->price}}</td>
                    <td><a href="{{route('topping.edit',$topping->id)}}">EDIT</a></td>
                </tr>

            @endforeach
        </tbody>
    </table>

@stop

