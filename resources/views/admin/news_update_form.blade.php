@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.news_list') }}" class="admin_nav_link active">最新消息列表</a>
    <a href="{{ route('admin.news_category_list') }}" class="admin_nav_link">最新消息類別</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.news_list') }}" class="admin_sub_nav_link active">列表</a>
        <a href="{{ route('admin.news_add_form') }}" class="admin_sub_nav_link">新增</a>
    </nav>

    <form action="{{ route('admin.news_update') }}" method="post" enctype="multipart/form-data" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">封面圖</label>

            <?php
                if ($new->img_src != '') {
                    $img_src = env('APP_URL') . '/storage/app/'. $new->img_src;
                } else {
                    $img_src = '';
                }
            ?>
            
            <input type="file" name="img_src" class="dropify" data-default-file="{{ $img_src }}" data-max-file-size="1M" />
            <input type="hidden" name="delete_img" value="false">

            <script>
                let drEvent = $('.dropify').dropify({
                    messages: {
                        'default': '將文件拖放到此處或單擊',
                        'replace': '拖放或點擊替換',
                        'remove':  '刪除',
                        'error':   '糟糕，發生了錯誤'
                    }
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    $('input[name=delete_img]').val('true');
                });
            </script>
        </div>
        
        <div class="form_group">
            <label class="form_label">標題</label>
            <input type="text" name="title" class="form_control" value="{{ $new->title }}">
        </div>

        <div class="form_group">
            <label class="form_label">分類</label>
            <select name="news_category_id" class="form_select">
                <option value="none">無</option>
                @foreach ($news_categories as $news_category)
                    <option value="{{ $news_category->news_category_id }}">{{ $news_category->category_name }}</option>
                @endforeach
            </select>

            <script>
                $('select[name=news_category_id]').val('{{ $new->news_category_id }}');
            </script>
        </div>

        <div class="form_group">
            <label class="form_label">顯示/隱藏</label>
            <select name="display" class="form_select">
                <option value="1">顯示</option>
                <option value="0">隱藏</option>
            </select>

            <script>
                $('select[name=display]').val('{{ $new->display }}');
            </script>
        </div>

        <div class="form_group">
            <label class="form_label">日期</label>
            <input type="text" name="date" class="form_control" value="{{ $new->date }}">
        </div>

        <div class="form_group">
            <label class="form_label">摘要</label>
            <textarea name="summary" class="form_textarea custom_scrollbar">{{ $new->summary }}</textarea>
        </div>

        <div class="form_group">
            <label class="form_label">內容</label>
            <textarea name="content" class="form_textarea custom_scrollbar">{{ $new->content }}</textarea>
        </div>

        @csrf

        <div class="flex">
            <input type="hidden" name="id" value="{{ $new->id }}">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
