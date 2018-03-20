<!-- SITE-WIDE STYLES AND FONTS -->

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="../images/logos/shoeversity-favicon.png">

<!-- Header Nav Bar styles -->
<link rel="stylesheet" type="text/css" href="../css/header.css">

<!-- Main Page background -->
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/public.css">

<style type="text/css"> 	/* STYLE FOR PROMOTE PRODUCTS QUICK LINK */
	.promote-products {
        position: fixed;
        bottom: 50px;
        right: 0px;
        background-color: rgba(0,0,0, 0.67);
        color: #FFFFFF;
        z-index: 999;            
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 50px;
        padding-right: 80px;
    }

    .promote-products img {
        height: 30px;
        widows: 30px;
        margin-top: 16px;
    }

    .arrow-left {
      width: 0; 
      height: 0; 
      border-top: 72.5px solid transparent;
      border-bottom: 72.5px solid transparent; 
      position: fixed;
      bottom: 50px;
      right: 337px;
      z-index: 1000;            
      border-right:82.5px solid rgba(0,0,0, 0.67); 
    }

    .quicklink:hover .promote-products{
        -o-transition:.5s;
        -ms-transition:.5s;
        -moz-transition:.5s;
        -webkit-transition:.5s;
        transition:.5s;

        -webkit-filter: invert(100%);
         filter: invert(100%);
    }

    .quicklink:hover .arrow-left{
        -o-transition:.5s;
        -ms-transition:.5s;
        -moz-transition:.5s;
        -webkit-transition:.5s;
        transition:.5s;

        -webkit-filter: invert(100%);
         filter: invert(100%);
    }
</style>

<!-- Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Rammetto+One" rel="stylesheet">   -->
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&subset=latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&subset=latin-ext,vietnamese" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 


<!-- Footer -->
<link rel="stylesheet" type="text/css" href="../css/footer.css">

<!-- Date and Time function defaults -->
<?php date_default_timezone_set('Asia/Singapore'); ?>