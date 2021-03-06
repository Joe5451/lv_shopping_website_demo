@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.product_list') }}" class="admin_nav_link active">商品列表</a>
    <a href="{{ route('admin.product_category_list') }}" class="admin_nav_link">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.product_list') }}" disabled class="admin_sub_nav_link">列表</a>
        <a href="{{ route('admin.product_add_form') }}" class="admin_sub_nav_link active">新增</a>
    </nav>

    <form action="{{ route('admin.product_add') }}" method="post" enctype="multipart/form-data" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">封面圖</label>
            <input type="file" name="img_src" class="dropify" data-max-file-size="5M" />
            
            <script>
                $('.dropify').dropify({
                    messages: {
                        'default': '將文件拖放到此處或單擊',
                        'replace': '拖放或點擊替換',
                        'remove':  '刪除',
                        'error':   '糟糕，發生了錯誤'
                    }
                });
            </script>
        </div>
        
        <div class="form_group">
            <label class="form_label">商品名稱</label>
            <input type="text" name="product_name" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">分類</label>
            <select name="product_category_id" class="form_select" onchange="changeSubcategories()">
                <option value="none">無</option>
                @foreach ($product_categories as $product_category)
                    <option value="{{ $product_category->product_category_id }}">{{ $product_category->category_name }}</option>
                @endforeach
            </select>

            <script>
                function changeSubcategories() {
                    let categoryId = $("select[name=product_category_id]").val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.get_product_subcategories') }}',
                        data: {
                            categoryId,
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: 'html',
                        success: function (res) {
                            $("select[name=product_subcategory_id]").html(res);
                        },
                        error: function (err) {
                            if (err.status == 419) {
                                alertInfo('操作逾時，請重新整理頁面!');
                            }
                        }
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
        </div>

        <div class="form_group">
            <label class="form_label">子分類</label>
            <select name="product_subcategory_id" class="form_select">
                <option value="none">無</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">顯示/隱藏</label>
            <select name="display" class="form_select">
                <option value="1">顯示</option>
                <option value="0">隱藏</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">價格</label>
            <input type="number" name="price" class="form_control" value="0" required>
        </div>

        <div class="form_group">
            <label class="form_label">順序</label>
            <input type="number" name="sequence" class="form_control" value="0" required>
        </div>

        <div class="form_group">
            <div class="flex items-start">
                <label class="form_label">商品規格</label>
                <button type="button" class="admin_plus_btn ml-2" id="product_specification_add_btn">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>

            <div id="product_specification_container"></div>

            <script>
                $('#product_specification_add_btn').click(function() {
                    $('#product_specification_container').append(`
                        <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">名稱：</label>
                                <input type="text" name="option_names[]" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                            </div>
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">順序：</label>
                                <input type="number" name="option_sequences[]" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
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
            <textarea name="summary" class="form_textarea custom_scrollbar"></textarea>
        </div>

        <div class="form_group">
            <label class="form_label">商品內容</label>
            <textarea name="content" class="form_textarea custom_scrollbar"></textarea>
        </div>
        
        @csrf
        
        <div class="flex">
            <button class="form_btn_primary ml-auto">新增</button>
        </div>
    </form>
</div>

@include('admin.foot')
