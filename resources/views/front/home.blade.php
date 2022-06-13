@include('front.head')

<div class="home_slider_block">
    <div class="home_slider_container">
        @foreach ($sliders as $slider)
            <?php 
                $href = ($slider->href == '') ? '' : 'href=' . $slider->href;
            ?>
            <a {{ $href }} class="home_slider_link">
                <div class="home_slider_content" style="background-image:url({{ env('IMG_URL') . $slider->img_src }});"></div>
            </a>
        @endforeach
    </div>
    <span class="home_slider_arrow home_slider_arrow_prev"><i class="fas fa-angle-left"></i></span>
    <span class="home_slider_arrow home_slider_arrow_next"><i class="fas fa-angle-right"></i></span>
    <div class="home_slider_dots_container"></div>
</div>

<script>
    $('.home_slider_container').slick({
        arrows: true,
        prevArrow: $('.home_slider_arrow_prev'),
        nextArrow: $('.home_slider_arrow_next'),
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay:true,
        autoplaySpeed:4000,
        speed:800,
        dots: true,
        appendDots: $('.home_slider_block'),
    })
</script>

<section class="home_hot_product_section home_section">
    <div class="custom_container">
        <div class="index_section_title_wrap">
            <div class="index_section_title">
                <div class="index_section_title_en">Shopping</div>
                <div class="index_section_title_ch">熱銷產品</div>
            </div>
        </div>
        
        <div class="home_hot_product_slider_container">
            @foreach ($products as $product)
                <div class="home_hot_product_slider">
                    <a href="{{ route('product.content', $product->id) }}" class="product_card">
                        <div class="product_card_img_wrap">
                            <img src="{{ env('IMG_URL') . $product->img_src }}" alt="{{ $product->product_name }}" class="product_card_img">
                            <div class="product_card_more_mask">
                                <i class="fas fa-shopping-cart"></i>
                                <div class="product_card_more_text">MORE</div>
                            </div>
                        </div>
                        <div class="product_card_body">
                            <div class="product_card_price">${{ number_format($product->price) }}</div>
                            <div class="product_card_title">{{ $product->product_name }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $('.home_hot_product_slider_container').slick({
            arrows: false,
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
            ]
        });
    </script>
</section>

<section class="home_section">
    <div class="home_features_container">
        <div class="home_feature">
            <div class="home_feature_icon_wrap">
                <i class="fas fa-utensils"></i>
            </div>
            <h4 class="home_feature_title">美食</h4>
            <p class="home_feature_content">除了購物還有美食</p>
        </div>
        <div class="home_feature">
            <div class="home_feature_icon_wrap">
                <i class="fas fa-couch"></i>
            </div>
            <h4 class="home_feature_title">休閒</h4>
            <p class="home_feature_content">除了購物還有放鬆</p>
        </div>
        <div class="home_feature">
            <div class="home_feature_icon_wrap">
                <i class="fas fa-gamepad"></i>
            </div>
            <h4 class="home_feature_title">玩樂</h4>
            <p class="home_feature_content">除了購物還有玩樂</p>
        </div>
        <div class="home_feature">
            <div class="home_feature_icon_wrap">
                <i class="fas fa-coffee"></i>
            </div>
            <h4 class="home_feature_title">下午茶</h4>
            <p class="home_feature_content">度過一個悠閒的午後時光</p>
        </div>
    </div>
</section>

<section class="home_section home_section_secondary_bg">
    <div class="index_section_title_wrap">
        <div class="index_section_title">
            <div class="index_section_title_en">About Us</div>
            <div class="index_section_title_ch">關於我們</div>
        </div>
    </div>
    
    <div class="home_section_content">
        <div class="home_intro_slider_container">
            <div class="home_intro">
                <h4 class="home_intro_title">美食</h4>
                <p class="home_intro_content">除了購物還有美食</p>
            </div>
            <div class="home_intro">
                <h4 class="home_intro_title">休閒</h4>
                <p class="home_intro_content">除了購物還有放鬆</p>
            </div>
            <div class="home_intro">
                <h4 class="home_intro_title">玩樂</h4>
                <p class="home_intro_content">除了購物還有玩樂</p>
            </div>
        </div>
    
        <div id="feature_intro_dots_container" class="slider_dots_container"></div>
    </div>

    <script>
        $('.home_intro_slider_container').slick({
            arrows: false,
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            appendDots: $('#feature_intro_dots_container'),
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });
    </script>
</section>

<section class="index_news_section">
    <div class="custom_container">
        <div class="index_section_title_wrap">
            <div class="index_section_title">
                <div class="index_section_title_en">News</div>
                <div class="index_section_title_ch">最新消息</div>
            </div>
        </div>
    
        <div class="index_news_slider_block">
            <div class="index_news_slider_container">
                @foreach ($news as $new)
                    <div class="index_news_slider">
                        <a href="{{ route('news.content', $new->id) }}" class="index_news_slider_link">
                            <div class="index_news_slider_img_wrap">
                                <img src="{{ env('IMG_URL') . $new->img_src }}" class="index_news_slider_img">
                                <div class="index_news_slider_more_mask">MORE</div>
                            </div>
                            <div class="index_news_slider_content">
                                <div class="index_news_slider_date">{{ date('Y/m/d', strtotime($new->date)) }}</div>
                                <div class="index_news_slider_title">{{ $new->title }}</div>
                                <div class="index_news_slider_summary">{{ $new->summary }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
    
            <span class="index_news_slider_arrow" id="index_news_slider_arrow_prev">
                <i class="fas fa-angle-left"></i>
            </span>
            <span class="index_news_slider_arrow" id="index_news_slider_arrow_next">
                <i class="fas fa-angle-right"></i>
            </span>
        </div>
    </div>

    <script>
        $('.index_news_slider_container').slick({
            dots: false,
            arrows: true,
            prevArrow: $('#index_news_slider_arrow_prev'),
            nextArrow: $('#index_news_slider_arrow_next'),
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay:true,
            autoplaySpeed:4000,
            speed:800,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        })
    </script>
</section>

@include('front.foot')
