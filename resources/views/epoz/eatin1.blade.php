

<?php
        use App\epozCart;
    if ( ! Session::has('tbl1')){
        return view ('epoz.tblOrder1',['products'=>NULL]);
    }
        $oldCart = Session::get('tbl1');
        $cart = new epozCart($oldCart);
        $products = $cart->items;
        // $totalPrice= $cart->totalPrice;
        $extra = Session::get('extra');
        $tbl_no = Session::get('tbl_no');
        // $tbl = Session::get('tbl1');

        ?>
        
<div class="card scroll">
	<span id="cart">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<!-- <tr>
<th scope="col">cross</th>
  <th scope="col">Item</th>
  <th scope="col" width="120">Qty</th>
  <th scope="col" width="120">Price</th>
  {{--<th scope="col" class="text-right" width="200">Delete</th>--}}
</tr> -->

</thead>
<tbody>

@if(count($products)>0)
@foreach($products as $product)
    <tr>
    
    <td class="pl-1 pt-1 pr-1 m-0" style="width:20px; height: 20px;">
         <a href="{{route('lessfood',['id'=>$product['item']['id']])}}" type="button" class="m-btn px-3 py-1 btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
    </td>
	<td class="py-0" style="height:20px;">
<figure class="media pt-2">
	<figcaption class="media-body">
		<h6 class="title ">{{$product['item']['name']}}</h6>
	</figcaption>
</figure>
	</td>
	<td class="py-0" class="text-center">
		<div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
		<a href="{{route('less',['id'=>$product['item']['id']])}}" type="button" class="m-btn btn px-3 btn-primary mt-1"><i class="fa fa-minus"></i></a>
		<button type="button" class="m-btn btn btn-default mt-1" disabled>{{$product['qty']}}</button>
		<a href="{{route('moreCart',['id'=>$product['item']['id']])}}}" type="button" class="m-btn btn px-3 btn-primary mt-1"><i class="fa fa-plus"></i></a>
		</div>
	</td>
	<td  class="py-0" style="height:20px;">
		<div class="price-wrap">
			<var class="price text-success pt-1">£{{number_format($product['price'],2)}}</var>
		</div> <!-- price-wrap .// -->
	</td>
	{{--<td class="text-right">--}}
	{{--<a href="" class="btn btn-outline-danger"> <i class="fa fa-trash"></i></a>--}}
	{{--</td>--}}
</tr>
@endforeach
</tbody>
@endif
</table>
</span>
</div> <!-- card.// -->

<div class="box">

    <?php
    use App\epozDiscount;
    
    $open = Session::get('open1');
    $tbl = Session::get('tbl_no1');
    $person = Session::get('person1');

    $dis = epozDiscount::find(1);
    $extra = Session::get('extra1');
    $oldCart = Session::get('tbl1');
    $cart = new epozCart($oldCart);
    $products = $cart->items;
    // $prices= $cart->totalPrice;
    
    if($cart->totalPrice){
       
        $totalPrice= $cart->totalPrice;

        // Session::put('total', $totalPrice);
        // Session::save();
        
    }else{
        
         Session::forget('tbl1');
    }
    // {{dd($cart->items[80]['price'])}}
    // {{dd($cart->totalPrice)}}
    // {{dd($cart)}}

    ?>

<div class="row">
<div class="col-md-5">
<dl class="dlist-align"> 

<dt>Table No: </dt>
    <?php if( $tbl){
    ?>
      
        <dd class="text-right">{{$tbl}}/{{$person}} p</dd>
<?php }else{ ?>
        <dd class="text-right">0</dd>
    <?php }?>
    </dl>
<dl class="dlist-align">
        <dt>Discount(%): </dt>
        <dd class="text-right">{{$dis->discount}}%</dd>
    </dl>
    <dl class="dlist-align">
        <dt>Discount(£): </dt>
        <dd class="text-right">-£{{number_format($extra,2)}}</dd>
    </dl>
