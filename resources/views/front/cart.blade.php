@include('front.head')

<div class="page_head_banner">
    <img src="img/img2.png" alt="購物車" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">購物車</h1>
        <h2 class="page_head_banner_subtitle">Cart</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="cart.php" class="page_breadcrumb_link active">購物車</a>
    </nav>

    <div class="cart_block">
        <div class="cart_container">
            <div class="cart_head">
                <div class="cart_head_item cart_head_name">品項</div>
                <div class="cart_head_item cart_head_specification">規格</div>
                <div class="cart_head_item cart_head_amount">數量</div>
                <div class="cart_head_item cart_head_subtotal border-r-0">小記</div>
                <div class="cart_head_item cart_head_btn border-r-0"></div>
            </div>

            <div class="cart_section_head cart_head_mobile">購物車</div>
            
            <div class="cart_body">
                <div class="cart_list">
                    <div class="cart_list_item cart_list_product_img_wrap">
                        <img src="img/img2.png" alt="千人人參" class="cart_list_product_img">
                    </div>
                    <div class="cart_list_product_name">千年人參</div>
                    <div class="cart_list_item cart_list_specification">
                        <div class="cart_list_specification_title">規格：</div>
                        <div class="cart_list_specification_content">一千年</div>
                    </div>
                    <div class="cart_list_item cart_list_amount">
                        <div class="cart_list_amount_control">
                            <button class="cart_list_amount_btn minus"><i class="fas fa-minus"></i></button>
                            <input type="number" name="amount" value="1" class="cart_list_amount_input">
                            <button class="cart_list_amount_btn plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="cart_list_item cart_list_subtotal">
                        $1,100
                    </div>
                    <button class="cart_list_delete_btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="cart_list">
                    <div class="cart_list_item cart_list_product_img_wrap">
                        <img src="img/img2.png" alt="千人人參" class="cart_list_product_img">
                    </div>
                    <div class="cart_list_product_name">千年人參</div>
                    <div class="cart_list_item cart_list_specification">
                        <div class="cart_list_specification_title">規格：</div>
                        <div class="cart_list_specification_content">一千年</div>
                    </div>
                    <div class="cart_list_item cart_list_amount">
                        <div class="cart_list_amount_control">
                            <button class="cart_list_amount_btn minus"><i class="fas fa-minus"></i></button>
                            <input type="number" name="amount" value="1" class="cart_list_amount_input">
                            <button class="cart_list_amount_btn plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="cart_list_item cart_list_subtotal">
                        $1,100
                    </div>
                    <button class="cart_list_delete_btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="cart_list">
                    <div class="cart_list_item cart_list_product_img_wrap">
                        <img src="img/img2.png" alt="千人人參" class="cart_list_product_img">
                    </div>
                    <div class="cart_list_product_name">千年人參</div>
                    <div class="cart_list_item cart_list_specification">
                        <div class="cart_list_specification_title">規格：</div>
                        <div class="cart_list_specification_content">一千年</div>
                    </div>
                    <div class="cart_list_item cart_list_amount">
                        <div class="cart_list_amount_control">
                            <button class="cart_list_amount_btn minus"><i class="fas fa-minus"></i></button>
                            <input type="number" name="amount" value="1" class="cart_list_amount_input">
                            <button class="cart_list_amount_btn plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="cart_list_item cart_list_subtotal">
                        $1,100
                    </div>
                    <button class="cart_list_delete_btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="cart_bottom">
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">商品金額小記</div>
                    <div class="cart_bottom_item_content">$1,500</div>
                </div>
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">運費</div>
                    <div class="cart_bottom_item_content">$150</div>
                </div>
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">總金額</div>
                    <div class="cart_bottom_item_content">$1,650</div>
                </div>
            </div>

            <div class="cart_section_head">訂單資料</div>
            <div class="cart_order_form_block">
                <div class="cart_order_form_inner_container">
                    <div class="cart_order_form_title">訂購人</div>

                    <div class="form_group">
                        <label class="form_label">姓名</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="name" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group">
                        <label class="form_label">聯絡電話</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="phone" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group">
                        <label class="form_label">聯絡地址</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="address" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group mb-14">
                        <label class="form_label">Email</label>
                        <div class="form_control_wrap">
                            <input type="email" class="form_control" name="email" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
                </div>


                <div class="cart_order_form_inner_container">
                    <div class="cart_order_form_title">收件人</div>
                    
                    <div class="form_group">
                        <label class="form_check_label">
                            <input type="checkbox" class="form_check" value="true" >
                            <div class="form_check_content">同訂購人資料</div>
                        </label>
                    </div>
                    
                    <div class="form_group">
                        <label class="form_label">姓名</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="receiver_name" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group">
                        <label class="form_label">聯絡電話</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="receiver_phone" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group">
                        <label class="form_label">聯絡地址</label>
                        <div class="form_control_wrap">
                            <input type="text" class="form_control" name="receiver_address" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
    
                    <div class="form_group">
                        <label class="form_label">Email</label>
                        <div class="form_control_wrap">
                            <input type="email" class="form_control" name="receiver_email" >
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>

                    <div class="form_group">
                        <label class="form_label self-start">備註</label>
                        <div class="form_control_wrap">
                            <textarea name="order_remark" class="form_textarea custom_scrollbar"></textarea>
                            <span class="form_control_border_top_left"></span>
                            <span class="form_control_border_bottom_right"></span>
                        </div>
                    </div>
                </div>
                
                <div class="form_submit_wrap">
                    <input type="submit" value="結帳" id="checkout_btn">
                </div>
                
            </div>
            
        </div>
    </div>

</section>

@include('front.foot')
