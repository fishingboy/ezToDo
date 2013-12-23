<html>
<head>
<base href="<?= BASE_URL ?>/" />
<style type="text/css">@import URL("sys/css/main.css");</style>
<script type="text/javascript" src="sys/js/jquery.js"></script>
<script type="text/javascript" src="sys/js/jquery.fancybox.js"></script>
<style>
#fmTitle       {width:490px;}
#fmHours       {width:100px;}
#fmUsedHours   {width:100px;}
.add #fmNote   {width:850px; height:350px;}
.edit #fmNote  {width:850px; height:300px;}
#button_bar    {}
#button_left   {float: left;}
#button_right  {float: right;}
</style>
<script type="text/javascript">
var $todo_edit = 
{
    // 頁面初始化
    page_init : function() 
    {
        // 存檔
        $('#fmSave').bind('click', this, this.save);

        // 自動存檔
        $('#fmAutoSave').bind('click', this, this.auto_save);
    },

    // 存檔
    save : function(event) 
    {
        var param = 
        {
            ajax        : 1,
            fmTitle     : $('#fmTitle').val(),
            fmNote      : $('#fmNote').val(),
            fmHours     : $('#fmHours').val(),
            fmUsedHours : $('#fmUsedHours').val(),
            fmStatus    : $('#fmStatus').val(),
            fmSN        : $('#fmSN').val()
        };

        $.ajax
        ({
            type     : 'post',
            data     : param,
            dataType : 'json',
            url      : '<?= BASE_URL ?>/form/todo_edit/edit/{todoID}',
            error    : function(){alert('ajax error!');},
            success  : function(data) 
            {
                $('#msg').text(data.msg);
            }
        });
    },

    // 自動存檔
    auto_save : function(event) 
    {
        if ($('#fmAutoSave').prop('checked'))
        {
            $todo_edit.save();
            window.setTimeout($todo_edit.auto_save, 5000);
        }
    }
};


$(function() 
{
    $todo_edit.page_init();
});
</script>
</head>
<body>
<form class='form <?= ($todo_status == 0) ? "add" : "edit" ?>' action='<?= BASE_URL ?>/form/todo_edit/edit/{todoID}' method='POST'>
    <input type='hidden' id='fmSN' name='fmSN' value='{todo_sn}'>
    <div style='font-weight:bold; font-size:16px;'><?= ($todo_status) ? "編輯工作" : "新增工作" ?></div>
    <div>工作名稱: <input type='text' id='fmTitle' name='fmTitle' value='{todo_title}'></div>
    <div>估計時間: <input type='text' id='fmHours' name='fmHours' value='{todo_hours}'> (小時)</div>
    <?php if ($todo_status != 0): ?>
    <div>已用時間: <input type='text' id='fmUsedHours' name='fmUsedHours' value='{todo_used_hours}'> (小時)</div>
    <div>狀態: 
        <input type='radio' id='fmStatus'  name='fmStatus' value='1' <?= ($todo_status == 1) ? "checked" : "" ?> />未完成
        <input type='radio' id='fmStatus'  name='fmStatus' value='2' <?= ($todo_status == 2) ? "checked" : "" ?> />完成
        <input type='radio' id='fmStatus'  name='fmStatus' value='3' <?= ($todo_status == 3) ? "checked" : "" ?> />擱置
        <input type='hidden' id='fmOldStatus' name='fmOldStatus' value='{todo_status}'>
    </div>
    <?php else:?>
    <input type='hidden' id='fmStatus' name='fmStatus' value='{todo_status}'>
    <?php endif; ?>
    <div>工作描述: <br><textarea id='fmNote' name='fmNote'>{todo_note}</textarea></div>
    <div id='button_bar' class='clearfix'>
        <div id='button_left'>
            <input id='fmSubmit' type='submit' class='button' value='送出'>
            <input id='fmSave' type='button' class='button' value='儲存'>
            <span id='msg'></span>
        </div>
        <div id='button_right'>
            <input type='checkbox' id='fmAutoSave' name='fmAutoSave' value='1'>自動存檔(5秒)
        </div>
    </div>
</form>
</body>
</html>