<?php if($open){
    ?>
    <dl class="dlist-align">
        <dt>OpenFood:</dt>
        <dd class="text-right">+£{{number_format($open,2)}}</dd>
    </dl>
<?php } ?>

@if(Session::has('tbl1'))
        <dl class="dlist-align">
        <!--if session has no  open or extra price-->
            <dt class="h5 b">Total: </dt>
           <?php
            if($open && $extra){ 
                $totalPrice =$totalPrice+$open;
                $disTotal=$totalPrice-$extra;
                ?>
            <dd class="text-right h5 b"> £{{number_format($disTotal,2)}} </dd>

            <?php }elseif($open && $dis->discount){ 
                 $totalPrice = $totalPrice+$open;
                 $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                ?>
                <dd class="text-right h5 b"> £{{number_format($disTotal,2)}} </dd>
          
            <?php }elseif($dis->discount){ 
                 $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                ?>
                <dd class="text-right h5 b"> £{{number_format( $disTotal,2)}} </dd>
            <?php }elseif($open){ ?>
            <dd class="text-right h5 b"> £{{number_format($totalPrice+$open,2)}} </dd>
            <?php }elseif($extra){ ?>
            <dd class="text-right h5 b"> £{{number_format($totalPrice-$extra,2)}} </dd>
            <?php }else{ ?>
                <dd class="text-right h5 b"> £{{number_format($totalPrice,2)}} </dd>
            <?php }?>
            <!-- <dd class="text-right h4 b"> £{{number_format($disTotal=$totalPrice-($totalPrice*($dis->discount/100)),2)}} </dd> -->

            <!--if session has open -+open -->

            <!--if session has extra -extra-->
            @endif
        </dl>

    <dl class="dlist-align">
        {{--<dt>Discount:</dt>--}}
        {{--<dd class="text-right"><a href="#">0%</a></dd>--}}
    </dl>
</div>


<div class="col-md-7">
<dl class="dlist-align">
            <dt>Tax: </dt>
            <?php
            use App\epozTax;
            $tax = epozTax::find(1);
            ?>
            <dd class="text-right h6 b">{{$tax->tax}}%</dd>
        </dl>
@if(Session::has('tbl1'))
    <dl class="dlist-align">
        <dt class="h5 b" >Sub Total:</dt>
        <?php
           
            if($open && $dis->discount){ 
                $totalPrice = $totalPrice+$open;
                $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                $last1=$disTotal+($disTotal*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format($last1,2)}} </dd>
            <?php }elseif($extra){ 
                 $disTotal =$totalPrice-$extra;
                 $last1=$disTotal+($disTotal*($tax->tax/100));
                ?>
            <dd class="text-right h4 b"> £{{number_format($last1,2)}} </dd>

            <?php }elseif($dis->discount){ 
                  $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                  $last1=$disTotal+($disTotal*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format( $last1,2)}} </dd>
            <?php }elseif($open){ 
                 $disTotal =$totalPrice+$open;
                 $last1=$disTotal+($disTotal*($tax->tax/100));
                ?>
            <dd class="text-right h4 b"> £{{number_format($last1,2)}} </dd>
          
            <?php }else{ 
                 $last1=$totalPrice+($totalPrice*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format($last1,2)}} </dd>
            <?php }?>
           
        <!-- <dl class="dlist-align">
            <dt>Sub Total:</dt>
            <dd class="text-right h4 b">£{{number_format($last=$disTotal+($disTotal*($tax->tax/100)),2)}}</dd>
        </dl> -->
                </dl>
                
        @if(Session::has('service1'))
<?php     $service = Session::get('service1');
 ?>
