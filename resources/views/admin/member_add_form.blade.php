@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.member_list') }}" class="admin_nav_link active">會員管理</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.member_list') }}" disabled class="admin_sub_nav_link">列表</a>
        <a href="{{ route('admin.member_add_form') }}" class="admin_sub_nav_link active">新增</a>
    </nav>

    <form action="{{ route('admin.member_add') }}" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">帳號</label>
            <input type="text" name="email" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">姓名</label>
            <input type="text" name="name" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">縣市</label>
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
            <select name="town" class="form_select" required>
                <option value="">請選擇鄉鎮市區</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">地址</label>
            <input type="text" name="address" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">密碼</label>
            <input type="password" name="password" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">狀態</label>
            <select name="state" class="form_select" required>
                <option value="1">正常</option>
                <option value="0">停權</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">管理員備註</label>
            <textarea name="remark" class="form_textarea custom_scrollbar"></textarea>
        </div>

        @csrf

        <div class="flex">
            <button class="form_btn_primary ml-auto">新增</button>
        </div>
    </form>
</div>

@include('admin.foot')
