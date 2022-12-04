
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <title>EZPOS</title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/logos/squanchy.jpg" > -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logos/squanchy.jpg"> -->
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logos/squanchy.jpg"> -->
    <!-- jQuery -->
    <!-- Bootstrap4 files-->
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/ui.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="/assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>
    <!--numpad-->
    <link rel="stylesheet" href="/assets/css/easy-numpad.css">
    <!-- custom style -->
    <style></style>
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
            <a class="nav-item nav-link mr-5"><button class="btn btn-lg btnav" data-toggle="modal" data-target="#disc1">-%</button></a>
            <a class="nav-item nav-link mr-5"><button class="btn  btn-lg btnav" data-toggle="modal" data-target="#disc2">-£</button></a>
            <a class="nav-item nav-link mr-5"><button class="btn  btn-lg btnav" data-toggle="modal" data-target="#tax">TAX</button></a>
            <a class="nav-item nav-link mr-5"><button class="btn btn-lg btnav" data-toggle="modal" data-target="#open"><i class="fa fa-cutlery" aria-hidden="true"></i></button></a>

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
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 catg">
                <div class="category p-1 mb-1">
                <h4 class="text-white">Category</h4>
                <ul class="nav">
                    <?php
                    $menus =DB::table('menus')->get();
                    $additives =DB::table('additives')->get();
                    ?>
                    @foreach($menus as $menu)
                        <li class="nav-item">
                            
                            <a class="nav-link pt-3  m-1 mypill {{ Request::is('epoz/'.$menu->id.'') ? 'active' : '' }}"  href="{{route('epoz',$menu->id)}}">
                                <p class="text-center" style="font-size: 20px;"> <strong> {{$menu->name}} </strong></p></a>
                        </li>
                    @endforeach
                </ul>
            </div>
                    {{-- <span   id="items"> --}}
                <div class="item p-1 pb-0">
				<h4 class="text-white">Food</h4>
                    {{--{{dd($foods)}}--}}
                    <ul class="nav mb-1" >
						    @if($foods != null)
                                @foreach($foods as $food)
                                        {{--{{dd($food)}}--}}

                                    <li class="nav-item">
                                            <a class="nav-link m-1 mypill2"  href="{{route('epozCart',['id'=>$food->id])}}">
                                                <div style="min-height: 60px;">
                                                <p class="" style="font-size: 22px;"> <strong> {{$food->name}} </strong> <span style="font-size: 16px;" >£{{number_format($food->price,2)}}</span> </p>
                                            </div>
                                            <div class="image">
                                            @foreach($additives as $additive)
                                            @if($food->additive_id == $additive->id)
                                            <img  src="{{URL::asset("/storage/upload/$additive->file")}}" alt="">
                                            @endif
                                            @endforeach
                                        </div>
                                            </a>
                                    </li>

                                @endforeach
                    </ul>
                            @else
                            <h5 class="text-center text-white pt-3">{{"No categroy is selected"}}</h5>
                            @endif
                        </div>
                        <div class="additives">
                            <div class="row py-2 mt-3">
                            <div class="col-md-3 text-center">
                                   <p class="d-inline"><img src="/storage/upload/530495175.png" alt=""></p>
                                    <p class="d-inline"><strong>Vegetarian</strong></p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p class="d-inline"><img src="/storage/upload/600505553.png" alt=""></p>
                                    <p class="d-inline"><strong>Vegan</strong></p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p class="d-inline"><img src="/storage/upload/545943514.png" alt=""></p>
                                    <p class="d-inline"><strong>Gluten Free</strong></p>
                            </div>
                            <div class="col-md-3 text-center">
                                <p class="d-inline"><img src="/storage/upload/1615175099.png" alt=""></p>
                                    <p class="d-inline"><strong>Contains Nuts</strong></p>
                            </div>
                        </div>
                        </div>
				</span>
            </div>
            <div class="col-md-4">
            <?php
            if (Session::has('ecart')){?>
                
                @include('epoz.order',['change' => 'change'])
                <?php }else{ ?>
                @include('epoz.noOrder')
                <?php } ?>
            </div>
        </div>
        
    </div><!-- container //  -->
</section>
<?php
  $percents  = DB::table('percent_dis')->get();
?>
<div class="modal" id="disc1" tabindex="-1" role="dialog" aria-labelledby="disc1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disc1">Discount(-%)</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body mt-0 pt-0">
           @foreach($percents as $percent)
