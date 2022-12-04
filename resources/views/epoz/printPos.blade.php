<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
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
    </script>
</head>
<body>
<form id="form1">
    <div id="dvContainer">
        <div class="container">
            <div class="col-md-12">
                <?php
                use App\epozCart;
                if ( ! Session::has('ecart')){
                    return view ('epoz.order',['products'=>NULL]);
                }
                $oldCart = Session::get('ecart');
                $cart = new epozCart($oldCart);
                $products = $cart->items;
                $totalPrice= $cart->totalPrice;
                $x =0;




                ?>
                <h2>DemoNmae</h2>
                <p>119-121 <br>
                    BRICK LANE <br>
                    LONDON E1 6SE <br>
                    <br><br>
                    020 7033 0400 <br>
                    info@damascuslounge.com</p>
                    <p>-------------------------------------------</p>
                <table class="table">
                    <tr>
                        <th>Sl</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>

                    </tr>
                    @foreach($products as $product)
                        <tr>
                                <td>{{$x=$x+1}}</td>
                                <td>{{$product['item']['name']}}</td>
                                <td>{{$product['qty']}}</td>
                                <td>{{$product['item']['price']}}</td>

                        </tr>
                    @endforeach
                </table>
                    <p>Total Price:----------------- {{$totalPrice}}</p>
                <?php

                    $change= Session::get('change');
//                    dd($change)
                        ?>
                   <p>Change:--------------------- {{$change}}</p>
                  <?php  ?>
            </div>
        </div>

    </div>
    <input type="button" value="Print " id="btnPrint" />
</form>
</body>
</html>
