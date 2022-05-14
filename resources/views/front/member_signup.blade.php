@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>

    <img src="{{ $img_src }}" alt="會員註冊" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">會員註冊</h1>
        <h2 class="page_head_banner_subtitle">Sign Up</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="member_signup.php" class="page_breadcrumb_link active">會員註冊</a>
    </nav>

    <form action="{{ route('member_signup') }}" method="post" class="form" id="signup_form">
        <h2 class="form_title">會員註冊</h2>

        <div class="form_group">
            <label class="form_label">帳號</label>
            <div class="form_control_wrap">
                <input type="email" class="form_control" name="email" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
            <div class="form_control_notify">請輸入您的 Email</div>
        </div>

        <div class="form_group">
            <label class="form_label">姓名</label>
            <div class="form_control_wrap">
                <input type="text" class="form_control" name="name" required>
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
                    <option value="">請選擇鄉鎮市區</option>
                </select>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>

        <div class="form_group">
            <label class="form_label">地址</label>
            <div class="form_control_wrap">
                <input type="text" class="form_control" name="address" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>

        <div class="form_group">
            <label class="form_label">密碼</label>
            <div class="form_control_wrap">
                <input type="password" class="form_control" name="password" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
            <div class="form_control_notify">密碼須為8-25碼英文或數字</div>
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

        @csrf

        <div class="form_submit_wrap">
            <button type="button" id="form_submit" onclick="checkForm();">註冊</button>
        </div>
    </form>

    <script>
        function checkForm() {
            if ($('input[name=email]').val() == '')
                alertAndScrollTop($('input[name=email]'), '請輸入 Email!');
            else if ($('input[name=name]').val() == '')
                alertAndScrollTop($('input[name=name]'), '請輸入姓名!');
            else if ($('select[name=city]').val() == '')
                alertAndScrollTop($('select[name=city]'), '請選擇縣市!');
            else if ($('select[name=town]').val() == '')
                alertAndScrollTop($('select[name=town]'), '請選擇鄉鎮市區!');
            else if ($('input[name=address]').val() == '')
                alertAndScrollTop($('input[name=address]'), '請輸入地址!');
            else if ($('input[name=password]').val() == '')
                alertAndScrollTop($('input[name=password]'), '請輸入密碼!');
            else if ($('#confirm_password').val() == '')
                alertAndScrollTop($('#confirm_password'), '請輸入確認密碼!');
            else if ($('input[name=password]').val() != $('#confirm_password').val())
                alertAndScrollTop($('#confirm_password'), '確認密碼不一致!');
            else
                $('#signup_form').submit();
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

</section>

@include('front.foot')
