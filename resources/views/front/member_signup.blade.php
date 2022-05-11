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
                <select name="city" class="form_select" required>
                    <option value="">請選擇縣市</option>
                    <option value="台中市">台中市</option>
                </select>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>

        <div class="form_group">
            <label class="form_label">區域</label>
            <div class="form_control_wrap">
                <select name="town" class="form_select" required>
                    <option value="">請選擇鄉鎮市區</option>
                    <option value="西屯區">西屯區</option>
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
                title: title,
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

</section>

@include('front.foot')
