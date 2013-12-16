<base href="<?= BASE_URL ?>/" />
<style type="text/css">@import URL("sys/css/main.css");</style>
<form action='<?= BASE_URL ?>/form/todo_edit/submit/{todoID}' method='POST'>
    <div style='font-weight:bold; font-size:14px;'>新增工作</div>
    <div>工作名稱: <input type='text' id='fmTitle' name='fmTitle' value='{todo_title}'></div>
    <div>工作描述: <input type='text' id='fmNote' name='fmNote' value='{todo_note}'></div>
    <div>預計完成時間: <input type='text' id='fmHours' name='fmHours' value='{todo_hours}'> 小時</div>
    <input id='fmSubmit' type='submit' class='button' value='送出'>
</form>
