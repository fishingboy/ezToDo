<html>
<head>
<base href="<?= BASE_URL ?>/" />
<style type="text/css">@import URL("sys/css/main.css");</style>
<style>
#fmTitle       {width:490px;}
#fmHours       {width:100px;}
.add #fmNote   {width:850px; height:350px;}
.edit #fmNote  {width:850px; height:300px;}
</style>
</head>
<body>
<form class='form <?= ($todo_status == 0) ? "add" : "edit" ?>' action='<?= BASE_URL ?>/form/todo_edit/submit/{todoID}' method='POST'>
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
    </div>
    <?php else:?>
    <input type='hidden' id='fmStatus' name='fmStatus' value='{todo_status}'>
    <?php endif; ?>
    <div>工作描述: <br><textarea id='fmNote' name='fmNote'>{todo_note}</textarea></div>
    <input id='fmSubmit' type='submit' class='button' value='送出'>
</form>
</body>
</html>