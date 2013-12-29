<div style='margin:0 auto; text-align:center;'>    
    <form method='post' action='<?= BASE_URL ?>/page/login'>
        <div>帳號: <input name='fmAccount' type='text'></div>
        <div>密碼: <input name='fmPassword' type='password'></div>
        <div><input type='submit' value='確定'></div>
        <input type='hidden' name='fmSubmit' value='ok'>
        <input type='hidden' name='fmBackUrl' value='{back_url}'>
    </form>
</div>