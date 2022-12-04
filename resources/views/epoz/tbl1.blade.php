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
 

    <title>EAT -IN</title>
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
          
          <a class="nav-item nav-link mr-5" href="{{route('epozHome')}}"><button class="btn btn-lg btnav"><i class="fa fa-home" aria-hidden="true"></i>
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
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :01</h2>
              
              @if (Session::has('tbl1'))
                 @include('epoz.eatin1',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :02</h2>
              
              @if (Session::has('tbl2'))
                 @include('epoz.eatin2',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :03</h2>
              
              @if (Session::has('tbl3'))
                 @include('epoz.eatin3',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :04</h2>
              
              @if (Session::has('tbl4'))
                 @include('epoz.eatin4',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          
            </div>
            <br>
            <div class="row">
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :05</h2>
              
              @if (Session::has('tbl5'))
                 @include('epoz.eatin5',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          <div class="col-md-3">
             
              <h2 style=" background-color:white"> Table :06</h2>
              
              @if (Session::has('tbl6'))
                 @include('epoz.eatin6',['change' => 'change'])
               @else
                @include('epoz.noOrder')
              @endif
             
              </div>
             
          </div>
          <div class="col-md-3">
             
             <h2 style=" background-color:white"> Table :07</h2>
             
             @if (Session::has('tbl7'))
                @include('epoz.eatin7',['change' => 'change'])
              @else
               @include('epoz.noOrder')
             @endif
            
             </div>
         </div>
      </div>
 </div>
<div class="order">
    <div class="col-md-12 pt-3">
        <div class="card orderCard">
       
   
    </div>
    </div>
  
</div>

<?php
  $percents  = DB::table('percent_dis')->get();
?>


  

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>