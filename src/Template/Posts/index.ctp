<?php
$this->assign('title','Blog Posts');
 ?>

<h1>
  <?=$this->Html->link('Add New',['action'=>'add'],['class'=>['pull-right','fs12']]);?>
  Blog Posts
</h1>

<p>カテゴリーで探す</p>
  <?php foreach ($categories as $category) :?>
    <a>
      <?= $this->Html->link($category->name,
        ['controller'=>'Categories','action'=>'view',$category->id]);?>
    </a>
  <?php endforeach;?>

<p>タグで探す</p>
  <?php foreach ($tags as $tag) :?>
    <a>
      <?= $this->Html->link($tag->name,
        ['controller'=>'Tags','action'=>'view',$tag->id]);?>
    </a>
  <?php endforeach;?>

<ul>
  <?php foreach ($posts as $post) :?>
    <li>
      <?= $this->Html->link($post->title,['action'=>'view',$post->id]);?>
      <?= $this->Html->image($post->image,array()); ?>

      <?= $this->Html->link('[Edit]',['action'=>'edit',$post->id],['class'=>'fs12']);?>
      <?=
        $this->Form->postlink(
          '[x]',
          ['action'=>'delete',$post->id],
          ['confirm'=>'Are you sure?','class' =>'fs12']
        );
      ?>
    </li>
  <?php endforeach;?>
</ul>