<dl class="dlist-align">
            <dt>Service Charge: </dt>
            <?php
             
            ?>
             <dd class="text-right h6 b">{{$service}}%</dd> 
        </dl>
        <br>
    <dl class="dlist-align">
        <dt class="h5 b" >Sub Total:</dt>
        <?php $last = $last1+($last1*($service/100)) ?>

        <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>
           
     @endif
                </dl>
                @endif
        <dl class="dlist-align">
       
        <?php
        use App\Paid;
        $pay = Session::get('paid1');  
        $changes = Session::get('change1');
        
        ?>
        <dl class="dlist-align">
        <dt class="h5 b text-success">Paid:</dt>
  
        <?php if($pay){
    ?>
        <dd class="text-right h4 b text-success">£{{number_format($pay,2)}}</dd>
<?php }else{ ?>
    <dd class="text-right h4 b text-success">£0.00</dd>
    <?php }?>

  
        </dl>
        <hr class="m-0">
        <dl class="dlist-align pt-0 mt-0">
       
        <!-- {{$pay}} -->
            <dt class="h5 b text-info">Change: </dt>
        
            <dd class="text-right text-info h4 b">£{{number_format($changes,2)}}</dd>
          
   
    </dl>

</div>


</div>
  
  
        <hr class="m-0">

<?php 
    use App\Table;
    $tbls = Table::all()
?>
 
            <div class="form-row">
          
           
           
            <!-- </form> -->
          
            
         
     </div>
         
    
    </dl>
    <!-- <hr> -->



    <div class="row mb-0">
        <div class="col-md-6">
        <script>
               $('#myModal').modal(options)
            </script>

<button type="button" class="btn btn-primary  py-3 btn-lg btn-block" data-toggle="modal" data-target="#exampleModalCenter">
    <i class="far fa-money-bill-alt "></i> Cash
  </button>
  
  <!-- Modal -->
  <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Cash Amount</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
          
<div class="btn-group-vertical w-100" role="group" aria-label="Basic example">
    <div class="">
   

        <form method="post" action="{{route('tblpaid1')}}">
            @csrf
            @method('post')
            <div class="form-group">
                <input class="text-center form-control-lg myinput" id="code"  name="paid" style="border-style: none; font-size:30px;" placeholder="Enter Cash amount">
                @if(session::has('tbl1'))
                <input type="hidden" class="form-control" name="last"  value="{{$last}}" placeholder="Enter discount name">
            @endif
            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code"> --}}
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '1';">1</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '2';">2</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '3';">3</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '4';">4</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '5';">5</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '6';">6</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '7';">7</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '8';">8</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '9';">9</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '.';">.</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value + '0';">0</button>
        <button type="button" class="btn btn mynmbbtn" onclick="document.getElementById('code').value=document.getElementById('code').value.slice(0, -1);">&lt;</button>
    </div>
    <div class="btn-group">
    <button type="button" class="btn mt-3 btn-danger mydelbtn" onclick="document.getElementById('code').value=document.getElementById('code').value.slice(0, 0);">Clear</button>
    <button type="submit" class="btn mt-3 btn-success mysavebtn" onclick="">Paid</button>
