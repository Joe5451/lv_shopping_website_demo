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

    <form action="{{ route('cart.add') }}" method="post" id="product_form">
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

                        <input type="hidden" name="option_id" value="">
                        
                        <script>
                            $('.product_specification_btn').click(function() {
                                if ($(this).hasClass('active')) {
                                    $('.product_specification_btn').removeClass('active');
                                    $('input[name=option_id]').val('');
                                } else {
                                    $('.product_specification_btn').removeClass('active');
                                    $(this).addClass('active');

                                    $('input[name=option_id]').val($(this).attr('option-id'));
                                }
                            });
                        </script>
                    @endif

                    <div class="product_amount_title">購買數量</div>
                    <div class="product_amount_and_price_container">
                        <div class="product_amount_control">
                            <div class="product_amount_btn minus"><i class="fas fa-minus"></i></div>
                            <input type="number" name="amount" value="1" class="product_amount_input">
                            <div class="product_amount_btn plus"><i class="fas fa-plus"></i></div>
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

                            $('input[name=amount]').change(function() {
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
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="product_btn" onclick="addCart()">
                            <i class="fas fa-shopping-cart"></i>
                            加入購物車
                        </div>
                        <div class="product_btn" onclick="checkOut()">
                            <i class="fas fa-money-bill-wave-alt"></i>
                            立即結帳
                        </div>

                        <script>
                            function addCart() {
                                if (!checkOptionSelected()) return;

                                @if ($is_login)
                                    $('#product_form').submit();
                                @else
                                    Swal.fire({
                                        icon: 'info',
                                        title: "請先登入會員,\n才能加入購物車,謝謝!",
                                        timer: 3000,
                                        confirmButtonText: '確定',
                                        willClose: () => {
                                            window.location.href = "{{ route('member.login_form') }}";
                                        },
                                    })
                                @endif
                            }

                            function checkOut() {
                                if (!checkOptionSelected()) return;

                                @if ($is_login)
                                    Swal.fire({
                                        icon: 'info',
                                        title: "前往結帳!",
                                        timer: 3000,
                                        confirmButtonText: '確定',
                                        willClose: () => {},
                                    })
                                @else
                                    Swal.fire({
                                        icon: 'info',
                                        title: "請先登入會員,\n才能加入購物車,謝謝!",
                                        timer: 3000,
                                        confirmButtonText: '確定',
                                        willClose: () => {
                                            window.location.href = "{{ route('member.login_form') }}";
                                        },
                                    })
                                @endif
                            }

                            function checkOptionSelected() {
                                if ($('input[name=option_id]').length > 0 && $('input[name=option_id]').val() == '') {
                                    alertInfo('請選擇規格!');
                                    return false;
                                } else {
                                    return true;
                                }
                            }

                            function alertInfo(title) {
                                Swal.fire({
                                    icon: 'info',
                                    title,
                                    timer: 3000,
                                    confirmButtonText: '確定',
                                })
                            }
                        </script>
                    </div>
                </div>
            </div>

            <div class="product_body">{{ $product->content }}</div>
        </div>
    </form>
</section>

@include('front.foot')
