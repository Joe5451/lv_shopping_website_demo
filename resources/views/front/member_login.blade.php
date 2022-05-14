@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>

    <img src="{{ $img_src }}" alt="會員登入" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">會員登入</h1>
        <h2 class="page_head_banner_subtitle">Login</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="{{ route('home') }}" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="{{ route('member.login_form') }}" class="page_breadcrumb_link active">會員登入</a>
    </nav>

    <form action="{{ route('member.login') }}" method="post" class="form form_sm" id="login_form">
        <h2 class="form_title">會員登入</h2>

        <div class="form_group">
            <label class="form_label form_label_sm">帳號</label>
            <div class="form_control_wrap">
                <input type="email" class="form_control" name="email" >
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>
        <div class="form_group">
            <label class="form_label form_label_sm">密碼</label>
            <div class="form_control_wrap">
                <input type="password" class="form_control" name="password" >
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>

        <div class="member_signup_notify">
            還不是會員嗎?
            <a href="{{ route('member.signup_form') }}" class="member_signup_link">立即註冊</a>
        </div>

        <div class="flex justify-center align-center my-8">
            <label class="form_check_label">
                <input type="checkbox" name="remember" class="form_check" value="true" >
                <div class="form_check_content">記住我的帳號密碼</div>
            </label>
        </div>
        
        <div class="form_submit_wrap">
            @csrf
            <input type="button" value="登入" onclick="checkForm();" id="form_submit">
        </div>
    </form>

    <script>
        function checkForm() {
            if ($('input[name=email]').val() == '')
                alertAndScrollTop($('input[name=email]'), '請輸入 Email!');
            else if ($('input[name=password]').val() == '')
                alertAndScrollTop($('input[name=password]'), '請輸入密碼!');
            else
                $('#login_form').submit();
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
