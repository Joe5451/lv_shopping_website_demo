@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>
    
    <img src="{{ $img_src }}" alt="最新消息" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">最新消息</h1>
        <h2 class="page_head_banner_subtitle">News</h2>
    </div>
</div>

<section class="mx-auto">
    <div class="custom_container">
        <nav class="page_breadcrumb">
            <a href="{{ route('home') }}" class="page_breadcrumb_link">首頁</a>
            <span class="page_breadcrumb_separator">〉</span>
            <a href="{{ route('news.list') }}" class="page_breadcrumb_link">最新消息</a>
            <span class="page_breadcrumb_separator">〉</span>
            <a href="{{ route('news.content', $new->id) }}" class="page_breadcrumb_link active">{{ $new->title }}</a>
        </nav>

        <div class="news_content_top px-4">
            <div class="news_content_img_wrap">
                <img src="{{ env('IMG_URL') . $new->img_src }}" class="news_content_img">
            </div>
            <div class="news_content_info">
                <div class="news_content_title">
                    <div class="news_content_title_text">{{ $new->title }}</div>
                    <div class="news_content_title_date">{{ date('Y/m/d', strtotime($new->date)) }}</div>
                </div>
                <div class="news_content_summary">{{ $new->summary }}</div>
            </div>
        </div>

        <div class="news_content px-4 mb-10">{{ $new->content }}</div>

    
    </div>
</section>

@include('front.foot')
