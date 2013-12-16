<style>
.button {border-radius: 5px;}
</style>

<script type="text/javascript">
// 編輯
function to_edit() 
{
    $.fancybox(
    {
        'type'      : 'iframe',
        'href'      : '<?= BASE_URL ?>/form/todo_edit',
        'width'     : 500,
        'height'    : 200,
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
<table class='list'>
    <tr class='header'>
        <th>工作名稱</th>
        <th>工作內容</th>
        <th>建立時間</th>
    </tr>
    {data}
    <tr class='row'>
        <td>{title}</td>
        <td>{note}</td>
        <td>{createTime}</td>
    </tr>
    {/data}
</table>