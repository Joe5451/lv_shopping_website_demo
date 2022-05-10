<?php include('php/head.php'); ?>

<div class="page_head_banner">
    <img src="img/img2.png" alt="會員登入" class="page_head_banner_img">
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">會員登入</h1>
        <h2 class="page_head_banner_subtitle">Login</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="member_login.php" class="page_breadcrumb_link active">會員登入</a>
    </nav>

    <form action="" method="post" class="form form_sm">
        <h2 class="form_title">會員登入</h2>

        <div class="form_group">
            <label class="form_label form_label_sm">帳號</label>
            <div class="form_control_wrap">
                <input type="text" class="form_control" name="email" >
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
            <a href="member_signup.php" class="member_signup_link">立即註冊</a>
        </div>

        <div class="flex justify-center align-center my-8">
            <label class="form_check_label">
                <input type="checkbox" name="remember" class="form_check" value="true" >
                <div class="form_check_content">記住我的帳號密碼</div>
            </label>
        </div>
        
        <div class="form_submit_wrap">
            <input type="button" value="登入" onclick="window.location.href = 'member_update_form.php';" id="form_submit">
        </div>
    </form>

</section>

<?php include('php/foot.php'); ?>
