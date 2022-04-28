@include('front.head')

<div class="home_slider_block">
    <div class="home_slider_container">
        <a href="#" class="home_slider_link">
            <div class="home_slider_content"></div>
        </a>
        <a href="#" class="home_slider_link">
            <div class="home_slider_content"></div>
        </a>
        <a href="#" class="home_slider_link">
            <div class="home_slider_content"></div>
        </a>
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
    <h3 class="home_section_title">熱銷產品</h3>
    <h4 class="home_section_subtitle">令人愛不釋手</h4>

    <div class="home_hot_product_slider_container">
        <div class="home_hot_product_slider">
            <div class="product_card">
                <div class="product_card_img_wrap">
                    <img src="img/img2.png" alt="熱門產品" class="product_card_img">
                </div>
                <div class="product_card_body">
                    <div class="product_card_price">$300</div>
                    <div class="product_card_title">產品一</div>
                </div>
            </div>
        </div>
        <div class="home_hot_product_slider">
            <div class="product_card">
                <div class="product_card_img_wrap">
                    <img src="img/img2.png" alt="熱門產品" class="product_card_img">
                </div>
                <div class="product_card_body">
                    <div class="product_card_price">$300</div>
                    <div class="product_card_title">產品一</div>
                </div>
            </div>
        </div>
        <div class="home_hot_product_slider">
            <div class="product_card">
                <div class="product_card_img_wrap">
                    <img src="img/img2.png" alt="熱門產品" class="product_card_img">
                </div>
                <div class="product_card_body">
                    <div class="product_card_price">$300</div>
                    <div class="product_card_title">產品一</div>
                </div>
            </div>
        </div>
        <div class="home_hot_product_slider">
            <div class="product_card">
                <div class="product_card_img_wrap">
                    <img src="img/img2.png" alt="熱門產品" class="product_card_img">
                </div>
                <div class="product_card_body">
                    <div class="product_card_price">$300</div>
                    <div class="product_card_title">產品一</div>
                </div>
            </div>
        </div>
        <div class="home_hot_product_slider">
            <div class="product_card">
                <div class="product_card_img_wrap">
                    <img src="img/img2.png" alt="熱門產品" class="product_card_img">
                </div>
                <div class="product_card_body">
                    <div class="product_card_price">$300</div>
                    <div class="product_card_title">產品一</div>
                </div>
            </div>
        </div>
    </div>

    <div id="hot_product_dots_container" class="slider_dots_container"></div>
    
    <script>
        $('.home_hot_product_slider_container').slick({
            arrows: false,
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            appendDots: $('#hot_product_dots_container'),
            responsive: [
                {
                    breakpoint: 1024,
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
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
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
    <h3 class="home_section_title">關於我們</h3>
    
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

<section class="home_section">
    <h3 class="home_section_title">發現更多</h3>
    <h4 class="home_section_subtitle">還有許多超值商品等待您的探索!</h4>

    <div class="home_discover_container">
        <a href="#" class="home_discover_block">
            <div class="home_discover_img_wrap">
                <img src="img/img2.png" alt="" class="home_discover_img">
            </div>
            <div class="home_discover_content">
                <div class="home_discover_title">當季商品</div>
                <div class="home_discover_more_text">更多 <i class="fas fa-arrow-right"></i></div>
            </div>
        </a>
        <a href="#" class="home_discover_block">
            <div class="home_discover_img_wrap">
                <img src="img/img2.png" alt="" class="home_discover_img">
            </div>
            <div class="home_discover_content">
                <div class="home_discover_title">限量商品</div>
                <div class="home_discover_more_text">更多 <i class="fas fa-arrow-right"></i></div>
            </div>
        </a>
    </div>
</section>

@include('front.foot')
