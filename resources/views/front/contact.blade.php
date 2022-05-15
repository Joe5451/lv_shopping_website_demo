@include('front.head')

<div class="page_head_banner">
    <?php
        $img_src = ($head_img->img_src != '') ? env('IMG_URL') . $head_img->img_src : 'img/bg_demo.png';
    ?>
    
    <img src="{{ $img_src }}" alt="聯絡我們" class="page_head_banner_img">
    
    <div class="page_head_banner_content">
        <h1 class="page_head_banner_title">聯絡我們</h1>
        <h2 class="page_head_banner_subtitle">Contact Us</h2>
    </div>
</div>

<section class="page_section container mx-auto">
    <nav class="page_breadcrumb">
        <a href="welcome.php" class="page_breadcrumb_link">首頁</a>
        <span class="page_breadcrumb_separator">〉</span>
        <a href="contact.php" class="page_breadcrumb_link active">聯絡我們</a>
    </nav>

    <form action="{{ route('contact_add') }}" method="post" class="form" id="contact_form">
        <h2 class="form_title">聯絡我們</h2>

        <div class="form_group">
            <label class="form_label">姓名</label>
            <div class="form_control_wrap">
                <input type="text" class="form_control" name="name" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>
        <div class="form_group">
            <label class="form_label">Email</label>
            <div class="form_control_wrap">
                <input type="email" class="form_control" name="email" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>
        <div class="form_group">
            <label class="form_label">聯絡電話</label>
            <div class="form_control_wrap">
                <input type="text" class="form_control" name="phone" required>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>
        <div class="form_group">
            <label class="form_label self-start">內容</label>
            <div class="form_control_wrap">
                <textarea name="content" class="form_textarea custom_scrollbar" required></textarea>
                <span class="form_control_border_top_left"></span>
                <span class="form_control_border_bottom_right"></span>
            </div>
        </div>

        @csrf
        
        <div class="form_submit_wrap">
            <input type="button" onclick="checkForm()" value="送出" id="form_submit">
        </div>
    </form>

    <script>
        function checkForm() {
            if ($('input[name=name]').val() == '')
                alertAndScrollTop($('input[name=name]'), '請輸入姓名!');
            else if ($('input[name=email]').val() == '')
                alertAndScrollTop($('input[name=email]'), '請輸入 Email!');
            else if ($('input[name=phone]').val() == '')
                alertAndScrollTop($('input[name=phone]'), '請輸入聯絡電話!');
            else if ($('textarea[name=content]').val() == '')
                alertAndScrollTop($('textarea[name=content]'), '請輸入內容!');
            else
                $('#contact_form').submit();
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
    
</section>

@include('front.foot')
