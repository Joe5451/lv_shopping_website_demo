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
        <a href="product_list.php" class="page_breadcrumb_link active">購物商城</a>
    </nav>

    <div class="product_container">
        <div class="product_sidebar">
            <button class="product_sidebar_toggle_btn_mobile">
                <i class="fas fa-caret-down"></i>
                商品分類
            </button>
            <div class="product_category_container">
                @foreach ($product_categories as $product_category)
                    <?php
                        if ($current_categoryId == $product_category->product_category_id) {
                            $category_icon = 'fa-minus';
                            $subcategory_display = 'style="display:block"';
                        } else {
                            $category_icon = 'fa-plus';
                            $subcategory_display = '';
                        }
                    ?>
                
                    <div class="product_category">
                        <div class="product_category_title">
                            {{ $product_category->category_name }}
                            <i class="fas {{ $category_icon }}"></i>
                        </div>
                        <div class="product_category_content" {!! $subcategory_display !!}>
                            @foreach ($product_category->product_subcategories as $product_subcategory)
                                @if ($product_subcategory->display == '1')
                                    <?php
                                        $active = '';
                                        if ($current_categoryId == $product_category->product_category_id && 
                                            $current_subcategoryId == $product_subcategory->product_subcategory_id) {
                                                $active = 'active';
                                        }
                                    ?>
                                
                                    <a href="{{ route('product.list', [$product_category->product_category_id, $product_subcategory->product_subcategory_id]) }}" class="product_category_link {{ $active }}">
                                        {{ $product_subcategory->subcategory_name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <script>
                $('.product_category_title').click(function() {
                    $(this).find('i').toggleClass('fa-plus fa-minus');
                    $(this).next('.product_category_content').stop().slideToggle();
                });

                $('.product_sidebar_toggle_btn_mobile').click(function() {
                    $(this).find('i').toggleClass('fa-rotate-180');
                    $('.product_category_container').stop().slideToggle(function() {
                        $(this).css('height', 'auto');
                    });
                });
            </script>
        </div>

        <div class="product_list_container">
            @foreach ($products as $product)
                <a href="{{ route('product.content', $product->id) }}" class="product_list">
                    <div class="product_list_img_wrap">
                        <img src="{{ env('IMG_URL') . $product->img_src }}" alt="{{ $product->product_name }}" class="product_list_img">
                        <div class="product_list_img_mask">
                            <span>MORE</span>
                        </div>
                    </div>
                    <div class="product_list_foot">
                        <div class="product_list_price">${{ number_format($product->price) }}</div>
                        <div class="product_list_title">{{ $product->product_name }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</section>

@include('front.foot')
