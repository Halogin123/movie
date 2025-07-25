<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <!-- Custom Theme files -->
    <!-- for-mobile-apps -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //for-mobile-apps -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!--Google Fonts-->
    <link href="{{ asset('assets/admin/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/assets/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
    <style>
        * {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }

        .toggle-right-sidebar span {
            background: #0D1326;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            color: #e6ebff;
            border-radius: 50px;
            font-size: 26px;
            cursor: pointer;
            opacity: .5;
        }
        .pull-right {
            float: right;
            position: fixed;
            right: 0px;
            top: 70px;
            width: 90px;
            z-index: 99999;
            text-align: center;
        }
        /* ============================================================
        RIGHT SIDEBAR SECTION
        ============================================================ */

        #right-sidebar {
            width: 90px;
            position: fixed;
            height: 100%;
            z-index: 1000;
            right: 0px;
            top: 0;
            margin-top: 60px;
            -webkit-transition: all .5s ease-in-out;
            -moz-transition: all .5s ease-in-out;
            -o-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
            overflow-y: auto;
        }


        /* ============================================================
        RIGHT SIDEBAR TOGGLE SECTION
        ============================================================ */

        .hide-right-bar-notifications {
            margin-right: -300px !important;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }

        /* reset */
        html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
        article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
        ol,ul{list-style:none;margin:0px;padding:0px;}
        blockquote,q{quotes:none;}
        blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
        table{border-collapse:collapse;border-spacing:0;}
        /* start editing from here */
        a{text-decoration:none;}
        .txt-rt{text-align:right;}/* text align right */
        .txt-lt{text-align:left;}/* text align left */
        .txt-center{text-align:center;}/* text align center */
        .float-rt{float:right;}/* float right */
        .float-lt{float:left;}/* float left */
        .clear{clear:both;}/* clear float */
        .pos-relative{position:relative;}/* Position Relative */
        .pos-absolute{position:absolute;}/* Position Absolute */
        .vertical-base{	vertical-align:baseline;}/* vertical align baseline */
        .vertical-top{	vertical-align:top;}/* vertical align top */
        nav.vertical ul li{	display:block;}/* vertical menu */
        nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
        img{max-width:100%;}
        /*end reset*/
        body{
            background: url({{ asset('assets/images/banner1.jpg') }})no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            padding:0;
            margin:0;
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 100%;
        }
        h1,h2,h3,h4,h5,h6{
            margin:0;
        }
        p{
            margin:0;
        }
        ul{
            margin:0;
            padding:0;
        }
        label{
            margin:0;
        }
        a{
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        a:hover{
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        /*--header start here--*/
        .header-main {
            padding: 30px 0px 50px;
            width: 30%;
            margin: 0 auto;
        }
        .header-main h1 {
            font-size: 64px;
            color: #FFFFFF;
            text-align: center;
            padding-bottom: 0.8em;
        }
        .sign-up {
            margin: 2em 0;
        }
        span.hed-white {
            color: #fff;
        }
        .style1 {
            text-align: right;
            padding: 60px 0px 40px 0px;
        }

        .sign-up h2 {
            font-size: 22px;
            color: #fff;
            font-family: 'Roboto Condensed', sans-serif;
            text-align: center;
            background:#ff3366;
            width: 40px;
            height: 40px;
            line-height: 1.7em;
            border-radius: 50%;
            margin: 0 auto;
        }

        .header-left-bottom h3 {
            font-size: 16px;
            font-weight: 400;
            color:#A59DA1;
            line-height: 1.5em;
            margin: 0px 0px 25px 0px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        span.login-color {
            color:#FFB900;
            font-weight: 700;
        }
        .header-left-bottom input[type="text"] {
            background: url(../images/m.png)no-repeat 0px 5px;
            outline: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            padding: 12px 13px 20px 44px;
            border:none;
            border-bottom:1px solid #fff;
            width: 87%;
            margin: 0 0 20px;
            display: inline-block;
        }
        .header-left-bottom input[type="password"]{
            background: url(../images/l.png)no-repeat 0px 5px;
            outline: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            border:none;
            border-bottom:1px solid #fff;
            padding: 12px 13px 20px 44px;
            width: 87%;
            margin: 0 0 20px;
            display: inline-block;
        }
        .header-left-bottom input[type="submit"] {
            background: #ff3366;
            color: #FFF;
            font-size: 26px;
            padding: 0.3em 1.2em;
            width: 100%;
            font-weight: 500;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: none;
            border-radius: 3px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .header-left-bottom input[type="submit"]:hover {
            background: #b5183f;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .remember {
            margin: 1em 0em;
        }
        .header-social {
            text-align: center;
        }
        h5 {
            border-left: 1px dotted #c3c3c3;
            padding: 0.5em;
        }
        .header-social a.face{
            background:url(../images/fac.png)no-repeat 12px 9px #3B62A3;
            color: #FFF;
            font-size: 16px;
            font-weight: 400;
            padding: 0 2em;
            width: 34%;
            text-align: left;
            margin-right: 4%;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            display: inline-block;
            border-radius:3px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .header-social a.face:hover{
            background:url(../images/fac.png)no-repeat 12px 9px #0E387C;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        /*-- agileits --*/
        .header-social a.twitt {
            background:url(../images/twitter.png)no-repeat 12px 9px #19B0E7;
            color: #FFF;
            font-size: 16px;
            font-weight: 400;
            padding: 0 2.5em;
            width: 30%;
            text-align: left;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border-radius:3px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .header-social a.twitt:hover {
            background: url(../images/twitter.png)no-repeat 12px 9px #0192C7;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .header-social h4 {
            font-size: 17px;
            color: #6A67CE;
            text-align: center;
            margin: 20px 0px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .header-social h4 a{
            color:#6A67CE;
        }
        .header-social h4 a:hover{
            color:#FFB900;
        }
        .header-left-bottom.checkbox {
            position: relative;
            display: block;
            float: left;
        }
        .header-left-bottom p {
            font-size: 20px;
            /*-- w3layouts --*/
            font-weight: 400;
            color: #000;
            display: inline-block;
            padding: 0px 0px 0px 68px;
        }
        .header-left-bottom p a{
            font-size: 20px;
            font-weight: 400;
            color: #000;
        }
        .header-left-bottom p a:hover{
            color:#777;
            text-decoration:none;
        }
        label.checkbox {
            display: inline-block;
        }
        span.sin-color {
            color:#FFB900;
            font-size: 16px;
            font-weight: 700;
        }
        .checkbox i {
            font-size: 20px;
            font-weight: 400;
            color: #999;
            font-style: normal;
        }
        .header-bottom-strip {
            margin: 60px 0px 0px 0px;
            padding: 40px 20px 30px 40px;
            background: #fff;
            margin:70px 0px 0px 0px;
            position:relative;
        }
        .header-bottom-strip input[type="text"] {
            outline: none;
            font-size: 17px;
            font-weight: 400;
            color: #000;
            padding: 20px 60px;
            border: 1px solid #39A1E5;
            margin: 0px 0px 15px 0px;
            width: 30%;
            -webkit-appearance: none;
            background:#eeeeee;
        }
        .strip-left input.user {
            /*-- agileits --*/
            background:url(../images/user.png)no-repeat 10px 9px #FBFBFB;
            display: block;
        }

        .strip-left input[type="password"]{
            outline: none;
            font-size: 17px;
            font-weight: 400;
            color: #000;
            padding:10px 10px 10px 40px;
            border: 1px solid #A59DA1;
            margin: 0px 0px 15px 0px;
            width: 78%;
            -webkit-appearance: none;
            background:#eeeeee;
        }
        .strip-left input.lock {
            background: url(../images/lock.png)no-repeat 10px 10px #FBFBFB;
            display: block;
        }
        .strip-left {
            float: left;
            width: 31%;
        }
        .strip-left.middle {
            margin: 0px 20px;
        }
        .strip-left input[type="text"] {
            outline: none;
            font-size: 15px;
            color: #000;
            padding:10px 10px 10px 40px;
            border: 1px solid #A59DA1;
            width: 78%;
            -webkit-appearance: none;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .strip-left input[type="submit"] {
            color: #FFF;
            font-size: 18px;
            padding: 0.4em 1.2em;
            width:100%;
            background:#ffb900;
            border-bottom:4px solid #C5920A;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border-right: none;
            border-left: none;
            border-top: none;
            font-family: 'Roboto Condensed', sans-serif;
        }
        /*-- w3layouts --*/
        .strip-left input[type="submit"]:hover {
            background:#6A67CE;
            border-bottom:4px solid #5350CA;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .strip-left h4 {
            font-size: 20px;
            font-weight: 600;
            color: #19B0E7;
            margin: 25px 0px 0px 25px;
            display:inline-block;
        }
        .strip-left ul.botm-strip-icon {
            padding: 0px 0px 0px 50px;
            list-style: none;
            display: inline-block;
            vertical-align: middle;
            float: right;
        }
        .strip-left ul.botm-strip-icon li {
            display: inline-block;
        }
        .strip-left ul.botm-strip-icon li a {
            background: url(../images/sprite.png)no-repeat;
            width: 20px;
            height: 25px;
            display: block;
        }
        .strip-left ul.botm-strip-icon li a.f {
            background-position: 0px 0px;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .strip-left ul.botm-strip-icon li a.tw {
            background-position: -21px 2px;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .strip-left ul.botm-strip-icon li a.f:hover{
            background-position: 0px -25px;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .strip-left ul.botm-strip-icon li a.tw:hover {
            background-position: -21px -25px;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .strip-left p {
            font-size: 20px;
            font-weight: 400;
            color: #999;
        }
        .strip-left p a{
            font-size: 16px;
            font-weight: 400;
            color: #999;
        }
        .strip-left p a:hover{
            color:#6a67ce;
            text-decoration:none;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
        }
        .tool-tip-main:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            bottom: -20px;
            border-right: 20px solid rgba(0, 0, 0, 0);
            border-bottom: 20px solid #fff;
            border-left: 20px solid rgba(0, 0, 0, 0);
            top: -9%;
            right: 6%;
        }
        .strip-login {
            background:#6a67ce;
            width: 25%;
            position: absolute;
            top: -41%;
            left: 73.5%;
            padding: 0.8em 0em 0.8em 0.8em;
        }
        .strip-sign-up h3 {
            font-size: 21px;
            color: #fff;
            margin: 0px;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .login-close {
            position: absolute;
            right: 10px;
            top: 16px;
            cursor: pointer;
        }
        .strip-sign-up {
            float: left;
        }
        .forgot {
            float: right;
        }
        .forgot h6 {
            font-size: 1em;
            margin-top: 0.2em;
        }
        .forgot h6 a{
            color:#efe8e8;
        }
        .forgot h6 a:hover{
            color:#ff3366;
        }
        .log-user h6 {
            font-size: 1em;
            float: left;
            color:#999;
        }
        .log-user {
            padding-top: 0.8em;
        }
        /*--cheek box--*/
        .remember-top{
            float:left;
        }
        .checkbox {
            margin-bottom: 4px;
            font-size: 1.2em;
            line-height: 27px;
            cursor: pointer;
        }
        .checkbox {
            position: relative;
            font-size: 0.95em;
            font-weight: normal;
            color:#efe8e8;
            padding: 0em 0.5em 0em 2.5em;
        }
        .checkbox i {
            position: absolute;
            bottom:5px;
            left: 2px;
            display: block;
            width: 18px;
            height: 18px;
            outline: none;
            background: #fff;
            border: 1px solid #6A67CE;
        }
        .checkbox input + i:after {
            content: '';
            background: url("../images/tick.png") no-repeat 5px 5px;
            top: -1px;
            left: -1px;
            width: 15px;
            height: 15px;
            font: normal 12px/16px FontAwesome;
            text-align: center;
        }
        .checkbox input + i:after {
            position: absolute;
            opacity: 0;
            transition: opacity 0.1s;
            -o-transition: opacity 0.1s;
            -ms-transition: opacity 0.1s;
            -moz-transition: opacity 0.1s;
            -webkit-transition: opacity 0.1s;
        }
        .checkbox input {
            position: absolute;
            left: -9999px;
        }
        .checkbox input:checked + i:after {
            opacity: 1;
        }
        /*---*/
        .clear{
            clear:both;
        }

        /*--header end here--*/
        /*--copyright start here--*/

        .copyright {
            padding: 30px 0px;
            text-align: center;
        }
        .copyright p {
            font-size: 16px;
            font-weight: 400;
            color: #fff;
        }
        .copyright p a{
            font-size: 16px;
            font-weight: 400;
            color: #fff;
        }
        .copyright p a:hover{
            color:#ff3366;
            text-decoration:none;
        }
        /*--footer end here--*/
        /*--meadia quries start here--*/

        @media(max-width:1440px){
            .header-main {
                width: 33%;
            }
        }
        @media(max-width:1366px){
            .header-main {
                width: 35%;
            }
        }
        @media(max-width:1280px){
            .header-main {
                width: 38%;
            }
        }
        @media(max-width:1024px){
            .header-main {
                width: 46%;
            }
            .header-main h1 {
                font-size: 63px;
            }
        }
        @media(max-width:991px){
            .header-main {
                width: 48%;
            }
        }
        @media(max-width:800px){
            .header-main {
                width: 60%;
            }
        }
        @media(max-width:768px){
            .header-main {
                width: 61%;
            }
            span.sin-color {
                font-size: 14px;
            }
        }
        @media(max-width:736px){
            .header-main {
                width: 65%;
            }
        }
        @media(max-width:667px){
            .header-main h1 {
                font-size: 60px;
            }
            .header-main {
                width: 67%;
            }
            .strip-left.middle {
                margin: 0px 16px;
            }
            .header-social a.face {
                margin-right: 2%;
            }
            .sign-up {
                margin: 1.5em 0;
            }
        }
        @media(max-width:640px){
            .header-main h1 {
                padding-bottom: 1.1em;
            }
            .header-main {
                width: 70%;
            }
        }
        @media(max-width:600px){
            .header-social a.twitt {
                width: 28%;
            }
            .header-social a.face {
                margin-right: 2%;
                width:33%;
            }
            .header-main h1 {
                font-size: 56px;
            }
        }
        @media(max-width:568px){
            .header-main {
                width: 80%;
            }
        }
        @media(max-width:480px){
            .header-main {
                padding: 60px 0px 30px;
            }
            .header-main h1 {
                font-size: 45px;
            }
            .header-left-bottom input[type="text"] {
                width: 83%;
            }
            .header-left-bottom input[type="password"] {
                width: 83%;
            }
            .header-main {
                width: 73%;
            }
            .header-social a.twitt {
                width: 24%;
            }
            .header-social a.face {
                width: 30%;
            }
            .header-left-bottom input[type="submit"] {
                font-size: 22px;
            }
        }
        @media(max-width:414px){
            .header-left-bottom input[type="text"] {
                width: 80%;
            }
            .header-left-bottom input[type="password"] {
                width: 80%;
            }
            .header-main {
                width: 75%;
            }
            .header-social a.twitt {
                width: 21%;
            }
            .header-social a.face {
                width: 27%;
            }
            .sign-up {
                margin: 1em 0;
            }
            .header-left-bottom input[type="submit"] {
                font-size: 20px;
            }
            .sign-up h2 {
                font-size: 18px;
                width: 36px;
                height: 36px;
                line-height: 1.9em;
            }
            .header-main {
                padding: 60px 0px 12px;
            }
            .copyright p a {
                line-height: 1.8em;
            }
            .header-main h1 {
                font-size: 42px;
            }
        }
        @media(max-width:384px){
            .header-main h1 {
                font-size: 38px;
            }
            .header-social a.face {
                width: 25%;
            }
            .header-social a.twitt {
                width: 19%;
            }
        }
        @media(max-width:375px){
            .header-main {
                width: 78%;
            }
            .copyright {
                padding: 19px 13px;
                text-align: center;
            }
        }
        @media(max-width:320px){
            .header-main {
                width: 85%;
            }
            .header-main {
                padding: 25px 0px 15px 0px;
            }
            .header-left-bottom input[type="text"] {
                padding: 12px 13px 15px 44px;
                width: 77%;
            }
            .header-left-bottom input[type="password"] {
                padding: 12px 13px 15px 44px;
                width: 77%;
            }
            .header-main h1 {
                font-size: 36px;
            }
            .header-social a.face {
                width: 23%;
            }
            .header-social a.twitt {
                width: 17%;
            }
            .header-left-bottom input[type="submit"] {
                font-size: 19px;
            }
            .checkbox {
                font-size: 0.8em;
            }
            .forgot h6 {
                font-size: 0.9em;
            }
            .header-left-bottom h3 {
                font-size: 12px;
            }
            .copyright p {
                font-size: 15px;
            }
            .header-main h1 {
                padding-bottom: 1em;
            }
            .remember {
                margin: 0.5em 0em;
            }
            .copyright {
                padding: 10px 6px 0;
            }
            .header-left-bottom input[type="password"] {
                margin: 0 0 17px;
            }
            .header-left-bottom input[type="text"] {
                margin: 0 0 17px;
            }
            .header-social a.face {
                margin-right: 4%;
            }
        }
        /*--meadia quries end here--*/
    </style>
</head>
<body>
<!--header start here-->
<div class="header">
    <div class="header-main">
        <h1>Đăng nhập</h1>
        <!---728x90--->

        <div class="header-bottom">
            <div class="header-right w3agile">

                <div class="header-left-bottom agileinfo">
                    <form action="{{ route('login-submit')}}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="" style="color: #FFFFFF">Email:</label><br>
                        <input type="text" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'demo@gmail.com';}"/>
                        <label for="" style="color: #FFFFFF">Password:</label><br>
                        <input type="password"  value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
                        <div class="remember">
			             <span class="checkbox1">
							   <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember me</label>
						 </span>
                            <div class="forgot">
                                <h6><a href="#">Forgot Password?</a></h6>
                            </div>
                            <div class="clear"> </div>
                        </div>


                        <input type="submit" value="Login">
                    </form>
                    <div class="header-left-top">
                        <div class="sign-up"> <h2>or</h2> </div>

                    </div>
                    <div class="header-social wthree">
                        <a href="#" class="face"><h5>Facebook</h5></a>
                        <a href="#" class="twitt"><h5>Twitter</h5></a>
                        <a href="{{ url('auth/google') }}">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="copyright">
    <p>© 2023 Login Form. All rights reserved | Design by  <a href="https://MovieChill.fun/" target="_blank"> Nguyễn Minh Đức </a></p>
</div>
</body>

<script src="{{ asset('assets/admin/assets/js/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/admin/assets/css/jquery-ui.css') }}">
<script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-98H8KRKT85'></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-98H8KRKT85');
</script>
</html>
