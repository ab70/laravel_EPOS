@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2>Customer</h2>
            <?php
            use App\Customer;
            use Illuminate\Support\Facades\DB;

            $customers =Customer::where('status', '=', 0)->get();

            ?>
            <table class="table table-dark" id="myTable">
                <thead>
                <tr>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">PostCode</th>
                    <th scope="col">Comments</th>
                    <th scope="col">OrderProcess</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($customers as $customer)
                    <tr>
                        <td>{{$customer->name}}</td>
                        <td >{{$customer->email}}</td>
                        <td >{{$customer->mobile}}</td>
                        <td>{{$customer->address}}</td>
                        <td >{{$customer->postcode}}</td>
                        <td >{{$customer->comments}}</td>
                        <td >{{$customer->order}}</td>
                       <td><a href="{{route('status',$customer->id)}}" class="btn btn-success btn-sm z-depth-0" type="button">mark as Done</a></td>
                        {{--<td><a role="button" type="button" class="btn btn-outline-white" href="{{ URL::route('order.complete',$order->id) }}">Done</a></td>--}}
                        {{--<td><a role="button" type="button" class="btn btn-outline-white" href="#">Done</a></td>--}}

                    </tr>


                </tbody>
                <br>
            </table>
            <?php
            $uid = $customer->uid;
            $orders =DB::table('customer_check_outs')->where('uid', $uid)->get();
            ?>
            <h2>Order Details</h2>
            <table class="table table-dark" id="myTable">
                <thead>
                <tr>
                    <th scope="col">Food Name</th>
                    <th scope="col"> Quantity</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>

                            <td>{{$order->food_name}}</td>
                            <td >{{$order->quantity}}</td>
                            <td >{{$order->price}}</td>
                            {{--<td><a role="button" type="button" class="btn btn-outline-white" href="{{ URL::route('order.complete',$order->id) }}">Done</a></td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

                @endforeach


</div>
</div>
</div>
@stop
