<script type="text/javascript">
// 編輯
function to_edit() 
{
    $.fancybox(
    {
        'type'      : 'iframe',
        'href'      : '/form/todo_edit',
        'margin'    : 60,
        'padding'   : 5,
        'width'     : 500,
        'height'    : 500,
        'autoSize'  : false
    });
}

$(function() 
{   
    // 綁定事件
    $('#fmAdd').bind('click', to_edit);
});
</script>

<input id='fmAdd' type='button' value='新增'>
<a id='f1' class="fancybox" rel="group" href="big_image_1.jpg"><img src="small_image_1.jpg" alt="" /></a>
<a id='f2' class="fancybox" rel="group" href="big_image_2.jpg"><img src="small_image_2.jpg" alt="" /></a>
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