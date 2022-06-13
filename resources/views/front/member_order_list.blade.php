@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>

    <img src="{{ $img_src }}" alt="會員中心" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">訂單記錄</h1>
        <h2 class="page_head_banner_subtitle">Order Record</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="{{ route('home') }}" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('member.update_form') }}" class="page_breadcrumb_link">會員中心</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('member.order_list') }}" class="page_breadcrumb_link active">訂單記錄</a>
    </nav>

    <div class="flex items-start flex-wrap">
        <div class="w-full md:w-1/4 mb-8">
            <button class="member_sidebar_toggle_btn_mobile">
                <i class="fas fa-caret-down"></i>
                會員中心
            </button>
            <div class="member_sidebar_content w-full md:w-72 max-w-full">
                <a href="{{ route('member.update_form') }}" class="member_sidebar_link">會員資料</a>
                <a href="{{ route('member.order_list') }}" class="member_sidebar_link active">訂單記錄</a>
                <a href="{{ route('member.logout') }}" class="member_sidebar_link">會員登出</a>
            </div>

            <script>
                $('.member_sidebar_toggle_btn_mobile').click(function() {
                    $(this).find('i').toggleClass('fa-rotate-180');
                    $('.member_sidebar_content').stop().slideToggle();
                });
            </script>
        </div>
        
        @if (count($orders) == 0)
            <div class="text-xl md:w-3/4 px-0 md:px-4 font-bold w-full text-center text-slate-700">無資料</div>
        @else
            <div class="w-full md:w-3/4 px-0 md:px-4">
                <div class="text-xl flex items-center bg-slate-100 text-slate-700">
                    <div class="shrink-0 py-2.5 px-4 text-right w-20">項次</div>
                    <div class="hidden lg:block shrink-0 py-2.5 px-4 text-center grow">訂單編號</div>
                    <div class="hidden lg:block shrink-0 py-2.5 px-4 text-center w-40 xl:w-48">訂單日期</div>
                    <div class="hidden lg:block shrink-0 py-2.5 px-4 text-right w-40 xl:w-48">訂單總額</div>
                    <div class="hidden lg:block shrink-0 py-2.5 px-4 text-center w-40 xl:w-48">訂單狀態</div>
                    <div class="block lg:hidden text-xl shrink-0 py-2.5 px-4 text-center grow">訂單內容</div>
                </div>

                @foreach ($orders as $order)
                <a href="#" onclick="event.preventDefault();" class="transition duration-300 hover:bg-gray-50 text-lg sm:text-xl text-slate-500 flex flex-col lg:flex-row border-b border-slate-300 relative py-2 lg:py-0 pl-20 lg:pl-0">
                    <div class="shrink-0 lg:py-2.5 px-4 text-right w-20 absolute lg:static top-2 left-0">
                        {{ $loop->index + 1 }}
                    </div>
                    <div class="shrink-0 mb-1 lg:mb-0 lg:py-2.5 px-4 lg:text-center lg:grow">
                        <span class="inline lg:hidden">訂單編號：</span>
                        {{ $order->order_number }}
                    </div>
                    <div class="shrink-0 mb-1 lg:mb-0 lg:py-2.5 px-4 lg:text-center lg:w-40 xl:w-48">
                        <span class="inline lg:hidden">訂單日期：</span>
                        {{ date('Y/m/d', strtotime($order->datetime)) }}
                    </div>
                    <div class="shrink-0 mb-1 lg:mb-0 lg:py-2.5 px-4 lg:text-right lg:w-40 xl:w-48">
                        <span class="inline lg:hidden">訂單總額：</span>
                        ${{ number_format($order->total) }}
                    </div>
                    <div class="shrink-0 mb-1 lg:mb-0 lg:py-2.5 px-4 lg:text-center lg:w-40 xl:w-48">
                        <span class="inline lg:hidden">訂單狀態：</span>
                        {{ $order_states[$order->order_state] }}
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

@include('front.foot')
