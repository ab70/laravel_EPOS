@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
    <div class="card">
        <div class="card-body">

        
    <h2>Order Details</h2>
    <table class="table table-dark" id="myTable">
        <thead>
        <tr>
            <th scope="col">Order Id</th>
            <th scope="col">Food Name</th>
            <th scope="col"> Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">PostCode</th>
            <th scope="col">Comments</th>
            <th scope="col">Action</th>


        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td >{{$order->id}}</td>
                <td>{{$order->food_name}}</td>

                <td >{{$order->quantity}}</td>
                <td >{{$order->price}}</td>
                <td>{{$order->name}}</td>

                <td >{{$order->email}}</td>
                <td >{{$order->mobile}}</td>
                <td>{{$order->address}}</td>

                <td >{{$order->postcode}}</td>
                <td >{{$order->comments}}</td>
                <td><a role="button" type="button" class="btn btn-outline-white" href="{{ URL::route('order.complete',$order->id) }}">Done</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@stop
