@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.order_list') }}" class="admin_nav_link">訂單管理</a>
    <a href="{{ route('admin.delivery_fee_update_form') }}" class="admin_nav_link active">運費管理</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.delivery_fee_update_form') }}" disabled class="admin_sub_nav_link active">管理</a>
    </nav>

    <form action="{{ route('admin.delivery_fee_update') }}" method="post" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">運費</label>
            <input type="number" name="fee" class="form_control" value="{{ $delivery_fee->fee }}" min="0" max="100000" required>
        </div>

        <div class="flex">
            @csrf
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
