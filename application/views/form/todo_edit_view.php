<base href="<?= BASE_URL ?>/" />
<style type="text/css">@import URL("sys/css/main.css");</style>
<style>
#fmTitle {width:490px;}
#fmHours {width:100px;}
#fmNote  {width:570px; height:120px;}
</style>
<form class='form' action='<?= BASE_URL ?>/form/todo_edit/submit/{todoID}' method='POST'>
    <div style='font-weight:bold; font-size:16px;'>新增工作</div>
    <div>工作名稱: <input type='text' id='fmTitle' name='fmTitle' value='{todo_title}'></div>
    <div>估計時間: <input type='text' id='fmHours' name='fmHours' value='{todo_hours}'> (小時)</div>
    <div>工作描述: <br><textarea id='fmNote' name='fmNote'>{todo_note}</textarea></div>
    <input id='fmSubmit' type='submit' class='button' value='送出'>
</form>
