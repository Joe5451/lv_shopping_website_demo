@include('admin.head')

<nav class="admin_nav">
    <a href="news_list.php" class="admin_nav_link active">最新消息列表</a>
    <a href="news_category_list.php" class="admin_nav_link">最新消息類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="news_list.php" class="admin_sub_nav_link active">列表</a>
        <a href="news_add_form.php" class="admin_sub_nav_link">新增</a>
    </nav>

    <form action="" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">標題</label>
            <input type="text" name="title" class="form_control" value="最新商品快報">
        </div>

        <div class="form_group">
            <label class="form_label">分類</label>
            <select name="category" class="form_select">
                <option value="">無</option>
                <option value="好康優惠" selected>好康優惠</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">顯示/隱藏</label>
            <select name="display" class="form_select">
                <option value="true" selected>顯示</option>
                <option value="false">隱藏</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">日期</label>
            <input type="text" name="date" class="form_control" value="2022/01/05">
        </div>

        <div class="form_group">
            <label class="form_label">摘要</label>
            <textarea name="summary" class="form_textarea custom_scrollbar">最新消息摘要...</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">內容</label>
            <textarea name="content" class="form_textarea custom_scrollbar">最新消息內容...</textarea>
        </div>

        <div class="flex">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
