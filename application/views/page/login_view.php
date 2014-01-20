<html>
<head>
<title>Login Page</title>
<style>
body {height: 100%;}
form {margin:0px;}
#block_top, #block_bottom {height: 30%;}
#login_box {margin:0 auto; text-align:center;background:#eee; border:1px solid #555; border-radius:10px; width:300px;}
#login_box .title {background:#555; font-size:24px; color:#fff; margin:0 0 10px; border-radius:10px 10px 0 0; padding:5px; border:2px solid #555;}
#login_box .row {margin:5px 0;}
</style>
</head>
<body>
<div id='block_top'></div>
<div id='login_box'>
    <h1 class='title'>ToDo System</h1>
    <form method='post' action='<?= BASE_URL ?>/page/login'>
        <div class='row'>帳號: <input name='fmAccount' type='text'></div>
        <div class='row'>密碼: <input name='fmPassword' type='password'></div>
        <div class='row'>
            <input type='submit' value='確定'>
            <input type='reset' value='取消'>
        </div>
        <input type='hidden' name='fmSubmit' value='ok'>
        <input type='hidden' name='fmBackUrl' value='{back_url}'>
    </form>
</div>
<div id='block_bottom'></div>
</body>
</html>