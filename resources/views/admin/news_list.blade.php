<?php include('head.php'); ?>

<nav class="admin_nav">
    <a href="news_list.php" class="admin_nav_link active">最新消息列表</a>
    <a href="news_category_list.php" class="admin_nav_link">最新消息類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="news_list.php" disabled class="admin_sub_nav_link active">列表</a>
        <a href="news_add_form.php" class="admin_sub_nav_link">新增</a>
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
                        <th class="border border-slate-300" width="120">日期</th>
                        <th class="border border-slate-300" width="100">分類</th>
                        <th class="border border-slate-300">標題</th>
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
                    <?php
                        for ($i=1; $i<=10; $i++) {
                            echo <<<NewsList
                                <tr>
                                    <td class="border border-slate-300 text-right">
                                        $i <input type="checkbox" name="multiple_items_checked[]" class="mr-2">
                                    </td>
                                    <td class="border border-slate-300">2022/01/05</td>
                                    <td class="border border-slate-300">好康優惠</td>
                                    <td class="border border-slate-300 text-left">最新商品快報</td>
                                    <td class="border border-slate-300">顯示</td>
                                    <td class="border border-slate-300">
                                        <a href="news_update_form.php" class="link_btn">設定</a>
                                    </td>
                                </tr>
NewsList;
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php include('foot.php'); ?>
