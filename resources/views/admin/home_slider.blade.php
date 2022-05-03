@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.home_slider') }}" class="admin_nav_link active">大圖輪播</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.home_slider') }}" disabled class="admin_sub_nav_link active">列表</a>
        <a onclick="batch_action('update');" class="admin_sub_nav_link">批次更新</a>

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

    <form action="{{ route('admin.home_slider_add') }}" method="post" enctype="multipart/form-data" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">新增輪播圖</label>
            <input type="file" name="img_src" class="dropify" data-max-file-size="1M" />

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
            <label class="form_label">連結</label>
            <input type="text" name="href" class="form_control" value="">
        </div>

        <div class="form_group">
            <label class="form_label">順序</label>
            <input type="number" name="sequence" class="form_control" value="0" required>
        </div>

        @csrf

        <div class="flex">
                <button class="form_btn_primary ml-auto">新增</button>
            </div>
    </form>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="{{ route('admin.home_slider_batch_action') }}" method="post" id="batch_update_form">
            <input type="hidden" name="action" value="none">

            <table class="custom_table table-auto w-full border-collapse border border-slate-400">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">項次</th>
                        <th class="border border-slate-300">圖片</th>
                        <th class="border border-slate-300">連結</th>
                        <th class="border border-slate-300" width="80">順序</th>
                        <th class="border border-slate-300" width="100">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="checked_ids[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($sliders) == 0)
                        <tr>
                            <td colspan="4" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($sliders as $slider)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }}
                                <input type="hidden" name="ids[]" value="{{ $slider->id }}">
                            </td>
                            <td class="border border-slate-300">
                                <img src="{{ env('IMG_URL') . $slider->img_src }}" style="height: 120px;">
                            </td>
                            <td class="border border-slate-300 text-left">
                                <input type="text" class="form_control_secondary" name="hrefs[]" value="{{ $slider->href }}">
                            </td>
                            <td class="border border-slate-300 text-left">
                                <input type="number" class="form_control_secondary text-right" name="sequences[]" value="{{ $slider->sequence }}">
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.home_slider_update_form', $slider->id) }}" class="link_btn">設定</a>
                                <a href="{{ route('admin.home_slider_delete', $slider->id) }}" onclick="confirmDelete(event);"" class="link_btn">刪除</a>
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
