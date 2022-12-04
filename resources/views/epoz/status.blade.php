<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/ui.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>
    <!--data table-->
    <!--<link href ="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" type="text/css" href="hhttps://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
 

    <title>Orders</title>
    <script type="text/javascript">
        if (document.addEventListener) {
            document.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            }, false);
        } else {
            document.attachEvent('oncontextmenu', function () {
                window.event.returnValue = false;
            });
        }
    </script>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark mynav mb-3">
        <a class="navbar-brand" href="{{route('epozHome')}}">EZPOS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
              <a class="nav-item nav-link mr-5">
           <form method="post" class="form_month" action="{{route('months')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <select name="months" id="month" onchange="this.form.submit()">
                        <option value="0" id="month_option" selected disabled>Select month</option>
                        
                    @foreach ($all_months as $month)
                    <option id="month_option" value="{{$month->id}}" >{{ $month->name }}</option>
                   
                    @endforeach 
                    </select>
            </form>
            </a>
          <a class="nav-item nav-link mr-5" href="{{route('epozHome')}}"><button class="btn btn-lg btnav"><i class="fa fa-home" aria-hidden="true"></i>
            </button></a>
             <a class="nav-item nav-link mr-5" href="{{route('epozHome2')}}"><button class="btn btn-lg btnav"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button></a>
            <!--<a class="nav-item nav-link mr-5"><button class="btn btn-lg btnav" data-toggle="modal" data-target="#disc1">-%</button></a>-->
            <!--<a class="nav-item nav-link mr-5"><button class="btn  btn-lg btnav" data-toggle="modal" data-target="#disc2">-£</button></a>-->
            <!--<a class="nav-item nav-link mr-5"><button class="btn  btn-lg btnav" data-toggle="modal" data-target="#tax">TAX</button></a>-->
            <!--<a class="nav-item nav-link mr-5"><button class="btn btn-lg btnav" data-toggle="modal" data-target="#open"><i class="fa fa-cutlery" aria-hidden="true"></i></button></a>-->
            <a class="nav-item nav-link mr-5" href="{{route('payments')}}"><button class="btn btn-lg btnav"><i class="fa fa-list" aria-hidden="true"></i>
        </button></a>
            <?php

            $schedule = DB::table('epoz_discounts')->where('id', 1)->first();
            $tax = DB::table('epoz_taxes')->where('id', 1)->first();
            
            ?>
            <!-- <a class="nav-item nav-link mr-5" href="{{ URL::route('editdiscount',$schedule->id) }}"><button class="btn btn-lg btnav"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
            <a class="nav-item nav-link mr-5" href="{{ URL::route('editTax',$tax->id) }}"><button class="btn btn-lg btnav"><i class="fa fa-line-chart" aria-hidden="true"></i></button></a> -->
          </div>
        </div>
      </nav>
      <div class="row">
          <div class="col-md-4">
              <div class="card ml-2" style="border-style:1px solid white; border-radius:4px; background-color:rgba(0,0,0,0.2)">
                   <div class="d-flex justify-content-center mb-2">
              <h4 class="text-white text-center"><strong>Today:</strong></h4>
              <input type="button"  value="Print" onclick="PrintDivDay()"  class="btn ml-2 w-50 btn-success btn-lg btn-block"/>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="card bg-primary mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Cash: <strong>£{{number_format($totalCashofDays,2)}}</strong></h5></div>
                  </div>
                  <div class="col-md-4">
                      <div class="card bg-warning mx-1 mb-1 py-2 text-center"><h5 class="">Card: <strong>£{{number_format($totalCardofDays,2)}}</strong></h5></div>
                  </div>
                  <div class="col-md-4">
                       <div class="card bg-info mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Total: <strong>£{{number_format($totalamount,2)}}</strong></h5></div>
                  </div>
              </div>
             </div>
              </div>
    
          <div class="col-md-4">
              <div class="card ml-2" style="border-style:1px solid white; border-radius:4px; background-color:rgba(0,0,0,0.2)">
            <div class="d-flex justify-content-center mb-2">

              <h4 class="text-white text-center"><strong>{{$month_name}}:</strong></strong></h4>
                 <input type="button"  value="Print" onclick="PrintDivMonth()"  class="btn ml-2 w-50 btn-success btn-lg btn-block"/>
                </div>
              
              <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Cash: <strong>£{{number_format($totalCashofMonths,2)}}</strong></h5></div>
                    </div>
                    <div class="col-md-4">
                      <div class="card bg-warning mx-1 mb-1 py-2 text-center"><h5 class="" style="color:black;">Card: <strong>£{{number_format($totalCardofMonths,2)}}</strong></h5></div>  
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Total: <strong>£{{number_format($totalmonths,2)}}</strong></h5></div>
                    </div>
                </div>
              </div>
          </div>
          <div class="col-md-4">
               <div class="card ml-2" style="border-style:1px solid white; border-radius:4px; background-color:rgba(0,0,0,0.2)">
              <h4 class="text-white text-center"><strong>Year:</strong></strong></h4>
              <div class="row">
                  <div class="col-md-4">
                       <div class="card bg-primary mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Cash: <strong>£{{number_format($totalCashofYears,2)}}</strong></h5></div>
                  </div>
                  <div class="col-md-4">
                       <div class="card bg-warning mx-1 mb-1 py-2 text-center"><h5 class="" style="color:black;">Card: <strong>£{{number_format($totalCardofYears,2)}}</strong></h5></div>
                  </div>
                  <div class="col-md-4">
                     <div class="card bg-info mx-1 mb-1 py-2 text-center"><h5 class="" style="color:white;">Total: <strong>£{{number_format($totalyears,2)}}</strong></h5></div>  
                  </div>
              </div>

              </div>
          </div>
      </div>

     
