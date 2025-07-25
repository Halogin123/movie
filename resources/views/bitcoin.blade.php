@extends('admin.layout.home')
@section('content')

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"style="font-size: 18px;">
                            <p id="btc-usd"></p>
                            <p id="btc-vnd"></p>
                        </div>
                        <div>BTC</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <div class="huge"style="font-size: 18px;">
                                <p id="bnb-usd"></p>
                                <p id="bnb-vnd"></p>
                            </div>
                        </div>
                        <div>BNB</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <div class="huge"style="font-size: 18px;">
                                <p id="xrp-usd"></p>
                                <p id="xrp-vnd"></p>
                            </div>
                        </div>
                        <div>XRP</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <div class="huge"style="font-size: 18px;">
                                <p id="eth-usd"></p>
                                <p id="eth-vnd"></p>
                            </div>
                        </div>
                        <div>ETH</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            callAPI();
            // displayTime();
            setInterval(callAPI, 10000);
            // setInterval(displayTime, 10000);
            function callAPI() {
                $.ajax({
                    type: "GET",
                    url: "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,BNB,XRP,ETH&tsyms=VND,USD,EUR&api_key=INSERT-YOUR-API-KEY-HERE",
                    success: function(response) {
                        console.log(response);
                        document.getElementById("btc-usd").innerHTML = response.BTC.USD.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        document.getElementById("btc-vnd").innerHTML = response.BTC.VND.toLocaleString('de-DE', {minimumFractionDigits: 1, maximumFractionDigits: 1});
                        document.getElementById("bnb-usd").innerHTML = response.BNB.USD.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        document.getElementById("bnb-vnd").innerHTML = response.BNB.VND.toLocaleString('de-DE', {minimumFractionDigits: 1, maximumFractionDigits: 1});
                        document.getElementById("xrp-usd").innerHTML = response.XRP.USD.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        document.getElementById("xrp-vnd").innerHTML = response.XRP.VND.toLocaleString('de-DE', {minimumFractionDigits: 1, maximumFractionDigits: 1});
                        document.getElementById("eth-usd").innerHTML = response.ETH.USD.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        document.getElementById("eth-vnd").innerHTML = response.ETH.VND.toLocaleString('de-DE', {minimumFractionDigits: 1, maximumFractionDigits: 1});
                    },
                    error: function(xhr, status, error) {
                        alert("Gọi API thất bại: " + error);
                    }
                });
            };
            // function displayTime() {
            //     // var now = new Date();
            //     // document.getElementById("clock").innerHTML = now.toLocaleTimeString();
            //     let count = 10;
            //     const countdown = setInterval(function() {
            //         count--;
            //         document.getElementById("clock").innerHTML = count;
            //         if (count === 0) {
            //         clearInterval(countdown);
            //         }
            //     }, 1000);
            // }

            // setInterval(displayTime, 1000); // Gọi hàm displayTime mỗi 1 giây
        });
    </script>
@stop
