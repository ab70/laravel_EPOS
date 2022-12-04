<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/ui.css" rel="stylesheet" type="text/css"/>
   <link href="/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
   <link href="/assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>
    <title>Tax</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark mynav mb-3">
        <a class="navbar-brand" href="{{route('epozHome')}}">EZPOS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link mr-5" href="{{route('epozHome')}}"><button class="btn btn-lg btnav"><i class="fa fa-home" aria-hidden="true"></i>
            </button></a>
            <a class="nav-item nav-link mr-5" href="{{route('payments')}}"><button class="btn btn-lg btnav"><i class="fa fa-list" aria-hidden="true"></i>
        </button></a>
            <?php

            $schedule = DB::table('epoz_discounts')->where('id', 1)->first();
            $tax = DB::table('epoz_taxes')->where('id', 1)->first();
            ?>
            <a class="nav-item nav-link mr-5" href="{{ URL::route('editdiscount',$schedule->id) }}"><button class="btn btn-lg btnav"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
            <a class="nav-item nav-link mr-5" href="{{ URL::route('editTax',$tax->id) }}"><button class="btn btn-lg btnav"><i class="fa fa-line-chart" aria-hidden="true"></i></button></a>
          </div>
        </div>
      </nav>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <?php

            $schedules = DB::table('epoz_taxes')->get();
            // dd($schedules)
            ?>
            <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Tax</h2>
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th scope="col">tax</th>
                                    <th scope="col">Edit</th>
                                    {{--<th scope="col">Delete</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($schedules as $schedule)

                                    {{--{{dd($schedule)}}--}}
                                    <tr>
                                        <td> {{$schedule->tax}}%</td>
                                        <td ><a  href="{{ URL::route('editTax',$schedule->id) }}" ><button class="btn btn-lg btnav">Edit</button></a> </td>
                                        {{--<td ><a  href="{{ URL::route('delete.time',$schedule->id) }}" ><button class="btn btn-danger">Delete</button></a> </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
            </div>
        </div>
    </div>


</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

