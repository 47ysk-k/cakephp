<?php
$this->assign('title','Tag Posts');
?>

<h1>
  <?=$this->Html->link('Top Page',['controller'=>'posts','action'=>'index'],
    ['class'=>['pull-right','fs12']]);?>
  Tag Posts
  <?=$tag->name?>
</h1>

<ul>
  <?php foreach ($tag->posts as $post) :?>
    <li>
      <?= $this->Html->link($post->title,
          ['controller'=>'posts','action'=>'view',$post->id]);?>
      <?= $this->Html->image($post->image,array()); ?>
    </li>
  <?php endforeach;?>
</ul>
