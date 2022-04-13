@include('admin.head')

<nav class="admin_nav">
    <a href="news_list" class="admin_nav_link">最新消息列表</a>
    <a href="news_category_list" class="admin_nav_link active">最新消息類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="news_category_list" class="admin_sub_nav_link active">列表</a>
        <a href="news_category_add_form" class="admin_sub_nav_link">新增</a>
        <a href="#" class="admin_sub_nav_link">批次更新</a>
        <a href="#" class="admin_sub_nav_link">勾選顯示</a>
        <a href="#" class="admin_sub_nav_link">勾選隱藏</a>
        <a href="#" class="admin_sub_nav_link">勾選刪除</a>
    </nav>
    
    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="" method="post">
            <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>
                                全選 <input type="checkbox" id="all_items_checked">
                            </label>
                        </th>
                        <th class="border border-slate-300">分類名稱</th>
                        <th class="border border-slate-300" width="80">順序</th>
                        <th class="border border-slate-300" width="90">顯示/隱藏</th>
                        <th class="border border-slate-300" width="80">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="multiple_items_checked[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    <?php $i = 1; ?>
                    @foreach ($news_categories as $news_category)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $i }} <input type="checkbox" name="multiple_items_checked[]" class="mr-2">
                            </td>
                            <td class="border border-slate-300 text-left">
                                <input type="text" class="form_control_secondary" value="{{ $news_category->category_name }}">
                            </td>
                            <td class="border border-slate-300 text-left"">
                                <input type="number" class="form_control_secondary text-right" value="{{ $news_category->sequence }}">
                            </td>
                            <td class="border border-slate-300">
                                @if ($news_category->display == '1')
                                    顯示
                                @else
                                    隱藏
                                @endif
                            </td>
                            <td class="border border-slate-300">
                                <a href="#" class="link_btn">刪除</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach

                </tbody>
            </table>
        </form>
    </div>
</div>

@include('admin.foot')
