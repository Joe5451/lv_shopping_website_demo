<?php include('php/head.php'); ?>

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
        <a href="product_list.php" class="page_breadcrumb_link active">購物商城</a>
    </nav>

    <div class="product_container">
        <div class="product_sidebar">
            <button class="product_sidebar_toggle_btn_mobile">
                <i class="fas fa-caret-down"></i>
                商品分類
            </button>
            <div class="product_category_container">
                <div class="product_category">
                    <a href="#" class="product_category_title">
                        天材地寶
                        <i class="fas fa-plus"></i>
                    </a>
                    <div class="product_category_content">
                        <a href="#" class="product_category_link">補氣養生</a>
                        <a href="#" class="product_category_link">強健體魄</a>
                        <a href="#" class="product_category_link">美容養顏</a>
                    </div>
                </div>
                <div class="product_category">
                    <a href="#" class="product_category_title">
                        天材地寶
                        <i class="fas fa-plus"></i>
                    </a>
                    <div class="product_category_content">
                        <a href="#" class="product_category_link">補氣養生</a>
                        <a href="#" class="product_category_link">強健體魄</a>
                        <a href="#" class="product_category_link">美容養顏</a>
                    </div>
                </div>
                <div class="product_category">
                    <a href="#" class="product_category_title">
                        天材地寶
                        <i class="fas fa-plus"></i>
                    </a>
                    <div class="product_category_content">
                        <a href="#" class="product_category_link">補氣養生</a>
                        <a href="#" class="product_category_link">強健體魄</a>
                        <a href="#" class="product_category_link">美容養顏</a>
                    </div>
                </div>
            </div>

            <script>
                $('.product_category_title i').click(function(e) {
                    e.preventDefault();
                    $(this).toggleClass('fa-plus fa-minus');
                    $(this).parent('.product_category_title').next('.product_category_content').stop().slideToggle();
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
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
            <a href="product.php" class="product_list">
                <div class="product_list_img_wrap">
                    <img src="img/img2.png" alt="產品" class="product_list_img">
                    <div class="product_list_img_mask">
                        <span>MORE</span>
                    </div>
                </div>
                <div class="product_list_foot">
                    <div class="product_list_price">$300</div>
                    <div class="product_list_title">千年人參</div>
                </div>
            </a>
        </div>
    </div>

</section>

<?php include('php/foot.php'); ?>
