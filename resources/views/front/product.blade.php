@include('front.head')

<div class="page_head_banner">
    <img src="img/img2.png" alt="購物商城" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">購物商城</h1>
        <h2 class="page_head_banner_subtitle">Shopping</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="product_list.php" class="page_breadcrumb_link">購物商城</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="product.php" class="page_breadcrumb_link active">千年人參</a>
    </nav>

    <div class="product_content_container">
        <div class="product_top_block">
            <div class="product_img_block">
                <div class="product_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_img">
                </div>

                <div class="product_img_slider_container">
                    <div class="product_img_slider">
                        <img src="img/img2.png" alt="產品" class="product_img_slider_content active">
                    </div>
                    <div class="product_img_slider">
                        <img src="img/img2.png" alt="產品" class="product_img_slider_content">
                    </div>
                    <div class="product_img_slider">
                        <img src="img/img2.png" alt="產品" class="product_img_slider_content">
                    </div>
                    <div class="product_img_slider">
                        <img src="img/img2.png" alt="產品" class="product_img_slider_content">
                    </div>
                </div>

                <script>
                    $('.product_img_slider_container').slick({
                        arrows: false,
                        dots: false,
                        infinite: false,
                        speed: 300,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    });

                    $('.product_img_slider_content').click(function() {
                        $('.product_img_slider_content').removeClass('active');
                        $(this).addClass('active');
                        $('.product_img').attr('src', $(this).attr('src'));
                    });
                </script>
            </div>
            
            <div class="product_summary_and_specification_block">
                <div class="product_title">千年人參</div>
                <div class="product_summary custom_scrollbar">
                    <p>強身健體</p>
                    <br>
                    <p>長命百歲</p>
                    <br>
                    <p>精力旺盛</p>
                    <br>

                    <p>精力旺盛</p>
                    <br>

                    <p>精力旺盛</p>
                    <br>

                    <p>精力旺盛</p>
                    <br>
                </div>
                <div class="product_specification_title">商品規格</div>
                <div class="product_specification_container">
                    <div class="product_specification_btn">十年</div>
                    <div class="product_specification_btn">五十年</div>
                    <div class="product_specification_btn">一百年</div>
                    <div class="product_specification_btn">五百年</div>
                    <div class="product_specification_btn">一千年</div>
                </div>
                <script>
                    $('.product_specification_btn').click(function() {
                        if ($(this).hasClass('active')) {
                            $('.product_specification_btn').removeClass('active');
                        } else {
                            $('.product_specification_btn').removeClass('active');
                            $(this).addClass('active');
                        }
                    });
                </script>

                <div class="product_amount_title">購買數量</div>
                <div class="product_amount_and_price_container">
                    <div class="product_amount_control">
                        <button class="product_amount_btn minus"><i class="fas fa-minus"></i></button>
                        <input type="number" name="amount" value="1" class="product_amount_input">
                        <button class="product_amount_btn plus"><i class="fas fa-plus"></i></button>
                    </div>

                    <script>
                        $('.product_amount_btn.minus').click(function() {
                            var current_amount = $('input[name=amount]').val();
                            if (current_amount > 1) {
                                current_amount--;
                                $('input[name=amount]').val(current_amount);
                            } else {
                                alert('購買數量不可小於 1');
                            }
                        });

                        $('.product_amount_btn.plus').click(function() {
                            var current_amount = $('input[name=amount]').val();
                            if (current_amount == 1000) {
                                alert('購買數量不可大於 1000');
                            } else {
                                current_amount++;
                                $('input[name=amount]').val(current_amount);
                            }
                        });

                        $('input[name=amount').change(function() {
                            var current_amount = $('input[name=amount]').val();
                            if (current_amount < 1) {
                                alert('購買數量不可小於 1');
                                $('input[name=amount]').val(1);
                            } else if (current_amount > 1000) {
                                alert('購買數量不可大於 1000');
                                $('input[name=amount]').val(1000);
                            }
                        });
                    </script>
                    
                    <div class="product_price">$1,100</div>
                </div>

                <div class="product_btn_group">
                    <button class="product_btn">
                        <i class="fas fa-shopping-cart"></i>
                        加入購物車
                    </button>
                    <button class="product_btn">
                        <i class="fas fa-money-bill-wave-alt"></i>
                        立即結帳
                    </button>
                </div>
            </div>
        </div>

        <div class="product_body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, ex officiis itaque nostrum voluptates molestiae maxime consequatur laboriosam, doloribus minus, expedita repellat! Esse cupiditate suscipit illo possimus totam consectetur quo voluptas repellendus ea illum. Dicta mollitia quis, minus cupiditate illum adipisci explicabo doloribus dolorum. Facilis eos illo ea laboriosam quaerat!
        </div>
    </div>
</section>

@include('front.foot')
