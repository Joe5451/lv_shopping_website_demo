@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>

    <img src="{{ $img_src }}" alt="會員中心" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">會員資料</h1>
        <h2 class="page_head_banner_subtitle">Member Data</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="{{ route('home') }}" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('member.update_form') }}" class="page_breadcrumb_link">會員中心</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('member.update_form') }}" class="page_breadcrumb_link active">會員資料</a>
    </nav>

    <div class="flex items-start flex-wrap">
        <div class="w-full md:w-1/4 mb-8">
            <button class="member_sidebar_toggle_btn_mobile">
                <i class="fas fa-caret-down"></i>
                會員中心
            </button>
            <div class="member_sidebar_content w-full md:w-72 max-w-full">
                <a href="{{ route('member.update_form') }}" class="member_sidebar_link active">會員資料</a>
                <a href="#" class="member_sidebar_link">訂單記錄</a>
                <a href="{{ route('member.logout') }}" class="member_sidebar_link">會員登出</a>
            </div>

            <script>
                $('.member_sidebar_toggle_btn_mobile').click(function() {
                    $(this).find('i').toggleClass('fa-rotate-180');
                    $('.member_sidebar_content').stop().slideToggle();
                });
            </script>
        </div>
        <div class="w-full md:w-3/4 px-0 md:px-4">
            <form action="{{ route('member.update') }}" method="post" class="form" id="update_form">
                <h2 class="form_title">會員資料</h2>
        
                <div class="form_group">
                    <label class="form_label">帳號</label>
                    <div class="form_control_wrap">
                        <input type="text" class="form_control" value="{{ $member->email }}" readonly >
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                </div>

                <div class="form_group">
                    <label class="form_label">電話</label>
                    <div class="form_control_wrap">
                        <input type="text" class="form_control" name="phone" value="{{ $member->phone }}" required>
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                </div>
        
                <div class="form_group">
                    <label class="form_label">姓名</label>
                    <div class="form_control_wrap">
                        <input type="text" class="form_control" name="name" value="{{ $member->name }}" required>
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                </div>
        
                <div class="form_group">
                    <label class="form_label">縣市</label>
                    <div class="form_control_wrap">
                        <select name="city" class="form_select" onchange="changeCity()" required>
                            <option value="">請選擇縣市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="台北市">台北市</option>
                            <option value="新北市">新北市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="新竹市">新竹市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="台中市">台中市</option>	
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="嘉義縣">嘉義縣</option>		
                            <option value="台南市">台南市</option>
                            <option value="高雄市">高雄市</option>	
                            <option value="屏東縣">屏東縣</option>
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="台東縣">台東縣</option>
                            <option value="連江縣">連江縣</option>
                            <option value="金門縣">金門縣</option>
                        </select>
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                </div>

                <script>
                    $('select[name=city]').val('{{ $member->city }}');

                    function changeCity() {
                        let city = $("select[name=city]").val();

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('get_town') }}',
                            data: {
                                city,
                                '_token': '{{ csrf_token() }}',
                            },
                            dataType: 'html',
                            success: function (res) {
                                $("select[name=town]").html(res);
                            },
                            error: function (err) {
                                if (err.status) {
                                    alertInfo('操作逾時，請重新整理頁面!');
                                }
                            }
                        });
                    }
                </script>
        
                <div class="form_group">
                    <label class="form_label">區域</label>
                    <div class="form_control_wrap">
                        <select name="town" class="form_select" required>
                            {!! $town_options !!}
                        </select>
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>

                    <script>
                        $('select[name=town]').val('{{ $member->town }}');
                    </script>
                </div>
        
                <div class="form_group">
                    <label class="form_label">地址</label>
                    <div class="form_control_wrap">
                        <input type="text" class="form_control" name="address" value="{{ $member->address }}">
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                </div>
        
                <div class="form_group">
                    <label class="form_label">更改密碼</label>
                    <div class="form_control_wrap">
                        <input type="password" class="form_control" name="password" >
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                    <div class="form_control_notify">不更改請留空，密碼須為8-25碼英文或數字</div>
                </div>
        
                <div class="form_group">
                    <label class="form_label">確認密碼</label>
                    <div class="form_control_wrap">
                        <input type="password" class="form_control" id="confirm_password">
                        <span class="form_control_border_top_left"></span>
                        <span class="form_control_border_bottom_right"></span>
                    </div>
                    <div class="form_control_notify">請再次輸入密碼</div>
                </div>

                <div class="form_submit_wrap">
                    @csrf
                    <input type="button" onclick="checkForm()" value="變更" id="form_submit">
                </div>
            </form>

            <script>
                function checkForm() {
                    if ($('input[name=phone]').val() == '')
                        alertAndScrollTop($('input[name=phone]'), '請輸入電話!');
                    else if ($('input[name=name]').val() == '')
                        alertAndScrollTop($('input[name=name]'), '請輸入姓名!');
                    else if ($('select[name=city]').val() == '')
                        alertAndScrollTop($('select[name=city]'), '請選擇縣市!');
                    else if ($('select[name=town]').val() == '')
                        alertAndScrollTop($('select[name=town]'), '請選擇鄉鎮市區!');
                    else if ($('input[name=address]').val() == '')
                        alertAndScrollTop($('input[name=address]'), '請輸入地址!');
                    else if ($('input[name=password]').val() != $('#confirm_password').val())
                        alertAndScrollTop($('#confirm_password'), '確認密碼不一致!');
                    else
                        $('#update_form').submit();
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

                function alertInfo(title) {
                    Swal.fire({
                        icon: "info",
                        title,
                        timer: 0,
                    });
                }
            </script>
        </div>
    </div>
</section>

@include('front.foot')