<div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
    <div class="">
        <form method="post" action="{{route('updatediscount',$discount->id)}}">
            @csrf
                  @method('PUT')
           <div class="form-group">
                <input type="hidden" class="text-center form-control-lg myinput" id="code1" value="{{$percent->percent}}"  name="discount"  placeholder="{{$discount->discount}}">
            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code1"> --}}
    </div>
    <button type="submit" class="btn btn-success px-5 py-1" style="font-size:30px;" onclick="">{{$percent->percent}}%</button>
</div>
</form>
@endforeach

</div>
</div>
</div>
    </div>
  </div>

  <div class="modal" id="disc2" tabindex="-1" role="dialog" aria-labelledby="disc2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disc1">Discount(-£)</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
          
<div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
    <div class="">
        <form method="post" action="{{route('extraCash')}}">
            @csrf
            @method('post')
            <div class="form-group">
                <input class="text-center form-control-lg myinput" id="code2"  name="extra" style="border-style: none; font-size:30px;" placeholder="Enter Discount Cash">
               

            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code"> --}}
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '1';">1</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '2';">2</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '3';">3</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '4';">4</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '5';">5</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '6';">6</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '7';">7</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '8';">8</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '9';">9</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '.';">.</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value + '0';">0</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value.slice(0, -1);">&lt;</button>
    </div>
    <div class="btn-group">
    <button type="button" class="btn mt-3 btn-danger mydelbtn" onclick="document.getElementById('code2').value=document.getElementById('code2').value.slice(0, 0);">Clear</button>
    <button type="submit" class="btn mt-3 btn-success mysavebtn" onclick="">Apply</button>
</div>
</form>
</div>
</div>
</div>
    </div>
  </div>

  <div class="modal" id="tax" tabindex="-1" role="dialog" aria-labelledby="tax" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disc1">Tax</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
          
<div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
    <div class="">
        <form method="post" action="{{route('updateTax',$tax->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input class="text-center form-control-lg myinput" id="code3"  name="tax" style="border-style: none; font-size:30px;" placeholder="Enter Tax Amount">
               

            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code3"> --}}
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '1';">1</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '2';">2</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code3').value + '3';">3</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '4';">4</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '5';">5</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '6';">6</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '7';">7</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '8';">8</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '9';">9</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '.';">.</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value + '0';">0</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value.slice(0, -1);">&lt;</button>
    </div>
    <div class="btn-group">
    <button type="button" class="btn mt-3 btn-danger mydelbtn" onclick="document.getElementById('code3').value=document.getElementById('code3').value.slice(0, 0);">Clear</button>
    <button type="submit" class="btn mt-3 btn-success mysavebtn" onclick="">Apply</button>
</div>
</form>
</div>
</div>
</div>
    </div>
  </div>


  <div class="modal" id="open" tabindex="-1" role="dialog" aria-labelledby="open" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="open">Open Food</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
          
<div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
    <div class="">
        <form method="post" action="{{route('open')}}">
            @csrf
           <div class="form-group">
                <input class="text-center form-control-lg myinput" id="code4" value=""  name="open" style="border-style: none; font-size:30px;" placeholder="Enter Open food amount">
            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code4"> --}}
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '1';">1</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '2';">2</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '3';">3</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '4';">4</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '5';">5</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '6';">6</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '7';">7</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '8';">8</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '9';">9</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '.';">.</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value + '0';">0</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value.slice(0, -1);">&lt;</button>
    </div>
    <div class="btn-group">
    <button type="button" class="btn mt-3 btn-danger mydelbtn" onclick="document.getElementById('code4').value=document.getElementById('code4').value.slice(0, 0);">Clear</button>
    <button type="submit" class="btn mt-3 btn-success mysavebtn" onclick="">Apply</button>
</div>
</form>
</div>
</div>
</div>
    </div>
  </div>
<!-- ========================= SECTION CONTENT END// ========================= -->
<script src="assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="assets/js/OverlayScrollbars.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="/assets/js/easy-numpad.js"></script>
<script src="/js/app.js"></script>
<script>
    $(function() {
        //The passed argument has to be at least a empty object or a object with your desired options
        //$("body").overlayScrollbars({ });
        $("#items").height(552);
        $("#items").overlayScrollbars({overflowBehavior : {
                x : "hidden",
                y : "scroll"
            } });
        $("#cart").height(445);
        $("#cart").overlayScrollbars({ });
    });
</script>
</body>
</html>