<div class="order">
    <div class="col-md-12 pt-3">
        <div class="card orderCard">
        <table class="table dt-responsive display" id="myTable">
            <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Order Id</th>
                <th scope="col">Order Time</th>
                <th scope="col">Order Food</th>
               
                <th scope="col">Action</th>
        
            </tr>
            </thead>
            <tbody>
            @foreach($statuses->reverse() as $key => $status)
            
           
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$status->order_id}}</td>
                    <td>{{$status->created_at}}</td>
                     @php
                            $x =explode(",",$status->ordered_food);
                            $q = explode(",",$status->quantity);
                            $p = explode(",",$status->price);
                    @endphp
                     
                    <td>
                         <a type="button" class="btn btn-lg btn-primary" data-toggle="modal" href="#modal{{$status->id}}">Order Details</a>
                         
                              <div class="modal right fade" id="modal{{$status->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal 
                                <div class="modal-dialog modal-full-height modal-right" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title w-100"  id="myModalLabel">Order Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-3">
                                           <div id="modalprint{{$status->id}}"> 
                                           
                                            <table class="table table-borderless">
                                            <tr>
                                                <td>Order Id:</td>
                                                <td><strong>&nbsp; {{$status->order_id}}</strong></td>
                                                
                                                   <td>Time:</td>
                                                <td><strong> &nbsp; {{$status->created_at}}</strong></td> 
                                                </tr>
                                                <tr>
                                                @if($status->table_no && $status->person)
                                                    <td>Table/Person:&nbsp; {{$status->table_no}} / {{$status->person}}p</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                @else
                                                @endif
                                                </tr>
                                            </table>
                                          <table class="table table-borderless">
                                                
                                                <thead>
                                                    <th scope="col">item</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Price</th>
                                                </thead>
                                                <tbody>
                                          
                                                @foreach($p as $key=>$value)
                                                    <tr>
                                                    <td>{{trim($x[$key], '"')}}</td>
                                                    <td>{{$q[$key]}}</td>
                                                    <td>£{{trim($p[$key],'"')}}</td>
                                                    </tr>
                                                @endforeach
                                               </tbody>
 
                                            </table>
                     
                                            <table class="table table-borderless">
                                           
                                            @if($status->openfood>0)
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0">Open Food</td>
                                                <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">{{$status->openfood}}</td>
                                            </tr>
                                            @endif
                                            @if($status->dis_percent>0)
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0">Discount(%)</td>
                                                <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">{{$status->dis_percent}}</td>
                                            </tr>
                                            @endif
                                            @if($status->dis_cash>0)
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0">Discount(£)</td>
                                                <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">{{$status->dis_cash}}</td>
                                            </tr>
                                            @endif
                           
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0">Total</td>
                                                <td class="m-0 py-0" ></td>
                                                <td class="m-0 py-0">£{{number_format($status->amount,2)}}</td>
                                            </tr>
                                            @if($status->method=='cash')
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0"><p>paid</p></td>
                                                <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">£{{number_format($status->paid,2)}}</td>
                                            </tr>
                                            <tr class="m-0 py-0">
                                                <td class="m-0 py-0"><p>Change</p></td>
                                                <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">£{{number_format($status->change_cash,2)}}</td>
                                            </tr>
                                            
                                            @else
                                            <tr class="m-0 py-0">
                                            <td class="m-0 py-0"> <p>paid</p></td>
                                            <td class="m-0 py-0"></td>
                                                <td class="m-0 py-0">£{{number_format($status->amount,2)}}</td>
                                            </tr>
                                            @endif
                                            
                                            <tr>
                                                <td>payment method:</td>
                                                <td><strong>{{$status->method}}</strong></td>
                                            </div>
                                            
                                            </tbody>
                                    </table>
                                    </div>
                                            <div class=" col-md-6 px-1">
                                          
                                            <input type="button"  value="Print" onclick="PrintDivTst({{$status->id}})"  class="btn  btn-success btn-lg btn-block"/>

                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                    </td>
                    
                    
                    <!--<td>£{{number_format($status->amount,2)}}</td>-->
                    <!--<td>{{$status->openfood}}</td>-->
                    <!-- <td>{{$status->dis_percent}}</td>-->
                    <!--  <td>{{$status->dis_cash}}</td>-->
                    <!--  <td>{{$status->paid}}</td>-->
                    <!--  <td>{{$status->change_cash}}</td>-->
                    <!--<td>{{$status->method}}</td>-->
                    <!--@if($status->table_no && $status->person)-->
                    <!--<td>{{$status->table_no}} / {{$status->person}} p</td>-->
                    <!--@else-->
                    <!--<td></td>-->
                    <!--@endif-->

                    <td><a type="button" role="button" class="btn btn-danger btn-lg" href="{{ URL::route('refund',$status->id) }}">Refund</a></td>

                </tr>
             @endforeach
            </tbody>
        </table>
   
    </div>
    </div>
  @include('epoz.orderprint')

</div>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
         searching: false,
         "pageLength": 10,
         "lengthChange": false
        
    });
} );
</script>
<?php
  $percents  = DB::table('percent_dis')->get();
?>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>