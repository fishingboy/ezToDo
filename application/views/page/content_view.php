<?php
$status_name[0] = '所有工作';
$status_name[1] = '未完成';
$status_name[2] = '已完成';
$status_name[3] = '擱置';
?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
var $todo_edit =
{
    page_init : function()
    {
        //==== 綁定事件 ====

        <?php if (defined('USER_ACCOUNT')): ?>
            // 新增工作
            $('.fmAdd').bind('click', this, this.add);

            // 刪除工作(批次)
            $('.fmDel').bind('click', this, this.del_todos);

            // 刪除工作
            $('.del_button').bind('click', this, this.del);

            // 編輯工作
            $('.edit_button').bind('click', this, this.edit);
        <?php endif; ?>

        // 變更篩選條件
        $('#fmStatus').bind('change', this, this.change_status);

        // 展開詳細資訊
        $('.jobBox').bind('click', this, this.expand_info);

        // 點選 checkbox
        $('.jobChk').bind('click', this, this.stop_bubble);
    },

    <?php if (defined('USER_ACCOUNT')): ?>
        // 編輯
        add : function(event)
        {
            $.fancybox(
            {
                'type'      : 'iframe',
                'href'      : '<?= BASE_URL ?>/form/todo_edit/index',
                'width'     : 900,
                'height'    : 500,
                'autoSize'  : false
            });

            // 取消氣泡事件
            return false;
        },

        // 編輯
        edit : function(event)
        {
            var id = this.id.split('_')[1];
            $.fancybox(
            {
                'type'      : 'iframe',
                'href'      : '<?= BASE_URL ?>/form/todo_edit/index/' + id,
                'width'     : 900,
                'height'    : 500,
                'autoSize'  : false
            });

            // 取消氣泡事件
            return false;
        },

        // 刪除
        del : function(event)
        {
            var id = this.id.split('_')[1];
            if (confirm('確定要刪除工作嗎？'))
            {
                $.get('<?= BASE_URL ?>/form/todo_edit/del/' + id, function(data)
                {
                    window.location.reload(true);
                });
            }

            // 取消氣泡事件
            return false;
        },

        // 刪除
        del_todos : function(event)
        {
            var ids = [];
            $('.jobChk').each(function()
            {
                if (this.checked)
                {
                    ids.push(this.id.split('_')[1]);
                }
            });

            if (ids.length == 0)
            {
                alert('請選擇工作！');
                return false;
            }

            if (confirm('確定要刪除工作嗎？'))
            {
                $.get('<?= BASE_URL ?>/form/todo_edit/del/' + ids.join('-'), function(data)
                {
                    window.location.reload(true);
                });
            }

            // 取消氣泡事件
            event.stopPropagation();
        },

        // 取消氣泡事件
        stop_bubble : function(event)
        {
            event.stopPropagation(); // 取消氣泡事件
        },
    <?php endif; ?>

    // 變更篩選狀態
    change_status : function(event)
    {
        event.stopPropagation(); // 取消氣泡事件
        var status = $('#fmStatus').val();
        window.location.href = "?status=" + status;
    },

    // 展開
    expand_info : function(event)
    {
        event.stopPropagation(); // 取消氣泡事件
        var todoID = this.id.split('_')[1];
        $('#jobNote_' + todoID).toggle();
    }
}

