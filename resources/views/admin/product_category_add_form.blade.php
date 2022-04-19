@include('admin.head')

<nav class="admin_nav">
    <a href="product_list.php" class="admin_nav_link">商品列表</a>
    <a href="product_category_list.php" class="admin_nav_link active">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">

    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="product_category_list.php" class="admin_sub_nav_link">列表</a>
        <a href="product_category_add_form.php" class="admin_sub_nav_link active">新增</a>
    </nav>
    
    <form action="" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">分類名稱</label>
            <input type="text" name="category_name" class="form_control">
        </div>

        <div class="form_group">
            <label class="form_label">顯示/隱藏</label>
            <select name="display" class="form_select">
                <option value="true">顯示</option>
                <option value="false">隱藏</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">順序</label>
            <input type="number" name="sequence" class="form_control" value="0">
        </div>

        @csrf

        <div class="flex">
            <button class="form_btn_primary ml-auto">新增</button>
        </div>
    </form>
</div>

@include('admin.foot')
