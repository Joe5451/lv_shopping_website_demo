@include('front.head')

<div class="page_head_banner">
    <img src="{{ ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png' }}" alt="購物商城" class="page_head_banner_img">
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
                <?php $subtotal = 0; ?>
                
                @foreach ($cart_products as $product)
                    <?php $subtotal += $product->amount*$product->price; ?>
                    <div class="cart_list">
                        <div class="cart_list_item cart_list_product_img_wrap">
                            <img src="{{ env('IMG_URL') . $product->img_src }}" alt="{{ $product->product_name }}" class="cart_list_product_img">
                        </div>
                        <div class="cart_list_product_name">{{ $product->product_name }}</div>
                        <div class="cart_list_item cart_list_specification">
                            <div class="cart_list_specification_title">規格：</div>
                            <div class="cart_list_specification_content">
                                @if ($product->option_id != '')
                                    {{ $product->option_name }}
                                @else
                                    <span class="text-gray-400">無</span>
                                @endif
                            </div>
                        </div>
                        <div class="cart_list_item cart_list_amount">
                            <div class="cart_list_amount_control">
                                <div class="cart_list_amount_btn minus cursor-pointer"><i class="fas fa-minus"></i></div>
                                <input type="number" name="amounts[]"
                                value="{{ $product->amount }}" 
                                price="{{ $product->price }}"
                                cart-id="{{ $product->id }}"
                                origin-amount="{{ $product->amount }}"
                                class="cart_list_amount_input">
                                <div class="cart_list_amount_btn plus cursor-pointer"><i class="fas fa-plus"></i></div>
                            </div>
                        </div>
                        <div class="cart_list_item cart_list_subtotal">
                            $<span class="product_subtotal">{{ number_format($product->price*$product->amount) }}</span>
                        </div>
                        <a href="{{ route('cart.delete', $product->id) }}" class="cart_list_delete_btn cursor-pointer">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                @endforeach
            </div>

            <script>
                $('.cart_list_amount_btn.minus').click(function() {
                    var amount_element = $(this).parents('.cart_list_amount').find('input[name="amounts[]"]');
                    var subtotal_element = $(this).parents('.cart_list').find('.product_subtotal');
                    var current_amount = amount_element.val();
                    var id = amount_element.attr('cart-id');
                    var price = parseInt(amount_element.attr('price'));
                    
                    if (current_amount > 1) {
                        current_amount--;
                        amount_element.val(current_amount);
                        subtotal_element.text(number_format(current_amount*price));
                        amount_element.attr('origin-amount', current_amount);

                        updateCartAmount(id, current_amount);
                    } else {
                        alertInfo('購買數量不可小於 1');
                    }
                });

                $('.cart_list_amount_btn.plus').click(function() {
                    var amount_element = $(this).parents('.cart_list_amount').find('input[name="amounts[]"]');
                    var subtotal_element = $(this).parents('.cart_list').find('.product_subtotal');
                    var current_amount = amount_element.val();
                    var id = amount_element.attr('cart-id');
                    var price = parseInt(amount_element.attr('price'));

                    if (current_amount == 1000) {
                        alertInfo('購買數量不可大於 1000');
                    } else {
                        current_amount++;
                        amount_element.val(current_amount);
                        subtotal_element.text(number_format(current_amount*price));
                        amount_element.attr('origin-amount', current_amount);

                        updateCartAmount(id, current_amount);
                    }
                });

                $('input[name="amounts[]"]').change(function() {
                    var amount_element = $(this).parents('.cart_list_amount').find('input[name="amounts[]"]');
                    var subtotal_element = $(this).parents('.cart_list').find('.product_subtotal');
                    var current_amount = $(this).val();
                    var id = amount_element.attr('cart-id');
                    var price = parseInt(amount_element.attr('price'));
                    var origin_amount = amount_element.attr('origin-amount');

                    if (current_amount < 1) {
                        $(this).val(origin_amount);
                        alertInfo('購買數量不可小於 1');
                    } else if (current_amount > 1000) {
                        $(this).val(origin_amount);
                        alertInfo('購買數量不可大於 1000');
                    } else {
                        subtotal_element.text(number_format(current_amount*price));
                        amount_element.attr('origin-amount', current_amount);

                        updateCartAmount(id, current_amount);
                    }
                });

                function calculateTotal() {
                    var subtotal = 0; // 商品小計
                    var total = 0; // 總計
                    var delivery_fee = <?php echo $delivery_fee; ?>; // 運費
                    
                    $('input[name="amounts[]"]').each(function() {
                        subtotal += $(this).val() * parseInt($(this).attr('price'));
                    });

                    total = subtotal + delivery_fee;

                    $('#subtotal').text(number_format(subtotal));
                    $('#total').text(number_format(total));
                }

                function updateCartAmount(id, amount) {
                    showLoading('更新中...');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('cart.update_amount') }}',
                        dataType: 'json',
                        data: {
                            id,
                            amount,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (res) {
                            setTimeout(function() {
                                if (res.status == 'success') {
                                    alertAndExecuteCallBack('success', '更新成功', calculateTotal);
                                } else if (res.status == 'fail') {
                                    alertAndExecuteCallBack('warning', res.message, function() {
                                        if (res.hasOwnProperty("location")) {
                                            window.location.href = res.location;
                                        }
                                    });
                                } else {
                                    alertAndExecuteCallBack('warning', '發生錯誤<br>重新整理頁面', function() {
                                        window.location.reload();
                                    });
                                }
                            }, 1000);
                        },
                        error: function(err)
                        {
                            // console.log(err);

                            if (err.status == 419) {
                                alertAndExecuteCallBack('warning', '更新失敗<br>請重新整理頁面再操作', function() {
                                    window.location.reload();
                                });
                            }
                        },
                    });
                }

                function number_format(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                }

                function alertInfo(title) {
                    Swal.fire({
                        icon: "info",
                        title,
                        timer: 0,
                    });
                }

                function showLoading(title) {
                    Swal.fire({
                        title,
                        width: 300,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        customClass: {
                            loader: 'custom_loader'
                        },
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                }

                function alertAndExecuteCallBack(icon, title, callback) {
                    Swal.fire({
                        icon,
                        title,
                        width: 300,
                        timer: 1000,
                        showConfirmButton: false,
                        willClose: () => {
                            callback();
                        },
                    });
                }
            </script>

            <div class="cart_bottom">
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">商品金額小記</div>
                    <div class="cart_bottom_item_content">
                        $<span id="subtotal">{{ number_format($subtotal) }}</span>
                    </div>
                </div>
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">運費</div>
                    <div class="cart_bottom_item_content">
                        $<span id="delivery_fee">{{ number_format($delivery_fee) }}</span>
                    </div>
                </div>
                <div class="cart_bottom_item">
                    <div class="cart_bottom_item_title">總金額</div>
                    <div class="cart_bottom_item_content">
                        $<span id="total">{{ number_format($subtotal + $delivery_fee) }}</span>
                    </div>
                </div>
            </div>

            <form action="" method="post" id="cart_form">
                <div class="cart_section_head">訂單資料</div>
                <div class="cart_order_form_block">
                    <div class="cart_order_form_inner_container">
                        <div class="cart_order_form_title">訂購人</div>

                        <div class="form_group">
                            <label class="form_label">姓名</label>
                            <div class="form_control_wrap">
                                <input type="text" class="form_control" name="name" value="{{ $member->name }}" required>
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
                                <input type="text" class="form_control" name="address" value="{{ $member->city . $member->town . $member->address }}" required>
                                <span class="form_control_border_top_left"></span>
                                <span class="form_control_border_bottom_right"></span>
                            </div>
                        </div>
        
                        <div class="form_group mb-14">
                            <label class="form_label">Email</label>
                            <div class="form_control_wrap">
                                <input type="email" class="form_control" name="email" value="{{ $member->email }}" required>
                                <span class="form_control_border_top_left"></span>
                                <span class="form_control_border_bottom_right"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cart_order_form_inner_container">
                        <div class="cart_order_form_title">收件人</div>
                        
                        <div class="form_group">
                            <label class="form_check_label">
                                <input type="checkbox" class="form_check" onchange="setSameData(this)" value="true" >
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
                        <input type="button" onclick="checkForm()" value="結帳" id="checkout_btn">
                    </div>
                </div>
            </form>

            <script>
                function setSameData(element) {
                    if ($(element).prop('checked')) {
                        $('input[name=receiver_name]').val($('input[name=name]').val());
                        $('input[name=receiver_phone]').val($('input[name=phone]').val());
                        $('input[name=receiver_address]').val($('input[name=address]').val());
                        $('input[name=receiver_email]').val($('input[name=email]').val());
                    } else {
                        $('input[name=receiver_name]').val('');
                        $('input[name=receiver_phone]').val('');
                        $('input[name=receiver_address]').val('');
                        $('input[name=receiver_email]').val('');
                    }
                }
                
                function checkForm() {
                    if ($('input[name=name]').val() == '')
                        alertAndScrollTop($('input[name=name]'), '請輸入訂購人姓名!');
                    else if ($('input[name=phone]').val() == '')
                        alertAndScrollTop($('input[name=phone]'), '請輸入訂購人聯絡電話!');
                    else if ($('input[name=address]').val() == '')
                        alertAndScrollTop($('input[name=address]'), '請輸入訂購人聯絡地址!');
                    else if ($('input[name=email]').val() == '')
                        alertAndScrollTop($('input[name=email]'), '請輸入訂購人 Email!');
                    else if ($('input[name=receiver_name]').val() == '')
                        alertAndScrollTop($('input[name=receiver_name]'), '請輸入收件人姓名!');
                    else if ($('input[name=receiver_phone]').val() == '')
                        alertAndScrollTop($('input[name=receiver_phone]'), '請輸入收件人聯絡電話!');
                    else if ($('input[name=receiver_address]').val() == '')
                        alertAndScrollTop($('input[name=receiver_address]'), '請輸入收件人聯絡地址!');
                    else if ($('input[name=receiver_email]').val() == '')
                        alertAndScrollTop($('input[name=receiver_email]'), '請輸入收件人 Email!');
                    else
                        alert('ok');
                        // $('#cart_form').submit();
                }

                function alertAndScrollTop(element, title) {
                    Swal.fire({
                        icon: "info",
                        title,
                        timer: 0,
                        willClose: () => {
                            var contentTop = element.offset().top - 120;
                            $([document.documentElement, document.body]).animate({
                                scrollTop: contentTop
                            }, 800, 'swing', function() {
                                element.focus();
                            });
                        },
                    });
                }
            </script>
        </div>
    </div>

</section>

@include('front.foot')
