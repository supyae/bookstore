<html>

<meta charset="utf-8">
<title>Simple Bookstore</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">



<link href="/css/app.css" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">


<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


<!-- date picker -->
<script src="/js/jquery.js"></script>

<link type="text/css" href="/css/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#datepicker,.dtpick").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange:"-50:+10",
            dateFormat: 'yy-mm-dd'
        });

        $( "#datepicker,.dtpick" ).datepicker( "option", "showAnim","slideDown" );
        $("#datepicker,.dtpick").attr( 'readOnly' , 'true' );

    });

</script>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <a class="brand" href="#">
                <font>Sample</font>
            </a>
            <div class="nav-collapse">

            </div>

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->

<div class="subnavbar">

    <div class="subnavbar-inner">

        <div class="container">

            <ul class="mainnav">
                <li class="">

                    <a href="/">
                        <i class="glyphicon glyphicon-list"></i>
                        <span>Book List</span>
                    </a>

                </li>

                <li class="">

                    <a href=" {!! url('/book') !!}">
                        <i class="glyphicon glyphicon-book"></i>
                        <span>Add New Book</span>
                    </a>

                </li>

                <li class="">
                    <a href=" {!! url('/author') !!}">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>Author</span>
                    </a>
                </li>
                <li class="">
                    <a href=" {!! url('/genre') !!} ">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <span>Genre</span>
                    </a>
                </li>

            </ul>


        </div> <!-- /container -->

    </div> <!-- /subnavbar-inner -->
</div>

@yield('content')


</body>

</html>