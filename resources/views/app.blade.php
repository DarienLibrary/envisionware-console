<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Envisionware Tools</title>

    <!-- Bootstrap & custom style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/envisionware.css') }}">
    @yield('customcss')

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body role="document">

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Envisionware Tools</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#PCR">PC Reservation</a></li>
                <li><a href="#AAM">AAM</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Service Desks</li>
                        <li><a href="/report/tx/welcomedesk/1">Welcome Desk Drawer 1: Merchandise Transactions</a></li>
                        <li><a href="/report/tx/welcomedesk/2">Welcome Desk Drawer 2: Merchandise Transactions</a></li>
                        <li><a href="/report/tx/helpdesk">Help Desk: Merchandise Transactions</a></li>
                        <li><a href="/report/tx/helpdeskGrouped">Help Desk: Merchandise Transactions (Grouped)</a></li>
                        <li><a href="/report/tx/cafe">Cafe: Merchandise Transactions</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Payment Stations</li>
                        <li><a href="/report/tx/kioskKLS">KLS Station: Individual Transactions</a></li>
                        <li><a href="/report/tx/kioskBC">Business Center Station: Individual Transactions</a></li>
                        <li><a href="/report/tx/kioskPL">Power Library Station: Individual Transactions</a></li>
                        <li><a href="/report/tx/kioskWeb">Web Payment: Individual Transactions</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Library Document Stations</li>
                        <li><a href="/report/tx/ldsKLS">KLS Station: Not Yet Implemented</a></li>
                        <li><a href="/report/tx/ldsBC">Business Center Station: Not Yet Implemented</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="padding-top:70px">

    @yield('content')

</div>
<!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@yield('customscripts')

</body>
</html>