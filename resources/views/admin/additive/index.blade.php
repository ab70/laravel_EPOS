@extends('admin.layouts.skeleton')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">


                <h2>Additive List</h2>
                <table class="table table-hover w-100" id="myTable">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">File</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--{{}}--}}
                    @foreach ($adds as $item)
                        {{--{{dd($items)}}--}}
                        <tr>
                            {{--<th scope="row">{{$menu->id}}</th>--}}
                            <td>{{$item->name}}</td>
                            <td><img  height="60" width="60" src="{{asset("storage/additive_image/$item->file")}}" alt=""></td>
                            <td><a role="button" type="button" class="btn btn-dark" href="{{ URL::route('additive.edit',$item->id) }}">EDIT</a></td>
                            <td><a role="button" type="button" class="btn btn-danger" href="{{ URL::route('additive.delete',$item->id) }}">Delete</a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

