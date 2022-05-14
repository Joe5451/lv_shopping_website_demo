@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.product_list') }}" class="admin_nav_link">商品列表</a>
    <a href="{{ route('admin.product_category_list') }}" class="admin_nav_link active">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.product_category_list') }}" class="admin_sub_nav_link active">列表</a>
        <a href="{{ route('admin.product_category_add_form') }}" class="admin_sub_nav_link">新增</a>
        <a onclick="batch_action('update');" class="admin_sub_nav_link">批次更新</a>
        <a onclick="batch_action('display_on');" class="admin_sub_nav_link">勾選顯示</a>
        <a onclick="batch_action('display_off');" class="admin_sub_nav_link">勾選隱藏</a>
        <a onclick="confirmBatchDelete();" class="admin_sub_nav_link">勾選刪除</a>

        <script>
            function batch_action(action) {
                $('input[name=action]').val(action);
                $('#batch_update_form').submit();
            }

            function confirmBatchDelete() {
                Swal.fire({
                    icon: 'question',
                    title: '確定執行刪除?',
                    showCancelButton: true,
                    cancelButtonText: '取消',
                    confirmButtonText: '確定',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('input[name=action]').val('delete');
                        $('#batch_update_form').submit();
                    } 
                })
            }
        </script>
    </nav>
    
    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="{{ route('admin.product_category_batch_action') }}" method="post" id="batch_update_form">
            <input type="hidden" name="action" value="none">

            <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>
                                全選 <input type="checkbox" id="all_items_checked">
                            </label>
                        </th>
                        <th class="border border-slate-300">分類名稱</th>
                        <th class="border border-slate-300">子分類名稱</th>
                        <th class="border border-slate-300" width="80">順序</th>
                        <th class="border border-slate-300" width="90">顯示/隱藏</th>
                        <th class="border border-slate-300" width="100">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="checked_ids[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($product_categories) == 0)
                        <tr>
                            <td colspan="5" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($product_categories as $product_category)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }} <input type="checkbox" name="checked_ids[]" value="{{ $product_category->product_category_id }}" class="mr-2">
                                <input type="hidden" name="ids[]" value="{{ $product_category->product_category_id }}">
                            </td>
                            <td class="border border-slate-300 text-left">
                                <input type="text" class="form_control_secondary" name="category_names[]" value="{{ $product_category->category_name }}">
                            </td>
                            <td class="border border-slate-300 text-left">
                                @if (count($product_category->product_subcategories) == 0)
                                    無
                                @endif

                                @foreach ($product_category->product_subcategories as $subcategory)
                                    {{ $subcategory->subcategory_name }}
                                    @if ($subcategory->display == '1')
                                        (顯示)<br>
                                    @else
                                        (隱藏)<br>
                                    @endif
                                @endforeach
                            </td>
                            <td class="border border-slate-300 text-left">
                                <input type="number" class="form_control_secondary text-right" name="sequences[]" value="{{ $product_category->sequence }}">
                            </td>
                            <td class="border border-slate-300">
                                @if ($product_category->display == '1')
                                    顯示
                                @else
                                    隱藏
                                @endif
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.product_category_update_form', $product_category->product_category_id) }}" class="link_btn">設定</a>
                                <a href="{{ route('admin.product_category_delete', $product_category->product_category_id) }}" onclick="confirmDelete(event);" class="link_btn">刪除</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            @csrf

        </form>

        <script>
            function confirmDelete(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: '確定執行刪除?',
                    showCancelButton: true,
                    cancelButtonText: '取消',
                    confirmButtonText: '確定',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(e.target).attr('href');
                    } 
                })
            }
        </script>
    </div>
</div>

@include('admin.foot')
