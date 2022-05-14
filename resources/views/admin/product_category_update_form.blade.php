@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.product_list') }}" class="admin_nav_link">商品列表</a>
    <a href="{{ route('admin.product_category_list') }}" class="admin_nav_link active">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">

    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.product_category_list') }}" class="admin_sub_nav_link active">列表</a>
        <a href="{{ route('admin.product_category_add_form') }}" class="admin_sub_nav_link">新增</a>
    </nav>
    
    <form action="{{ route('admin.product_category_update', $category->product_category_id) }}" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">分類名稱</label>
            <input type="text" name="category_name" value="{{ $category->category_name }}" class="form_control" required>
        </div>

        <div class="form_group">
            <label class="form_label">顯示/隱藏</label>
            <select name="display" class="form_select" required>
                <option value="1">顯示</option>
                <option value="0">隱藏</option>
            </select>

            <script>
                $('select[name=display]').val({{ $category->display }});
            </script>
        </div>

        <div class="form_group">
            <label class="form_label">順序</label>
            <input type="number" name="sequence" class="form_control" value="{{ $category->sequence }}" required>
        </div>

        <div class="form_group">
            <div class="flex items-start">
                <label class="form_label">子分類</label>
                <button type="button" class="admin_plus_btn ml-2" id="product_subcategory_add_btn">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>

            <div id="product_subcategory_container">
                @foreach ($category->product_subcategories as $subcategory)
                    <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                        <input type="hidden" name="subcategory_ids[]" value="{{ $subcategory->product_subcategory_id }}">
                        <div class="my-2 flex items-center">
                            <label class="shrink-0 text-slate-500">子分類名稱：</label>
                            <input type="text" name="subcategory_names[]" value="{{ $subcategory->subcategory_name }}" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                        </div>
                        <div class="my-2 flex items-center">
                            <label class="shrink-0 text-slate-500">狀態：</label>
                            <select name="subcategory_displays[]" class="w-18 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                                <option value="1" @if ($subcategory->display == '1') selected @endif >顯示</option>
                                <option value="0" @if ($subcategory->display == '0') selected @endif>隱藏</option>
                            </select>
                        </div>
                        <div class="my-2 flex items-center">
                            <label class="shrink-0 text-slate-500">順序：</label>
                            <input type="number" name="subcategory_sequences[]" value="{{ $subcategory->sequence }}" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                            <button type="button" class="admin_minus_btn" onclick="deleteSpecification(this);">
                                <i class="fas fa-minus-circle"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <script>
                $('#product_subcategory_add_btn').click(function() {
                    $('#product_subcategory_container').append(`
                        <div class="specification_wrap flex flex-wrap border-b border-slate-300 mb-3">
                            <input type="hidden" name="subcategory_ids[]" value="new">
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">子分類名稱：</label>
                                <input type="text" name="subcategory_names[]" class="w-36 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                            </div>
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">狀態：</label>
                                <select name="subcategory_displays[]" class="w-18 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
                                    <option value="1">顯示</option>
                                    <option value="0">隱藏</option>
                                </select>
                            </div>
                            <div class="my-2 flex items-center">
                                <label class="shrink-0 text-slate-500">順序：</label>
                                <input type="number" name="subcategory_sequences[]" value="0" class="w-16 border border-slate-400 py-1 px-2 focus:border-cyan-400 mr-4" required>
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


        
        <div class="flex">
            @csrf
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
