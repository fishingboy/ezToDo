<script type="text/javascript">
// 編輯
function to_edit() 
{
    $.fancybox(
    {
        'type'      : 'iframe',
        'href'      : '<?= BASE_URL ?>/form/todo_edit',
        'width'     : 500,
        'height'    : 140,
        'autoSize'  : false
    });
}

$(function() 
{   
    // 綁定事件
    $('#fmAdd').bind('click', to_edit);
});
</script>

<input id='fmAdd' type='button' class='button' value='新增'>
{data}
<div class='jobBox'>
    <div class='jobInfo'>
        <div class='more'>詳細</div>
        <div class='createTime'>建立時間: {createTime}</div>
        <div class='hours'>估計需要: {hours} 小時</div>
        <div class='title'>{title}</div>
    </div>
    <div class='jobNote'>{note}</div>
</div>
{/data}
