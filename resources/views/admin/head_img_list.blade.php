@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.head_img_list') }}" class="admin_nav_link active">上方大圖</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.home_slider') }}" disabled class="admin_sub_nav_link active">列表</a>
    </nav>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="{{ route('admin.home_slider_batch_action') }}" method="post" id="batch_update_form">
            <input type="hidden" name="action" value="none">

            <table class="custom_table table-auto w-full border-collapse border border-slate-400">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="90">頁面</th>
                        <th class="border border-slate-300">圖片</th>
                        <th class="border border-slate-300" width="100">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="checked_ids[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($head_imgs) == 0)
                        <tr>
                            <td colspan="3" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($head_imgs as $head_img)
                        <tr>
                            <td class="border border-slate-300">
                                {{ $head_img->page_name }}
                            </td>
                            <td class="border border-slate-300">
                                <img src="{{ env('IMG_URL') . $head_img->img_src }}" style="height: 120px;">
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.head_img_update_form', $head_img->id) }}" class="link_btn">設定</a>
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
