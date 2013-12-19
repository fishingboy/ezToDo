<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
var $todo_edit = 
{
    page_init : function() 
    {
        //==== 綁定事件 ====

        // 新增工作
        $('#fmAdd').bind('click', this, this.add);

        // 刪除工作
        $('.del_button').bind('click', this, this.del);

        // 編輯工作
        $('.edit_button').bind('click', this, this.edit);

        // 變更篩選條件
        $('#fmStatus').bind('change', this, this.change_status);

        // 展開詳細資訊
        $('.more').bind('click', this, this.expand_info);
    },

    // 編輯
    add : function() 
    {
        $.fancybox(
        {
            'type'      : 'iframe',
            'href'      : '<?= BASE_URL ?>/form/todo_edit/index',
            'width'     : 900,
            'height'    : 500,
            'autoSize'  : false
        });
    },
    
    // 編輯
    edit : function() 
    {
        var id = this.id.split('_')[1];
        $.fancybox(
        {
            'type'      : 'iframe',
            'href'      : '<?= BASE_URL ?>/form/todo_edit/index/' + id,
            'width'     : 900,
            'height'    : 500,
            'autoSize'  : false
        });
    },
    
    // 刪除
    del : function() 
    {
        var id = this.id.split('_')[1];
        if (confirm('確定要刪除工作嗎？'))
        {
            $.get('<?= BASE_URL ?>/form/todo_edit/del/' + id, function(data) 
            {
                window.location.reload(true);
            });
        }
    },
    
    // 變更篩選狀態
    change_status : function()
    {
        var status = $('#fmStatus').val();
        window.location.href = "?status=" + status;
    },

    // 展開
    expand_info : function(event) 
    {
        var todoID = this.id.split('_')[1];
        $('#jobNote_' + todoID).toggle();
    }
}

$(function() 
{   
    $todo_edit.page_init();

    var curr_todo_map = $('#jobs').children().map(function()
    {
        return $(this).attr('id');
    });


    $("#jobs").sortable(
    {
        stop: function( event, ui ) 
        {
            var id = ui.item.attr('id');

            // 找出之前的位置
            var old_sn = $.inArray(id, curr_todo_map);

            // 找出目前的順序
            var todo_map = $('#jobs').children().map(function()
            {
                return $(this).attr('id');
            });
            var sn = $.inArray(id, todo_map);
            var todoID = id.split('_')[1];

            // 判斷是往上還是往下
            console.log(sn + " > " + old_sn);
            if (sn > old_sn) sn++;

            // 寫回全域變數
            curr_todo_map = todo_map;

            // 呼叫 ajax 排序
            $.get('<?= BASE_URL ?>/form/todo_edit/sort/' + todoID + '/' + sn, function(data) 
            {
                // window.location.reload(true);
            });
        }
    });
});
</script>
<div id='tool_bar' class='clearfix'>
    <div id='tool_left'><input id='fmAdd' type='button' class='button' value='新增'></div>
    <div id='tool_right'>
        <select id='fmStatus'>
            <option value='0' <?= ($status == 0) ? "selected" : "" ?> />所有工作</option>
            <option value='1' <?= ($status == 1) ? "selected" : "" ?> />未完成</option>
            <option value='2' <?= ($status == 2) ? "selected" : "" ?> />已完成</option>
            <option value='3' <?= ($status == 3) ? "selected" : "" ?> />擱置</option>
        </select>
    </div>
</div>
<?php if (count($data) == 0): ?>
    <div class='error'>尚無資料！</div>
<?php else: ?>
    <div id='jobs'>
        {data}
        <div id='jobBox_{todoID}' class='jobBox'>
            <div class='jobInfo'>
                <div class='tools'>
                    <img id='edit_{todoID}' class='edit_button button_icon' src='<?= BASE_URL ?>/sys/images/edit.gif'>
                    <img id='del_{todoID}' class='del_button button_icon' src='<?= BASE_URL ?>/sys/images/delete.gif'>
                </div>
                <div id='expand_{todoID}' class='more'>詳細</div>
                <div class='createTime'>建立時間: {createTime}</div>
                <div class='hours'>估計需要: {hours} 小時</div>
                <div class='title'>{title}</div>
            </div>
            <div id='jobNote_{todoID}' class='jobNote'>{note}</div>
        </div>
        {/data}
    </div>
<?php endif; ?>