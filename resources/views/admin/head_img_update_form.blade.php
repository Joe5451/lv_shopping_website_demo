@include('admin.head')

<nav class="admin_nav">
    <a href="{{ route('admin.head_img_list') }}" class="admin_nav_link active">上方大圖</a>
</nav>

<div class="container mx-auto px-4 pb-8">
    <nav class="admin_sub_nav custom_horizontal_scrollbar">
        <a href="{{ route('admin.head_img_list') }}" class="admin_sub_nav_link">列表</a>
    </nav>

    <form action="{{ route('admin.head_img_update', $head_img->id) }}" method="post" enctype="multipart/form-data" class="admin_form max-w-screen-sm">
        <div class="form_group">
            <label class="form_label">{{ $head_img->page_name }}-上方大圖</label>

            <?php
                if ($head_img->img_src != '') {
                    $img_src = env('IMG_URL') . $head_img->img_src;
                } else {
                    $img_src = '';
                }
            ?>
            
            <input type="file" name="img_src" class="dropify" data-default-file="{{ $img_src }}" data-max-file-size="1M" />
            <!-- <input type="hidden" name="delete_img" value="false"> -->

            <script>
                let drEvent = $('.dropify').dropify({
                    messages: {
                        'default': '將文件拖放到此處或單擊',
                        'replace': '拖放或點擊替換',
                        'remove':  '刪除',
                        'error':   '糟糕，發生了錯誤'
                    }
                });

                // drEvent.on('dropify.afterClear', function(event, element){
                //     $('input[name=delete_img]').val('true');
                // });
            </script>
        </div>

        @csrf

        <div class="flex">
            <button class="form_btn_primary ml-auto">更新</button>
        </div>
    </form>
</div>

@include('admin.foot')
