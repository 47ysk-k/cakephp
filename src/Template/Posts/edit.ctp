<?php
$this->assign('title','Edit Post');
 ?>

<h1>
  <?= $this->Html->link('Back',['action'=>'index'],['class'=>['pull-right'.'fs12']]);?>
  Edit Post
</h1>

<?= $this->Form->create($post); ?>

<?php foreach ($tags as $tag) :?>
    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>">
    <?= h($tag->name)?>
<?php endforeach; ?>

<select name="category_id">
  <?php foreach ($categories as $category) :?>
    <option value="<?= $category->id ?>"
        <?= $category->id == $post->category_id ? "selected" : ""?>>
      <?= h($category->name);?>
    </option>
  <?php endforeach; ?>
</select>

<?= $this->Form->input('title'); ?>
<?= $this->Form->input('image'); ?>
<?= $this->Form->input('body',['rows'=>'3']); ?>
<?= $this->Form->button('Update'); ?>
<?= $this->Form->end(); ?>

<div id="result"></div>
<span style="color: red;" id="send-item-error"></span>

本文：<input type="text" name="content" placeholder="本文" id="<?= $post->id?>">
<button type="button" id="add_item">保存</button>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>

// ドキュメントが読み込まれた際
$(document).ready(function(){
    // 送信ボタンを押したら sendComment() を実行
    $('input#add_item').click(function(){
        sendItem();
    });
    // 既存のコメントを読み込んで表示
    getItem();
});
// コメント送信（書き込み）
function sendItem() {
    // 未入力チェック
    if (!$('input[content=content]').val()) {
        $('#send-item-error').text('コメントを入力して下さい。');
        return false;
    }

    $.post(
        //'正しいコントローラーのパス',
        {
            'content': $('input[content=content]').val(
        },
        function(data){
            // 書き込みが完了したら再度コメント一覧を読み込む
            getItem();
        }
    );
}
// コメント一覧受信・表示
function getItem() {
    $.get(
        'comment_get.php',
        null,
        function(data){
            // コメントリスト
            $('#comment-list').html('');
            var json = JSON.parse(data);
            if (json.length >= 1) {
                var str;
                for (var i = 0, len = json.length; i < len; i++) {
                    str = json[i]['name'] + 'さん　' + json[i]['comment'];
                    $('#comment-list').append($('<p/>').text(str));
                }
                $('.comment-list-set').show();
            }
        }
    );
}

/*
$(document).on('click','.add_item', function() {

    var post_id = ;
    var content = ;
    $.ajax(
        {
            type: "POST",
            url: "/items/add",
            data: {
                "post_id": post_id,
                "content": content
            },
            dataType: "text",
            success: function (dom)
            {
                //保存完了
                //ここで、返り値（dom）を描画する
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                alert('処理できませんでした');
            }
        });

});
*/
</script>
