@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.order_list') }}" class="admin_nav_link active">訂單列表</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.order_list') }}" disabled class="admin_sub_nav_link active">列表</a>
    </nav>

    <form action="{{ route('admin.order_update', $order->order_id) }}" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">訂單建立時間</label>
            <input type="text" class="form_control" value="{{ $order->datetime }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">訂購人姓名</label>
            <input type="text" class="form_control" value="{{ $order->name }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">訂購人電話</label>
            <input type="text" class="form_control" value="{{ $order->phone }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">訂購人 Email</label>
            <input type="text" class="form_control" value="{{ $order->email }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">訂購人地址</label>
            <input type="text" class="form_control" value="{{ $order->address }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">收件人姓名</label>
            <input type="text" class="form_control" value="{{ $order->receiver_name }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">收件人電話</label>
            <input type="text" class="form_control" value="{{ $order->receiver_phone }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">收件人 Email</label>
            <input type="text" class="form_control" value="{{ $order->receiver_email }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">收件人地址</label>
            <input type="text" class="form_control" value="{{ $order->receiver_address }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">商品小計</label>
            <input type="text" class="form_control" value="{{ $order->subtotal }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">運費</label>
            <input type="text" class="form_control" value="{{ $order->delivery_fee }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">總金額</label>
            <input type="text" class="form_control" value="{{ $order->total }}" readonly>
        </div>

        <div class="form_group">
            <label class="form_label">消費者備註</label>
            <textarea class="form_textarea custom_scrollbar" readonly>{{ $order->order_remark }}</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">狀態</label>
            <select name="order_state" class="form_select">
                @foreach ($order_states as $order_state => $order_state_text)
                    <option value="{{ $order_state }}">{{ $order_state_text }}</option>
                @endforeach
            </select>

            <script>
                $('select[name=order_state]').val({{ $order->order_state }});
            </script>
        </div>

        @csrf

        <div class="flex">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>

    <div class="table_container overflow-x-auto custom_horizontal_scrollbar">
        <table class="custom_table table-auto w-full border-collapse border border-slate-400 min-w-max">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="border border-slate-300" width="60">
                        <label>序列</label>
                    </th>
                    <th class="border border-slate-300" width="120">商品圖片</th>
                    <th class="border border-slate-300">商品名稱</th>
                    <th class="border border-slate-300">商品主分類名稱</th>
                    <th class="border border-slate-300">商品子分類名稱</th>
                    <th class="border border-slate-300">商品規格</th>
                    <th class="border border-slate-300">數量</th>
                    <th class="border border-slate-300">單價</th>
                    <th class="border border-slate-300">小計</th>
                </tr>
            </thead>
            <tbody class="text-slate-700">
                @foreach ($order_items as $order_item)
                    <tr>
                        <td class="border border-slate-300 text-right">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-slate-300">
                            <img src="{{ env('IMG_URL') . $order_item->product_img }}" class="w-24 h-24 object-cover m-auto">
                        </td>
                        <td class="border border-slate-300">{{ $order_item->product_name }}</td>
                        <td class="border border-slate-300">{{ $order_item->product_category_name }}</td>
                        <td class="border border-slate-300">{{ $order_item->product_subcategory_name }}</td>
                        <td class="border border-slate-300">
                            @if ($order_item->option_id != '')
                                {{ $order_item->option_name }}
                            @else
                                <span class="text-gray-400">無</span>
                            @endif
                        </td>
                        <td class="border border-slate-300 text-right">{{ number_format($order_item->amount) }}</td>
                        <td class="border border-slate-300 text-right">{{ number_format($order_item->price) }}</td>
                        <td class="border border-slate-300 text-right">{{ number_format($order_item->amount*$order_item->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.foot')
