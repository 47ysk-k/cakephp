<?php

namespace App\Controller;

class TagsController extends AppController
{

  public function view($id)
  {
  // $post = $this->Posts->get($id);
  $tag = $this->Tags->get($id,['contain'=>'Posts']);
  $this->set(compact('tag'));
  }

}
