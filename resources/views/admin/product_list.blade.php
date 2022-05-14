@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.product_list') }}" class="admin_nav_link active">商品列表</a>
    <a href="{{ route('admin.product_category_list') }}" class="admin_nav_link">商品類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.product_list') }}" disabled class="admin_sub_nav_link active">列表</a>
        <a href="{{ route('admin.product_add_form') }}" class="admin_sub_nav_link">新增</a>
        <a href="#" class="admin_sub_nav_link">批次更新</a>
        <a href="#" class="admin_sub_nav_link">勾選顯示</a>
        <a href="#" class="admin_sub_nav_link">勾選隱藏</a>
        <a href="#" class="admin_sub_nav_link">勾選刪除</a>
    </nav>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="" method="post">
            <table class="custom_table table-auto w-full border-collapse border border-slate-400">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>
                                全選 <input type="checkbox" id="all_items_checked">
                            </label>
                        </th>
                        <th class="border border-slate-300" width="100">分類</th>
                        <th class="border border-slate-300" width="100">子分類</th>
                        <th class="border border-slate-300">名稱</th>
                        <th class="border border-slate-300" width="80">順序</th>
                        <th class="border border-slate-300" width="90">顯示/隱藏</th>
                        <th class="border border-slate-300" width="80">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="checked_ids[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($products) == 0)
                        <tr>
                            <td colspan="6" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($products as $product)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }} <input type="checkbox" name="checked_ids[]" value="{{ $product->id }}" class="mr-2">
                                <input type="hidden" name="ids[]" value="{{ $product->id }}">
                            </td>
                            <td class="border border-slate-300">
                                @if (is_null($product->product_category))
                                    無
                                @else
                                    {{ $product->product_category->category_name }}
                                @endif
                            </td>
                            <td class="border border-slate-300">
                                @if (is_null($product->product_subcategory))
                                    無
                                @else
                                    {{ $product->product_subcategory->subcategory_name }}
                                @endif
                            </td>
                            <td class="border border-slate-300 text-left">{{ $product->product_name }}</td>
                            <td class="border border-slate-300 text-left">
                                <input type="number" class="form_control_secondary text-right" name="sequences[]" value="{{ $product->sequence }}">
                            </td>
                            <td class="border border-slate-300">
                                @if ($product->display == '1')
                                    顯示
                                @else
                                    隱藏
                                @endif
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.product_update_form', $product->id) }}" class="link_btn">設定</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

            @csrf

        </form>
    </div>
</div>

@include('admin.foot')
