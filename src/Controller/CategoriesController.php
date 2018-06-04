<?php

namespace App\Controller;

class CategoriesController extends AppController
{

  public function view($id)
  {
  // $post = $this->Posts->get($id);
  $category = $this->Categories->get($id,['contain'=>'Posts']);
  $this->set(compact('category'));
  }

}
