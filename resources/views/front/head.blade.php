<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="{{ url('') }}/">
    
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/slick-theme.css" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/tailwind.js"></script>
    <script src="js/slick.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
    <title>購物網站</title>
</head>
<body>

<header id="main_header" class="shadow-md">
    <a href="{{ route('home') }}" class="main_header_logo">TEMPLATE</a>

    <nav class="main_header_navi">
        <div class="main_header_link_wrap">
            <a href="{{ route('home') }}" class="main_header_link" menu-id="1">首頁</a>
        </div>
        <div class="main_header_link_wrap">
            <a href="{{ route('news.list') }}" class="main_header_link" menu-id="2">最新消息</a>
        </div>
        <div class="main_header_link_wrap">
            <a href="{{ route('product.first_list') }}" class="main_header_link" menu-id="3">購物商城</a>
        </div>
        <div class="main_header_link_wrap">
            <a href="{{ route('contact') }}" class="main_header_link"  menu-id="4">聯絡我們</a>
        </div>
    </nav>

    <div class="main_header_btn_group">
        <a href="{{ route('member.login_form') }}" class="main_header_btn" menu-id="5">
            <i class="fas fa-user"></i>
        </a>
        <a href="{{ route('cart.content') }}" class="main_header_btn main_header_cart_btn" menu-id="6">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart_amount">{{ $cart_amount }}</span>
        </a>
    </div>

    <div class="ham_btn" onclick="toggleMenu();">
        <div class="ham_bar" id="ham_bar1"></div>
        <div class="ham_bar" id="ham_bar2"></div>
        <div class="ham_bar" id="ham_bar3"></div>
    </div>

    <nav class="main_header_nav_mobile">
        <div class="main_header_link_wrap_mobile">
            <a href="{{ route('home') }}" class="main_header_link_mobile" menu-id="1">首頁</a>
        </div>
        <div class="main_header_link_wrap_mobile">
            <a href="{{ route('news.list') }}" class="main_header_link_mobile" menu-id="2">最新消息</a>
        </div>
        <div class="main_header_link_wrap_mobile">
            <a href="{{ route('product.first_list') }}" class="main_header_link_mobile" menu-id="3">購物商城</a>
        </div>
        <div class="main_header_link_wrap_mobile">
            <a href="{{ route('contact') }}" class="main_header_link_mobile" menu-id="4">聯絡我們</a>
        </div>
    </nav>
</header>

<div class="header_mask_mobile" onclick="closeMenu();"></div>

<div class="header_spacing"></div>

<script>
    $(document).ready(function() {
        var menu_id = {{ isset($menu_id) ? $menu_id : 0; }};

        $('.main_header_link[menu-id=' + menu_id + ']').addClass('active');
        $('.main_header_btn[menu-id=' + menu_id + ']').addClass('active');
        $('.main_header_link_mobile[menu-id=' + menu_id + ']').addClass('active');
    });
    
    function toggleMenu() {
        $('.ham_btn').toggleClass('active');
        $('.main_header_nav_mobile').stop().slideToggle();
        $('.header_mask_mobile').stop().fadeToggle();
    }

    function closeMenu() {
        $('.ham_btn').removeClass('active');
        $('.main_header_nav_mobile').stop().slideUp();
        $('.header_mask_mobile').stop().fadeOut();
    }
</script>