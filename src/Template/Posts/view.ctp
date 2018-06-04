<?php
$this->assign('title','Blog Detail');
 ?>

<h1>
  <?= $this->Html->link('Back',['action'=>'index'],['class'=>['pull-right'.'fs12']]);?>
  <?= nl2br(h($post->title));?>
</h1>

<p><?= h($post->body);?></p>

<h2> Categories <span class="fs12"></span></h2>

<p>
  <?= $this->Html->link($post->category->name,
    ['controller'=>'Categories','action'=>'view',$post->category_id],
    ['class'=>['pull-right'.'fs12']]); ?>
</p>

<p>
  <?php foreach ($post->tags as $tag) :?>
    <?= $this->Html->link($tag->name,
      ['controller'=>'Tags','action'=>'view',$tag->id],
      ['class'=>['pull-right'.'fs12']]); ?>
  <?php endforeach; ?>
</p>

<h2> Images <span class="fs12"></span></h2>
<ul>
  <?php foreach ((array)$post->image as $image) :?>
    <li>
      <?= $this->Html->image($image,array()); ?>
      <?=
        $this->Form->postlink(
          '[x]',
          ['controller'=>'Posts', 'action'=>'delete',$post->id],
          ['confirm'=>'Are you sure?','class' =>'fs12']
        );
      ?>
    </li>
  <?php endforeach; ?>
</ul>

<?php if (count($post->comments)) : ?>
<h2>Comments <span class="fs12">(<?= count($post->comments); ?>)</span></h2>
<ul>
  <?php foreach($post->comments as $comment) :?>
    <li>
      <?= h($comment->body); ?>
      <?=
        $this->Form->postlink(
          '[x]',
          ['controller'=>'Comments', 'action'=>'delete',$comment->id],
          ['confirm'=>'Are you sure?','class' =>'fs12']
        );
      ?>
    </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>

<h2>New Comment</h2>
<?= $this->Form->create(null,['url'=>['controller'=>'Comments','action'=>'add']]); ?>
<?= $this->Form->input('body'); ?>
<?= $this->Form->hidden('post_id',['value'=>$post->id]); ?>
<?= $this->Form->button('Add'); ?>
<?= $this->Form->end(); ?>