</div>
</form>
</div>
</div>
</div>
    </div>
  </div>

            <!-- <a href="{{route('cash')}}" class="btn py-3 btn-primary btn-lg btn-block"><i class="fa fa-money-bill-alt "></i> Cash </a> -->
        </div>
        <div class="col-md-6 mb-0">
            <a href="{{route('tblcard1')}}" class="btn py-3 btn-warning btn-lg btn-block"><i class="fa fa-credit-card"></i> Card </a>
        </div>
    </div>
    
   
    
        



    <br>
    <div class="row pt-0 mt-0 mb-0">
        {{-- <div class="col-md-6 pt-0 mt-0 mb-0">
            <a href="{{route('printPos1')}}" class="btn py-3 btn-info btn-lg btn-block"><i class="fa fa-print"></i> Print </a>
        </div> --}}
      
            <div class="col-md-6 pt-0 mt-0">
        <input type="button" value="Print" onclick="PrintDiv1();" id="btnPrint" class="btn py-3 btn-info btn-lg btn-block"/>
            </div>
        <div class="col-md-6 pt-0 mt-0">
            <a href="{{route('destroy1')}}" class="btn py-3  btn-danger btn-lg btn-block"><i class="fa fa-times-circle "></i> Clear Cart </a>
        </div>
    </div>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script> -->
    <script type="text/javascript">
        function PrintDiv1() {
            var contents = document.getElementById("printContent1").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>
    <?php
                    
                    if ( ! Session::has('tbl1')){
                        return view ('epoz.order',['products'=>NULL]);
                    }
                    $oldCart = Session::get('tbl1');
                    $cart = new epozCart($oldCart);
                    $products = $cart->items;
                    $totalPrice= $cart->totalPrice;
                    $x =0;
                    $tbl = Session::get('tbl_no1');
                    $person = Session::get('person1');
                    // session_start();
                    // $order_id = session_id();
                    // session_unset();
                    // session_destroy();
                    $open = Session::get('open1');
                    $extra = Session::get('extra1');
                    $service = Session::get('service1');
                    $dis = epozDiscount::find(1);
                    ?>
    <form id="form1">
        <div id="printContent1">
            <div class="container hide">
                <div class="col-md-12">
                    
                   
                   <div class="ticket">
                        <img src="img/logoprint.png" alt="Logo">
                        <p class="centered">DAMASCUS LOUNGE
                            <br>EAT IN
                            <br>119-121, BRICK LANE
                            <br>LONDON E1 6SE
               <br> VAT Reg. 335 1553 18
               <br>Order ID: {{substr(Session::getId(),0,4)}}
                        <br>Table no: {{$tbl}}/{{$person}} p</p>
                        <table>
                            <thead>
                                <tr>
                                    <th class="sl">Sl.</th>
                                    <th class="description">Name</th>
                                    <th class="quantity">Q.</th>
                                    <th class="price">Price</th>
                                </tr>
                            </thead>
                            <td class="sl" colspan="4">------------------------------------------------------</td>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="sl">{{$x=$x+1}}</td>
                                    <td class="description">{{$product['item']['name']}}</td>
                                    <td class="quantity">{{$product['qty']}}</td>
                                    <td class="price">£{{$product['item']['price']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="sl" colspan="4">------------------------------------------------------</td>
                                </tr>
                                <?php if($open){ ?>
                                <tr>
                                    <td class="sl" colspan="2">Open Food</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">+£{{number_format($open,2)}}</td>
                                </tr>
                                <?php }?>

                               <?php if($dis){ ?>
                                <tr>
                                    <td class="sl" colspan="2">Discount(%)</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">{{$dis->discount}} %</td>
                                </tr>
                                <?php }?>
                                <?php if($extra){ ?>
                                <tr>
                                    <td class="sl" colspan="2">Discount(£)</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">-£{{number_format($extra,2)}}</td>
                                </tr>
                                <?php }?>
                                <?php if($tax->tax>0){ ?>
                                <tr>
                                    <td class="sl" colspan="2">Tax</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">{{$tax->tax}}%</td>
                                </tr>
                                <?php }?>
                                 <?php if($service){ ?>
                                <tr>
                                    <td class="sl" colspan="2">Service Charge</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">{{$service}}%</td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <td class="sl" colspan="2">Total</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($last,2)}}</td>
                                </tr>
                                <tr>
                                    <td class="sl" colspan="4">------------------------------------------------------</td>
                                </tr>
                                <?php
    
    $pay= Session::get('paid');
//                    dd($change)
        ?>
                                <tr>
                                    <td class="sl" colspan="2">Paid</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($pay,2)}}</td>
                                </tr>
                                <?php
    
    $change= Session::get('change');
//                    dd($change)
        ?>
                                <tr>
                                    <td class="sl" colspan="2">Change</td>
                                    
                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($change,2)}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="centered">Thanks for your purchase!
                            <br>info@damascuslounge.com
                            <br>020 7033 0400</p>
                    </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
        <input type="button" value="Print " id="btnPrint" class="btn  btn-success btn-lg btn-block"/>
    </div>
        </div> --}}
    </form>
</div> <!-- box.// -->

