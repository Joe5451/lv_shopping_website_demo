@include('front.head')

<div class="page_head_banner">
    <img src="img/img2.png" alt="最新消息" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">最新消息</h1>
        <h2 class="page_head_banner_subtitle">News</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="news.php" class="page_breadcrumb_link active">最新消息</a>
    </nav>

    <div class="news_category_nav custom_horizontal_scrollbar">
        <a href="#" class="news_category_link">全部</a>
        @foreach ($news_categories as $news_category)
            <a href="#" class="news_category_link">{{ $news_category->category_name }}</a>
        @endforeach
    </div>

    <div class="news_list_container">
        @foreach ($news as $new)
            <a href="#" class="news_list">
                <div class="news_list_content">
                    <div class="news_list_head">
                        <div class="news_list_year_and_date">
                            <div class="news_list_year">{{ date('Y', strtotime($new->date)) }}</div>
                            <div class="news_list_date">{{ date('m/d', strtotime($new->date)) }}</div>
                        </div>
                        <h4 class="news_list_title">{{ $new->title }}</h4>
                    </div>
                    <p class="news_list_summary">{{ $new->summary }}</p>
                    <div class="news_list_footer">
                        <div class="news_list_more">
                            看更多
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="news_list_img_wrap">
                    <img src="{{ env('APP_URL') . 'storage/app/'. $new->img_src }}" class="news_list_img">
                </div>
            </a>
        @endforeach
    </div>
</section>

@include('front.foot')
