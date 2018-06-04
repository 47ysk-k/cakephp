<?php
$this->assign('title','Category Posts');
?>

<h1>
  <?=$this->Html->link('Top Page',['controller'=>'posts','action'=>'index'],
    ['class'=>['pull-right','fs12']]);?>
  Category Posts
  <?=$category->name?>
</h1>

<ul>
  <?php foreach ($category->posts as $post) :?>
    <li>
      <?= $this->Html->link($post->title,
          ['controller'=>'posts','action'=>'view',$post->id]);?>
      <?= $this->Html->image($post->image,array()); ?>
    </li>
  <?php endforeach;?>
</ul>
