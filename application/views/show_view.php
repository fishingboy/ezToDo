<script type="text/javascript">
$(function() 
{
    $('#fmAdd').bind('click', function() 
    {
        console.log('add');
        $(".fancybox").fancybox();
    });
});
</script>

<input id='fmAdd' type='button' value='新增'>
<a class="fancybox" rel="group" href="big_image_1.jpg"><img src="small_image_1.jpg" alt="" /></a>
<a class="fancybox" rel="group" href="big_image_2.jpg"><img src="small_image_2.jpg" alt="" /></a>
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