@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.contact_list') }}" class="admin_nav_link active">聯絡我們</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.contact_list') }}" disabled class="admin_sub_nav_link active">列表</a>
        <a onclick="batch_action('solved');" class="admin_sub_nav_link">勾選已處理</a>
        <a onclick="batch_action('processing');" class="admin_sub_nav_link">勾選處理中</a>
        <a onclick="batch_action('pending');" class="admin_sub_nav_link">勾選未處理</a>
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
        <form action="{{ route('admin.contact_batch_action') }}" method="post" id="batch_update_form">
            <input type="hidden" name="action" value="none">

            <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>
                                全選 <input type="checkbox" id="all_items_checked">
                            </label>
                        </th>
                        <th class="border border-slate-300" width="190">時間</th>
                        <th class="border border-slate-300">Email</th>
                        <th class="border border-slate-300">姓名</th>
                        <th class="border border-slate-300" width="200">內容</th>
                        <th class="border border-slate-300" width="80">狀態</th>
                        <th class="border border-slate-300" width="80">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="checked_ids[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($contacts) == 0)
                        <tr>
                            <td colspan="7" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }} <input type="checkbox" name="checked_ids[]" value="{{ $contact->id }}" class="mr-2">
                                <input type="hidden" name="ids[]" value="{{ $contact->id }}">
                            </td>
                            <td class="border border-slate-300">{{ $contact->datetime }}</td>
                            <td class="border border-slate-300">{{ $contact->email }}</td>
                            <td class="border border-slate-300">{{ $contact->name }}</td>
                            <td class="border border-slate-300">
                                <div class="multiple_line_ellipsis two_line_ellipsis" title="{{ $contact->content }}">
                                    {{ $contact->content }}
                                </div>
                            </td>
                            <td class="border border-slate-300">
                                {{ $contact_states[$contact->state] }}
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.contact_update_form', $contact->id)  }}" class="link_btn">設定</a>
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
