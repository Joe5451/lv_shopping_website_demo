@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.contact_list') }}" class="admin_nav_link active">聯絡我們</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.contact_list') }}" disabled class="admin_sub_nav_link active">列表</a>
    </nav>

    <form action="" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">時間</label>
            <input type="text" class="form_control" value="2022/01/05 13:15:30" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">姓名</label>
            <input type="text" class="form_control" value="測試員" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">Email</label>
            <input type="text" class="form_control" value="tester01@email.com" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">聯絡電話</label>
            <input type="text" class="form_control" value="0912345678" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">內容</label>
            <textarea class="form_textarea custom_scrollbar" readonly>測試備註</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">管理員備註</label>
            <textarea name="remark" class="form_textarea custom_scrollbar">測試管理員備註</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">狀態</label>
            <select name="state" class="form_select">
                <option value="pending" selected>待處理</option>
                <option value="processing">處理中</option>
                <option value="solved">已處理</option>
            </select>
        </div>

        <div class="flex">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
