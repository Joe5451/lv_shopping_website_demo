<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-store, max-age=0, no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo url('admin'); ?>/">
    <link rel="stylesheet" href="css/admin.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/dropify.css" />
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/tailwind.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/dropify.js"></script>
    <title>購物網站後台</title>
</head>
<body>

<div id="admin_header_mobile">
    <a href="#" class="admin_header_logo_mobile">TEMPLATE</a>
    <button id="admin_sidebar_open_btn_mobile">
        <i class="fas fa-bars"></i>
    </button>

    <script>
        $('#admin_sidebar_open_btn_mobile').click(function() {
            $('#admin_sidebar').css('transform', 'translateX(0%)');
            $('#admin_sidebar_bg_mobile').stop().fadeIn();
        });
    </script>
</div>

<div id="admin_header_space"></div>

<div id="admin_sidebar_bg_mobile"></div>

<div id="admin_sidebar">
    <button id="admin_sidebar_close_btn_mobile">
        <i class="fas fa-times"></i>
    </button>

    <script>
        $('#admin_sidebar_close_btn_mobile').click(function() {
            $('#admin_sidebar').css('transform', 'translateX(-100%)');
            $('#admin_sidebar_bg_mobile').stop().fadeOut();
        });

        $('#admin_sidebar_bg_mobile').click(function() {
            $('#admin_sidebar').css('transform', 'translateX(-100%)');
            $('#admin_sidebar_bg_mobile').stop().fadeOut();
        });
    </script>
    
    <a href="#" class="admin_sidebar_logo">TEMPLATE</a>

    <nav class="admin_sidebar_nav custom_scrollbar">
        <div class="admin_sidebar_link_wrap">
            <a href="#" class="admin_sidebar_link">首頁</a>
        </div>
        
        <div class="admin_sidebar_dropdown">
            <div class="admin_sidebar_dropdown_title" menu="news">最新消息 <i class="fas fa-angle-down"></i></div>
            <div class="admin_sidebar_dropdown_content">
                <a href="{{ route('admin.news_list') }}" class="admin_sidebar_dropdown_link" sub-menu="news_list">最新消息列表</a>
                <a href="{{ route('admin.news_category_list') }}" class="admin_sidebar_dropdown_link" sub-menu="news_category">最新消息類別</a>
            </div>
        </div>

        <div class="admin_sidebar_dropdown">
            <div class="admin_sidebar_dropdown_title" menu="product">商品管理 <i class="fas fa-angle-down"></i></div>
            <div class="admin_sidebar_dropdown_content">
                <a href="{{ route('admin.product_list') }}" class="admin_sidebar_dropdown_link" sub-menu="product_list">商品列表</a>
                <a href="{{ route('admin.product_category_list') }}" class="admin_sidebar_dropdown_link" sub-menu="product_category">商品類別</a>
            </div>
        </div>

        <div class="admin_sidebar_link_wrap">
            <a href="@{{ route('admin.order_list') }}" class="admin_sidebar_link">訂單管理</a>
        </div>

        <div class="admin_sidebar_link_wrap">
            <a href="@{{ route('admin.member_list') }}" class="admin_sidebar_link">會員管理</a>
        </div>
        
        <div class="admin_sidebar_link_wrap">
            <a href="{{ route('admin.contact_list') }}" menu="contact" class="admin_sidebar_link">聯絡我們</a>
        </div>

        <div class="admin_sidebar_link_wrap">
            <a href="@{{ route('admin.logout') }}" class="admin_sidebar_link">登出</a>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            $('.admin_sidebar_dropdown_title[menu={{ $main_menu }}]').addClass('active');
            $('.admin_sidebar_link[menu={{ $main_menu }}]').addClass('active');
            
            $('.admin_sidebar_dropdown_title[menu={{ $main_menu }}]')
            .parent().find('.admin_sidebar_dropdown_link[sub-menu={{ $sub_menu }}]').addClass('active');

            $('.admin_sidebar_dropdown_title.active').find('i').addClass('fa-rotate-180');
            $('.admin_sidebar_dropdown_title.active').next('.admin_sidebar_dropdown_content').slideDown();

        });

        $('.admin_sidebar_dropdown_title').click(function() {
            $(this).toggleClass('active');
            $(this).find('i').toggleClass('fa-rotate-180');
            $(this).next('.admin_sidebar_dropdown_content').stop().slideToggle();
        });
    </script>
</div>

<div class="admin_content">
