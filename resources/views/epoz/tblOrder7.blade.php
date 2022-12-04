

<?php
        use App\epozCart;
    if ( ! Session::has('tbl7')){
        return view ('epoz.tblOrder7',['products'=>NULL]);
    }
        $oldCart = Session::get('tbl7');
        $cart = new epozCart($oldCart);
        $products = $cart->items;
        // $totalPrice= $cart->totalPrice;
        $extra = Session::get('extra');
        $tbl_no = Session::get('tbl_no');
        // $tbl = Session::get('tbl7');

        ?>
            <div class="form-row mb-1">
            <!-- <div class="col">
            <p class="py-3 m-0" style="font-size:20px;"><strong>Table: </strong></p>
            </div> -->
            <div class="col">
            <a href="{{route('index1')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"    style="width: 70px;font-size:20px;">1</button>
            </a>
            <?php
            if (Session::has('tbl1')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index2')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"    style="width: 70px;font-size:20px;" data-target="#lev2">2</button>
            </a>
            <?php
            if (Session::has('tbl2')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index3')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"    style="width: 70px;font-size:20px;" data-target="#lev3">3</button>
            </a>
            <?php
            if (Session::has('tbl3')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index4')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"   style="width: 70px;font-size:20px;" data-target="#lev4">4</button>
            </a>
            <?php
            if (Session::has('tbl4')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index5')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"  style="width: 70px;font-size:20px;" data-target="#lev5">5</button>
            </a>
            <?php
            if (Session::has('tbl5')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index6')}}">
            <button class="btn btn-info btn-sm px-1 py-3 m-0"   style="width: 70px;font-size:20px;" data-target="#lev6">6</button>
            </a>
            <?php
            if (Session::has('tbl6')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
            <div class="col">
            <a href="{{route('index7')}}">
            <button class="btn btn-warning btn-sm px-1 py-3 m-0"   style="width: 70px;font-size:20px;" data-target="#lev7">7</button>
            </a>
            <?php
            if (Session::has('tbl7')){?>
                <div class="mt-1 card bg-danger" style="width:70px;height:10px;"></div>
                <?php }else{ ?>
                    <div class="mt-1 card bg-success" style="width:70px;height:10px;"></div>
                <?php } ?>
            </div>
     </div>

      <?php

    $persons= DB::table('person')->get();
?>
 <!-- Person -->
 <div class="row">
 <div class="col-md-12">
    <button class="btn btn-warning py-3 px-1 mx-0 mb-1 mt-1 btn-lg"  data-toggle="modal" style=" width:100%; font-size:20px;" data-target="#lev1"><i class="fa fa-users" aria-hidden="true"></i> Person(s)</button>
</div>
  </div>
<div class="modal" id="lev1" tabindex="-1" role="dialog" aria-labelledby="lev1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lev1">Person</h5>
          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body mt-0 pt-0">
        @foreach($persons as $person)
<div class="btn-group-vertical w-200" role="group" aria-label="Basic example">
    <div class="">

        <form method="post" id="form2" action="{{route('order_tbl7')}}">
            @csrf
                  @method('post')
           <div class="form-group">

           <input type="hidden" class="form-control" name="tbl_no"  value="1" >

           <input type="hidden" class="form-control" name="person"  value="{{$person->person}}" >


            </div>
        {{-- <input class="text-center form-control-lg mb-2" id="code1"> --}}
    </div>


    <button type="submit" class="btn btn-success px-5 py-1" style="font-size:30px;" onclick="">{{$person->person}}</button>


</div>
</form>
@endforeach

</div>
</div>

</div>
    </div>
   <!-- Person -->

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
         <a href="{{route('lessfood7',['id'=>$product['item']['id']])}}" type="button" class="m-btn px-3 py-1 btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
    </td>
	<td class="py-0" style="height:20px;">
<figure class="media pt-2">
	<figcaption class="media-body">
		<h6 class="title ">{{ $product['item']->name}}</h6>
	</figcaption>
</figure>
	</td>
	 <?php
       if($product['item']->name){
        $name_array[]= $product['item']->name;
         Session::put('name_items7',$name_array);
         Session::save();
	}else{
	    $name_array ='';
	}



    ?>
	<td class="py-0" class="text-center">
		<div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
		<a href="{{route('less7',['id'=>$product['item']['id']])}}" type="button" class="m-btn btn px-3 btn-primary mt-1"><i class="fa fa-minus"></i></a>
		<button type="button" class="m-btn btn btn-default mt-1" disabled>{{$product['qty']}}</button>
		<a href="{{route('moreCart7',['id'=>$product['item']['id']])}}}" type="button" class="m-btn btn px-3 btn-primary mt-1"><i class="fa fa-plus"></i></a>
		</div>
	</td>
	<?php

              if($product['qty']){
            $qty[] = $product['qty'];
             Session::put('qty_items7',$qty);
            Session::save();
        }else{
            $qty="";
        }

        ?>
	<td  class="py-0" style="height:20px;">
		<div class="price-wrap">
			<var class="price text-success pt-1">£{{number_format($product['price'],2)}}</var>
		</div> <!-- price-wrap .// -->
	</td>
	 <?php
        if($product['price']){
        $price[] = $product['price'];
         Session::put('price_items7',$price);
     Session::save();
	}else{
	$price="";
	}
    ?>
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
<?php
    //  Session::put('name_items7',$name_array);
    //  Session::save();
    //  Session::put('price_items7',$price);
    //  Session::save();
    //  Session::put('qty_items7',$qty);
    //  Session::save();
 ?>

<div class="box">

    <?php
    use App\epozDiscount;

    $open = Session::get('open7');
    $tbl = Session::get('tbl_no7');
    $person = Session::get('person7');

    $dis = epozDiscount::find(1);
    $extra = Session::get('extra7');
    $oldCart = Session::get('tbl7');
    $cart = new epozCart($oldCart);
    $products = $cart->items;
    // $prices= $cart->totalPrice;

    if($cart->totalPrice){

        $totalPrice= $cart->totalPrice;

        // Session::put('total', $totalPrice);
        // Session::save();

    }else{

         Session::forget('tbl7');
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


                    @if(session::has('card7'))
                <?php $card  = Session::get('card7') ?>
    <dl class="dlist-align">
         <dt class="b" >Payment:</dt>
        <dd class="text-right text-warning b"> {{$card}} </dd>
        @endif
    </dl>
    @if(session::has('cash7'))
                <?php $cash = Session::get('cash7') ?>
    <dl class="dlist-align">
        <dt class="b" >Payment:</dt>
        <dd class="text-right text-primary b"> {{$cash}} </dd>
        @endif
    </dl>
<?php if($open){
    ?>
    <dl class="dlist-align">
        <dt>OpenFood:</dt>
        <dd class="text-right">+£{{number_format($open,2)}}</dd>
    </dl>
<?php } ?>

@if(Session::has('tbl7'))
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
        </dl>
        @endif
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
@if(Session::has('tbl7'))
    <dl class="dlist-align">
        <dt class="h5 b" >Sub Total:</dt>
        <?php

            if($open && $dis->discount){
                $totalPrice = $totalPrice+$open;
                $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                $last=$disTotal+($disTotal*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>
            <?php }elseif($extra){
                 $disTotal =$totalPrice-$extra;
                 $last=$disTotal+($disTotal*($tax->tax/100));
                ?>
            <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>

            <?php }elseif($dis->discount){
                  $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                  $last=$disTotal+($disTotal*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format( $last,2)}} </dd>
            <?php }elseif($open){
                 $disTotal =$totalPrice+$open;
                 $last=$disTotal+($disTotal*($tax->tax/100));
                ?>
            <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>

            <?php }else{
                 $last=$totalPrice+($totalPrice*($tax->tax/100));
                ?>
                <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>
            <?php }?>

        <!-- <dl class="dlist-align">
            <dt>Sub Total:</dt>
            <dd class="text-right h4 b">£{{number_format($last=$disTotal+($disTotal*($tax->tax/100)),2)}}</dd>
        </dl> -->
        @endif
                </dl>
         @if(Session::has('service7')&& Session::has('tbl7'))
<?php     $service = Session::get('service7');
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
           <?php

            if($open && $dis->discount){
                $totalPrice = $totalPrice+$open;
                $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                $last1=$disTotal+($disTotal*($tax->tax/100));
                $last = $last1+($last1*($service/100))
                ?>
                <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>
            <?php }elseif($extra){
                 $disTotal =$totalPrice-$extra;
                 $last1=$disTotal+($disTotal*($tax->tax/100));
                 $last = $last1+($last1*($service/100))
                ?>
            <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>

            <?php }elseif($dis->discount){
                  $disTotal=$totalPrice-($totalPrice*($dis->discount/100));
                  $last1=$disTotal+($disTotal*($tax->tax/100));
                  $last = $last1+($last1*($service/100))
                ?>
                <dd class="text-right h4 b"> £{{number_format( $last,2)}} </dd>
            <?php }elseif($open){
                 $disTotal =$totalPrice+$open;
                 $last1=$disTotal+($disTotal*($tax->tax/100));
                 $last = $last1+($last1*($service/100))
                ?>
            <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>

            <?php }else{
                 $last1=$totalPrice+($totalPrice*($tax->tax/100));
                 $last = $last1+($last1*($service/100))
                ?>
                <dd class="text-right h4 b"> £{{number_format($last,2)}} </dd>
            <?php }?>

                </dl>
                @endif



        <dl class="dlist-align">

        <?php
        use App\Paid;
        $pay = Session::get('paid7');
        $changes = Session::get('change7');

        ?>

        <dl class="dlist-align">
        <dt class="h5 b text-success">Paid:</dt>

   @if(session::has('cash7'))
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
@endif
</div>


</div>


        <hr class="m-0">

<?php
    use App\Table;
    $tbls = Table::all();

?>


 <div class="row">
<div class="col-md-10 px-1">



    <div class="row mb-0">
        <div class="col-md-6 pr-1">
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


        <form method="post" action="{{route('tblpaid7')}}">
            @csrf
            @method('post')
            <div class="form-group">
                <input class="text-center form-control-lg myinput" id="code"  name="paid" style="border-style: none; font-size:30px;" placeholder="Enter Cash amount">
                @if(session::has('tbl7'))
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
        <div class="col-md-6 mb-0 pl-1">
            <a href="{{route('tblcard7')}}" class="btn py-3 btn-warning btn-lg btn-block"><i class="fa fa-credit-card"></i> Card </a>
        </div>
    </div>

    <div class="row pt-1 mt-0 mb-0 ">
        {{-- <div class="col-md-6 pt-0 mt-0 mb-0">
            <a href="{{route('printPos7')}}" class="btn py-3 btn-info btn-lg btn-block"><i class="fa fa-print"></i> Print </a>
        </div> --}}

            <div class="col-md-6 pt-0 mt-0 pr-1">
        <input type="button" value="Print" onclick="PrintDiv7();" id="btnPrint" class="btn py-3 btn-info btn-lg btn-block"/>
            </div>
        <div class="col-md-6 pt-0 mt-0 pl-1">
            <a href="{{route('destroy7')}}" class="btn py-3  btn-danger btn-lg btn-block"><i class="fa fa-times-circle "></i> Clear Cart </a>
        </div>
    </div>

    </div>
<div class="col-md-2 px-1">
<input type="button" value="Inst.P" onclick="PrintDiv7();" id="btnPrint" class="btn py-5 btn-success btn-lg btn-block"/>
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
        function PrintDiv7() {
            var contents = document.getElementById("printContent7").innerHTML;
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

                    if ( ! Session::has('tbl7')){
                        return view ('epoz.order',['products'=>NULL]);
                    }
                    $oldCart = Session::get('tbl7');
                    $cart = new epozCart($oldCart);
                    $products = $cart->items;
                    $totalPrice= $cart->totalPrice;
                    $x =0;
                    $tbl = Session::get('tbl_no7');
                    $person = Session::get('person7');
                    $service = Session::get('service7');
                    // session_start();
                    // $order_id = session_id();
                    // session_unset();
                    // session_destroy();
                    $open = Session::get('open7');
                    $extra = Session::get('extra7');
                     $dis = epozDiscount::find(1);
                    ?>
    <form id="form1">
        <div id="printContent7">
            <div class="container hide">
                <div class="col-md-12">


                   <div class="ticket">

                        <img class="centered" style="margin-left:60px;" src="/img/logoprint2.png" alt="Logo">
                        <p class="centered" style="margin-left:60px;" >Demo Name
                            <br>119-121, BRICK LANE
                            <br>LONDON E1 6SE
               <br> VAT Reg. 335 1553 18</p>
               <p>
               <br>Order ID: {{substr(Session::getId(),0,4)}}
                        <br>Table no: {{$tbl}}/{{$person}} p </p>                        <table>
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
                               <?php } ?>
                                <tr>
                                    <td class="sl" colspan="2">Total</td>

                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($last,2)}}</td>
                                </tr>
                                <tr>
                                    <td class="sl" colspan="4">------------------------------------------------------</td>
                                </tr>
                                <?php

    $pay= Session::get('paid7');
//                    dd($change)
        ?>


                             @if(session::has('cash7'))

                                <tr>
                                    <td class="sl" colspan="2">Paid</td>

                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($pay,2)}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td class="sl" colspan="2">Paid</td>

                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($last,2)}}</td>
                                </tr>


                                @endif


                                <?php

    $change= Session::get('change7');
//                    dd($change)
        ?>
                                    @if(session::has('cash7'))

                                <tr>
                                    <td class="sl" colspan="2">Change</td>

                                    <td class="quantity"></td>
                                    <td class="price">£{{number_format($change,2)}}</td>
                                </tr>

                                    @endif
                                <tr>
                                    <td class="sl" colspan="2">Payment Type:</td>

                                    <td class="quantity"></td>
                                    @if(session::has('card7'))
                                    <?php $card = Session::get('card7') ?>
                                    <td class="price">{{$card}}</td>
                                    @else
                                    <?php $cash = Session::get('cash7') ?>
                                    <td class="price">{{$cash}}</td>
                                     @endif
                                </tr>


                            </tbody>
                        </table>

                        <p class="centered">Thanks for your purchase!
                            <br>info@demo.com
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

