<?php
function ArabicDate() {
    $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
    $your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }
    header('Content-Type: text/html; charset=utf-8');
    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
    $current_date = date('d').' / '.$ar_month.' / '.date('Y');
    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

    return $arabic_date;
}
?>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('dashboard.Invoice')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboardAssets/app-assets/images/ico/favicon.ico')}}">
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background: #e0e0e0;
            font-family: "Roboto", sans-serif;
            /*background-repeat: repeat-y;*/
            /*background-size: 100%;*/
        }
        ::selection {
            background: #f31544;
            color: #fff;
        }
        ::moz-selection {
            background: #f31544;
            color: #fff;
        }
        h1 {
            font-size: 1.5em;
            color: #222;
        }
        h2 {
            font-size: 0.9em;
        }
        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        p {
            font-size: 0.7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoiceholder {
            width: 100%;
            hieght: 100%;
            padding-top: 50px;
        }
        #headerimage {
            z-index: -1;
            position: relative;
            top: -50px;
            height: 350px;
        }
        #invoice {
            position: relative;
            top: -290px;
            margin: 0 auto;
            width: 700px;
            background: #fff;
        }

        [id*="invoice-"] {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #eee;
            padding: 30px;
        }

        #invoice-top {
            min-height: 120px;
        }
        #invoice-mid {
            min-height: 120px;
        }
        #invoice-bot {
            min-height: 250px;
        }

        .logo {
            float: {{app()->getLocale()=='ar'?'right':'left'}};
            height: 60px;
            width: 60px;
            background: url('{{asset('dashboardAssets/images/restaurant-logo.jpg')}}') no-repeat;
            background-size: 60px 60px;
            border-radius: 10px;
        }
        .clientlogo {
            float: {{app()->getLocale()=='ar'?'right':'left'}};
            height: 60px;
            width: 60px;
            background: url('{{$order->user->image??asset("dashboardAssets/images/default_user.jpeg")}}') no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        .info {
            display: block;
            float: {{app()->getLocale()=='ar'?'right':'left'}};
            margin-{{app()->getLocale()=='ar'?'right':'left'}}: 20px;
            text-align: {{app()->getLocale()=='ar'?'right':'left'}};
        }
        .title {
            float: {{app()->getLocale()=='ar'?'left':'right'}};
            text-align: {{app()->getLocale()=='ar'?'end':'start'}};
        }
        .title p {
            text-align: {{app()->getLocale()=='ar'?'right':'left'}};
        }
        #project {
            margin-{{app()->getLocale()=='ar'?'right':'left'}}: 79%;
            text-align: {{app()->getLocale()=='ar'?'end':'start'}};
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            direction: {{app()->getLocale()=='ar'?'rtl':'ltr'}};
        }
        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #eee;
        }
        .tabletitle {
            padding: 5px;
            background: #eee;
        }
        .service {
            border: 1px solid #eee;
        }
        .item {
            width: 50%;
        }
        .itemtext {
            font-size: 0.9em;
        }

        #legalcopy {
            margin-top: 30px;
        }
        form {
            float: {{app()->getLocale()=='ar'?'right':'left'}};
            margin-top: 30px;
            text-align: {{app()->getLocale()=='ar'?'right':'left'}};
        }

        .effect2 {
            position: relative;
        }
        .effect2:before,
        .effect2:after {
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width: 300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }
        .effect2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }

        .legal {
            width: 70%;
        }

    </style>
</head>
<body>
<div id="invoiceholder">

    <div id="headerimage"></div>
    <div id="invoice" class="effect2">
        <div id="invoice-top">
            <div class="logo"></div>
            <div class="info">
                <h2>{{__('dashboard.restaurants')}}</h2>
                <p> {{auth()->user()->email}} </br>
                    {{now()->format('M-D-Y')}}
                </p>
            </div><!--End Info-->
            <div class="title">
                <h1>{{__('dashboard.Invoice')}} #{{$order->id}}</h1>
                <p>{{__('dashboard.Issued')}} : {{app()->getLocale()=='ar'?ArabicDate():now()->format('F d,Y')}}</br>
                    {{__('dashboard.payment status')}} : <span style="background-color:{{$order->payment_status == 1? '#0d8ddc':'#0b0e18'}}; color: white; padding: 0px 7px;" >{{$order->payment_status == 1? __('dashboard.paid'):__('dashboard.un-paid')}}</span>
                </p>
            </div><!--End Title-->
        </div><!--End InvoiceTop-->
        <div id="invoice-mid">
            <div class="clientlogo"></div>
            <div class="info">
                <h2 style="margin-bottom: 3px;">{{__('dashboard.customer details')}}</h2>
                <p style="margin-bottom: 3px;"><i class="fa fa-pencil"></i>{{$order->user->name??'Client Name'}}</p>
                <p style="margin-bottom: 3px;"><i class="fa fa-inbox"></i>{{$order->user->email??'JohnDoe@gmail.com'}}</p>
                <p><i class="fa fa-phone"></i>{{$order->user->phone??'555-555-5555'}}</p>
            </div>

            <div id="project">
                <h2 style="margin-bottom: 3px;">{{__('dashboard.branch')}}</h2>
                <p style="margin-bottom: 3px;"><i class="fa fa-pencil"></i>{{$order->branch->name}}.</p>
                <p style="margin-bottom: 3px;"><i class="fa fa-map-marker"></i>{{$order->branch->address??'JohnDoe@gmail.com'}}</p>
                <p><i class="fa fa-phone"></i>{{$order->branch->phone??'555-555-5555'}}</p>
            </div>

        </div><!--End Invoice Mid-->
        <div id="invoice-bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item"><h2>{{__('dashboard.services')}}</h2></td>
                        <td class="Hours"><h2>{{__('dashboard.size')}}</h2></td>
                        <td class="subtotal"><h2>{{__('dashboard.sub total')}}</h2></td>
                    </tr>
                    @foreach($order->services as $key=>$service)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{$service->name}}</p></td>
                            <td class="tableitem"><p class="itemtext">{{$order->sizes[$key]->name}}</p></td>
                            <td class="tableitem"><p class="itemtext">{{$service->pivot->price . ' ' . __('dashboard.SAR')}} </p></td>
                        </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h6>{{__('dashboard.table tax')}}</h6></td>
                        <td class="payment"><h6> + {{$order->tax .' '.__('dashboard.SAR')}}</h6></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2>{{__('dashboard.total price')}}</h2></td>
                        <td class="payment"><h2>{{$order->total_after_discount_and_tax .' '.__('dashboard.SAR')}}</h2></td>
                    </tr>

                </table>
            </div><!--End Table-->
        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</div><!-- End Invoice Holder-->
<script>
    window.onafterprint = window.close;
    window.print();
</script>
</body>
</html>