$(function()
{
    $todo_edit.page_init();

    var curr_todo_map = $('#jobs').children().map(function()
    {
        return $(this).attr('id');
    });

    <?php if (defined('USER_ACCOUNT')): ?>
    $("#jobs").sortable(
    {
        stop: function( event, ui )
        {
            var id = ui.item.attr('id');

            // 找出之前的位置
            var old_sn = $.inArray(id, curr_todo_map);

            // 找出目前的順序
            var todo_map = $('#jobs').children().map(function()
            {
                return $(this).attr('id');
            });
            var sn = $.inArray(id, todo_map);
            var todoID = id.split('_')[1];

            // 判斷是往上還是往下
            if (sn > old_sn) sn++;

            // 寫回全域變數
            curr_todo_map = todo_map;

            // 更新畫面上的順序編號
            for (var i=0, i_max=curr_todo_map.length; i<i_max; i++)
            {
                var _todoID = curr_todo_map[i].split('_')[1];
                $('#jobNo_' + _todoID).html((i+1) + '.');
            }

            // 呼叫 ajax 排序
            $.get('<?= BASE_URL ?>/form/todo_edit/sort/' + todoID + '/' + sn, function(data)
            {
                // window.location.reload(true);
            });
        }
    });
    <?php endif; ?>
});
</script>
<div id='tool_bar' class='clearfix'>
    <?php if (defined('USER_ACCOUNT')): ?>
    <div id='tool_left'><input id='fmAdd' type='button' class='button fmAdd' value='新增'></div>
    <div id='tool_left'><input id='fmDel' type='button' class='button fmDel' value='刪除'></div>
    <?php endif; ?>
    <div id='tool_right'>
        <!-- <input id='fmSearch' type='text'> -->
        <select id='fmStatus'>
            <option value='0' <?= ($status == 0) ? "selected" : "" ?> />所有工作</option>
            <option value='1' <?= ($status == 1) ? "selected" : "" ?> />未完成</option>
            <option value='2' <?= ($status == 2) ? "selected" : "" ?> />已完成</option>
            <option value='3' <?= ($status == 3) ? "selected" : "" ?> />擱置</option>
        </select>
    </div>
</div>
<?php if (count($data) == 0): ?>
    <div class='error'>尚無資料！</div>
<?php else: ?>
    <div id='jobs'>
        <?php foreach ($data as $row):?>
        <div id='jobBox_<?= $row->todoID ?>' class='jobBox clearfix'>
            <div class='jobInfo'>
                <div id='jobNo_<?= $row->todoID ?>' class='no'>
                    <input id='chk_<?= $row->todoID ?>' class='jobChk' type='checkbox' value='1'>
                    <?= $row->no ?>.
                </div>
                <div class='tools'>
                    <?php if (defined('USER_ACCOUNT')): ?>
                    <img id='edit_<?= $row->todoID ?>' class='edit_button button_icon' src='<?= BASE_URL ?>/sys/images/edit.gif'><img id='del_<?= $row->todoID ?>' class='del_button button_icon' src='<?= BASE_URL ?>/sys/images/delete.gif'>
                    <?php endif; ?>
                </div>
                <?php if ($row->status == 2): ?>
                    <div class='createTime'>完成時間: <span class='text'><?= $row->completeTime ?></span></div>
                <?php else:?>
                    <div class='createTime'>建立時間: <span class='text'><?= $row->createTime ?></span></div>
                <?php endif; ?>
                <?php if ($row->status == 1): ?>
                    <div class='due_time'>預計: <span class='text' title='{due_time}'><?= $row->due_time_short ?></span></div>
                <?php endif ?>
                <div class='surplusHours'>尚需: <span class='text'><?= $row->surplusHours ?></span> 小時</div>
                <div class='usedHours'>已工作: <span class='text'><?= $row->usedHours ?></span> 小時</div>
                <div class='hours'>估計需要: <span class='text'><?= $row->hours ?></span> 小時</div>
                <div class='title status<?= $row->status ?>'><?= $row->title ?> (<?= $status_name[$row->status] ?>)</div>
            </div>
            <div id='jobNote_<?= $row->todoID ?>' class='jobNote'><?= $row->note ?></div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (defined('USER_ACCOUNT')): ?>
<div id='tool_bar' class='clearfix'>
    <div id='tool_left'><input id='fmAdd2' type='button' class='button fmAdd' value='新增'></div>
    <div id='tool_left'><input id='fmDel2' type='button' class='button fmDel' value='刪除'></div>
</div>
<?php endif; ?>
