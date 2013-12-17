<script type="text/javascript">
var $todo_edit = 
{
    page_init : function() 
    {
        // 綁定事件
        $('#fmAdd').bind('click', this, $todo_edit.add);
        $('.del_button').bind('click', this, $todo_edit.del);
        $('.edit_button').bind('click', this, $todo_edit.edit);
    },

    // 編輯
    add : function() 
    {
        $.fancybox(
        {
            'type'      : 'iframe',
            'href'      : '<?= BASE_URL ?>/form/todo_edit',
            'width'     : 600,
            'height'    : 270,
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
            'width'     : 600,
            'height'    : 270,
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
    }
}

$(function() 
{   
    $todo_edit.page_init();
});
</script>

<input id='fmAdd' type='button' class='button' value='新增'>
<?php if (count($data) == 0): ?>
    <div class='error'>尚無資料！</div>
<?php else: ?>
    {data}
    <div class='jobBox'>
        <div class='jobInfo'>
            <div class='tools'>
                <img id='edit_{id}' class='edit_button button_icon' src='<?= BASE_URL ?>/sys/images/edit.gif'>
                <img id='del_{id}' class='del_button button_icon' src='<?= BASE_URL ?>/sys/images/delete.gif'>
            </div>
            <div class='more'>詳細</div>
            <div class='createTime'>建立時間: {createTime}</div>
            <div class='hours'>估計需要: {hours} 小時</div>
            <div class='title'>{title}</div>
        </div>
        <div class='jobNote'>{note}</div>
    </div>
    {/data}
<?php endif; ?>