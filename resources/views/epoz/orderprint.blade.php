 <script type="text/javascript">


        function PrintDivTst(x) {
        //     console.log(po);
           var pri= "modalprint"+x;
           // console.log(pri);
            var contents = document.getElementById(pri).innerHTML;
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


    <script type="text/javascript">


        function PrintDivMonth() {

            var contents = document.getElementById("PrintMonth").innerHTML;
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

    <form id="form1">
        <div id="PrintMonth">
            <div class="container hide">
                <div class="col-md-12">
                    <?php

                        $id = Session::get('status');
                        Session::forget('status');

                    ?>

                   <div class="ticket">
                        <img class="centered" style="margin-left:60px;" src="/img/logoprint2.png" alt="Logo">
                        <p class="centered" style="margin-left:60px;" >DemoName <script>document.write(po)</script>
                            <br>119-121, BRICK LANE
                            <br>LONDON E1 6SE
               <br> VAT Reg. 335 1553 18</p>

                        <table>
                            <thead>
                                <tr>
                                    <th class="sl">Month</th>
                                    <th class="quantity">Cash </th>
                                    <th class="price">Card</th>
                                    <th class="description">Total</th>
                                </tr>
                            </thead>
                            <td class="sl" colspan="4">------------------------------------------------------</td>
                            <tbody>

                                <tr>

                                    <td class="sl">{{$month_name}}</td>

                                     <td class="quantity">£{{number_format($totalCashofMonths,2)}}</td>
                                    <td class="price">£{{number_format($totalCardofMonths,2)}}</td>
                                    <td class="description">£{{number_format($totalmonths,2)}}</td>

                                <tr>
                                    <td class="sl" colspan="4">------------------------------------------------------</td>
                                </tr>

                            </tbody>
                        </table>

                        <p class="centered">info@demo.com
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

<script type="text/javascript">


    function PrintDivDay() {

        var contents = document.getElementById("PrintDay").innerHTML;
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
<form id="form1">
    <div id="PrintDay">
        <div class="container hide">
            <div class="col-md-12">
                <?php

                    $id = Session::get('status');
                    Session::forget('status');

                ?>

               <div class="ticket">
                    <img class="centered" style="margin-left:60px;" src="/img/logoprint2.png" alt="Logo">
                    <p class="centered" style="margin-left:60px;" >DemoName  <script>document.write(po)</script>
                        <br>119-121, BRICK LANE
                        <br>LONDON E1 6SE
           <br> VAT Reg. 335 1553 18</p>
                    <table>
                        <thead>
                            <tr>
                                <th class="description">Today</th>
                                <th class="sl">Cash</th>
                                <th class="quantity">Card</th>
                                <th class="price">Total</th>

                            </tr>
                        </thead>
                        <td class="sl" colspan="4">------------------------------------------------------</td>
                        <tbody>

                            <tr>
                                <!--<td class="sl">Thursday</td>-->
                                <td class="description">Today</td>
                                 <td class="sl">£{{number_format($totalCashofDays,2)}}</td>
                                <td class="quantity">£{{number_format($totalCardofDays,2)}}</td>
                                <td class="price">£{{number_format($totalamount,2)}}</td>

                            </tr>

                            <tr>
                                <td class="sl" colspan="4">------------------------------------------------------</td>
                            </tr>

                        </tbody>
                    </table>

                    <p class="centered">info@demo.com
                        <br>020 7033 0400</p>
                </div>
        </div>
    </div>

</form>
</div> <!-- box.// -->
