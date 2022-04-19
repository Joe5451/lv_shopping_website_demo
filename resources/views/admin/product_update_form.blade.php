@include('admin.head')

<nav class="admin_nav">
    <a href="product_list.php" class="admin_nav_link active">商品列表</a>
    <a href="product_category_list.php" class="admin_nav_link">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="product_list.php" disabled class="admin_sub_nav_link active">列表</a>
        <a href="product_add_form.php" class="admin_sub_nav_link">新增</a>
    </nav>

    <form action="" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">商品名稱</label>
            <input type="text" name="product_name" class="form_control" value="千年人參">
        </div>

        <div class="form_group">
            <label class="form_label">分類</label>
            <select name="category" class="form_select">
                <option value="">無</option>
                <option value="天材地寶" selected>天材地寶</option>
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
            <label class="form_label">價格</label>
            <input type="number" name="price" class="form_control" value="1100">
        </div>

        <div class="form_group">
            <label class="form_label">順序</label>
            <input type="number" name="sequence" class="form_control" value="0">
        </div>

        <div class="form_group">
            <div class="flex items-start">
                <label class="form_label">商品規格</label>
                <button type="button" class="admin_plus_btn ml-2" id="product_specification_add_btn">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>

            <div id="product_specification_container">
                <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                    <div class="my-2 flex items-center">
                        <label class="shrink-0 text-slate-500">名稱：</label>
                        <input type="text" value="十年" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                    </div>
                    <div class="my-2 flex items-center">
                        <label class="shrink-0 text-slate-500">順序：</label>
                        <input type="number" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                        <button type="button" class="admin_minus_btn" onclick="deleteSpecification(this);">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>
                </div>
                <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                    <div class="my-2 flex items-center">
                        <label class="shrink-0 text-slate-500">名稱：</label>
                        <input type="text" value="五十年" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                    </div>
                    <div class="my-2 flex items-center">
                        <label class="shrink-0 text-slate-500">順序：</label>
                        <input type="number" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                        <button type="button" class="admin_minus_btn" onclick="deleteSpecification(this);">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                $('#product_specification_add_btn').click(function() {
                    $('#product_specification_container').append(`
                        <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">名稱：</label>
                                <input type="text" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                            </div>
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">順序：</label>
                                <input type="number" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4">
                                <button type="button" class="admin_minus_btn" onclick="deleteSpecification(this);">
                                    <i class="fas fa-minus-circle"></i>
                                </button>
                            </div>
                        </div>
                    `);
                });

                function deleteSpecification(current_element) {
                    var element = $(current_element);
                    element.parents('.specification_wrap').remove();
                }
            </script>
        </div>

        <div class="form_group">
            <label class="form_label">商品摘要</label>
            <textarea name="summary" class="form_textarea custom_scrollbar">強身健體，長命百歲，精力旺盛</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">商品內容</label>
            <textarea name="content" class="form_textarea custom_scrollbar">商品內容</textarea>
        </div>
        
        @csrf

        <div class="flex">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
