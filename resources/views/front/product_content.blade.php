@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>

    <img src="{{ $img_src }}" alt="購物商城" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">購物商城</h1>
        <h2 class="page_head_banner_subtitle">Shopping</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="{{ route('home') }}" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('product.list') }}" class="page_breadcrumb_link">購物商城</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('product.list', [$product->product_category_id, $product->product_subcategory_id]) }}" class="page_breadcrumb_link">{{ $product->product_category->category_name }}</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('product.content', $product->id) }}" class="page_breadcrumb_link active">{{ $product->product_name }}</a>
    </nav>

    <div class="product_content_container">
        <div class="product_top_block">
            <div class="product_img_block">
                <div class="product_img_wrap">
                    <img src="{{ env('IMG_URL') . $product->img_src }}" alt="{{ $product->product_name }}" class="product_img">
                </div>

                <div class="product_img_slider_container">
                    <div class="product_img_slider active">
                        <img src="{{ env('IMG_URL') . $product->img_src }}" class="product_img_slider_content">
                    </div>

                    @foreach ($product->product_imgs as $img)
                        <div class="product_img_slider">
                            <img src="{{ env('IMG_URL') . $img->src }}" class="product_img_slider_content">
                        </div>
                    @endforeach
                </div>

                <script>
                    $('.product_img_slider_container').slick({
                        arrows: false,
                        dots: false,
                        infinite: false,
                        centerMode: false,
                        speed: 300,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    });

                    $('.product_img_slider').click(function() {
                        $('.product_img_slider').removeClass('active');
                        $(this).addClass('active');
                        $('.product_img').attr('src', $(this).children().attr('src'));
                    });
                </script>
            </div>
            
            <div class="product_summary_and_specification_block">
                <div class="product_title">{{ $product->product_name }}</div>
                <div class="product_summary custom_scrollbar">
                    {{ $product->summary }}
                </div>
                
                @if (count($product->product_options) > 0)
                    <div class="product_specification_title">商品規格</div>
                    <div class="product_specification_container">
                        @foreach ($product->product_options as $option)
                            <div class="product_specification_btn" option-id="{{ $option->option_id }}">{{ $option->option_name }}</div>
                        @endforeach
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
                @endif

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
                                alertInfo('購買數量不可小於 1');
                            }
                        });

                        $('.product_amount_btn.plus').click(function() {
                            var current_amount = $('input[name=amount]').val();
                            if (current_amount == 1000) {
                                alertInfo('購買數量不可大於 1000');
                            } else {
                                current_amount++;
                                $('input[name=amount]').val(current_amount);
                            }
                        });

                        $('input[name=amount').change(function() {
                            var current_amount = $('input[name=amount]').val();
                            if (current_amount < 1) {
                                $('input[name=amount]').val(1);
                                alertInfo('購買數量不可小於 1');
                            } else if (current_amount > 1000) {
                                $('input[name=amount]').val(1000);
                                alertInfo('購買數量不可大於 1000');

                            }
                        });

                        function alertInfo(title) {
                            Swal.fire({
                                icon: "info",
                                title,
                                timer: 0,
                            });
                        }
                    </script>
                    
                    <div class="product_price">${{ number_format($product->price) }}</div>
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

        <div class="product_body">{{ $product->content }}</div>
    </div>
</section>

@include('front.foot')
