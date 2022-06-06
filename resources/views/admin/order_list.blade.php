@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.order_list') }}" class="admin_nav_link active">訂單管理</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.order_list') }}" disabled class="admin_sub_nav_link active">列表</a>
    </nav>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <form action="" method="post">
            <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="border border-slate-300" width="80">
                            <label>序列</label>
                        </th>
                        <th class="border border-slate-300" width="190">建立時間</th>
                        <th class="border border-slate-300">收件人姓名</th>
                        <th class="border border-slate-300">收件人電話</th>
                        <th class="border border-slate-300">總金額</th>
                        <th class="border border-slate-300" width="80">狀態</th>
                        <th class="border border-slate-300" width="80">動作</th>
                    </tr>
                    <script>
                        $('#all_items_checked').click(function() {
                            $('input[name="multiple_items_checked[]"]').prop('checked', $(this).prop('checked'));
                        });
                    </script>
                </thead>
                <tbody class="text-slate-700">
                    @if (count($orders) == 0)
                        <tr>
                            <td colspan="7" class="border border-slate-300 text-center">
                                無資料
                            </td>
                        </tr>
                    @endif
                    
                    @foreach ($orders as $order)
                        <tr>
                            <td class="border border-slate-300 text-right">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="border border-slate-300">{{ $order->datetime }}</td>
                            <td class="border border-slate-300">{{ $order->receiver_name }}</td>
                            <td class="border border-slate-300">{{ $order->receiver_phone }}</td>
                            <td class="border border-slate-300 text-right">${{ number_format($order->total) }}</td>
                            <td class="border border-slate-300">
                                {{ $order_states[$order->order_state] }}
                            </td>
                            <td class="border border-slate-300">
                                <a href="{{ route('admin.order_update_form', $order->order_id) }}" class="link_btn">管理</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

@include('admin.foot')
