<?php
$this->assign('title','Add New');
?>

<h1>
  <?= $this->Html->link('Back',['action'=>'index'],['class'=>['pull-right'.'fs12']]);?>
  Add New
</h1>

<?= $this->Form->create($post); ?>

<?php foreach ($tags as $tag) :?>
    <input type="checkbox" name="tags[]" value="<?= $tag->id?>">
    <?= h($tag->name)?><br>
<?php endforeach; ?>

<select name="category_id">
  <?php foreach ($categories as $category) :?>
    <option value="<?= $category->id ?>">
      <?= h($category->name);?>
    </option>
  <?php endforeach; ?>
</select>

<?= $this->Form->input('title'); ?>
<?= $this->Form->input('image'); ?>
<?= $this->Form->input('body',['rows'=>'3']); ?>
<?= $this->Form->button('Add'); ?>
<?= $this->Form->end(); ?>
