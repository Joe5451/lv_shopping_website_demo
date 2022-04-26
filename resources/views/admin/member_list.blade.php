@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.member_list') }}" class="admin_nav_link active">會員管理</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.member_list') }}" disabled class="admin_sub_nav_link active">列表</a>
        <a href="{{ route('admin.member_add_form') }}" class="admin_sub_nav_link">新增</a>
        <a onclick="batch_action('state_on');" class="admin_sub_nav_link">勾選正常</a>
        <a onclick="batch_action('state_off');" class="admin_sub_nav_link">勾選停權</a>

        <script>
            function batch_action(action) {
                $('input[name=action]').val(action);
                $('#batch_update_form').submit();
            }
        </script>
    </nav>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="{{ route('admin.member_batch_action') }}" method="post" id="batch_update_form">
            <input type="hidden" name="action" value="none">

            <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>
                                全選 <input type="checkbox" id="all_items_checked">
                            </label>
                        </th>
                        <th class="border border-slate-300" width="190">加入時間</th>
                        <th class="border border-slate-300">帳號</th>
                        <th class="border border-slate-300">姓名</th>
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
                    @if (count($members) == 0)
                        <tr>
                            <td colspan="6" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif

                    @foreach ($members as $member)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }} <input type="checkbox" name="checked_ids[]" value="{{ $member->member_id }}" class="mr-2">
                                <input type="hidden" name="ids[]" value="{{ $member->member_id }}">
                            </td>
                            <td class="border border-slate-300">{{ $member->datetime }}</td>
                            <td class="border border-slate-300">{{ $member->account }}</td>
                            <td class="border border-slate-300">{{ $member->name }}</td>
                            <td class="border border-slate-300">
                                @if ($member->state == '1')
                                    正常
                                @else
                                    停權
                                @endif
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.member_update_form', $member->member_id) }}" class="link_btn">設定</a>
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
