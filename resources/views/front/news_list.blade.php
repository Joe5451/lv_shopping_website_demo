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
            <a href="{{ route('news.list') }}" class="page_breadcrumb_link active">最新消息</a>
        </nav>
    
        <?php /*
        <div class="news_category_nav custom_horizontal_scrollbar">
            <a href="{{ route('news.list') }}" class="news_category_link">全部</a>
            @foreach ($news_categories as $news_category)
                <a href="#" class="news_category_link">{{ $news_category->category_name }}</a>
            @endforeach
        </div>
        */ ?>
    
        <div class="news_list_container">
            @foreach ($news as $new)
                <div class="news_list">
                    <a href="{{ route('news.content', $new->id) }}" class="news_list_link">
                        <div class="news_list_img_wrap">
                            <img src="{{ env('IMG_URL') . $new->img_src }}" class="news_list_img">
                            <div class="news_list_more_mask">MORE</div>
                        </div>
                        <div class="news_list_content">
                            <div class="news_list_date">{{ date('Y/m/d', strtotime($new->date)) }}</div>
                            <div class="news_list_title">{{ $new->title }}</div>
                            <div class="news_list_summary">{{ $new->summary }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('front.foot')
