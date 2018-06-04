<?php

namespace App\Controller;

class PostsController extends AppController
{

  public function index()
  {
    $this->set('ajax_name','send_date.js');
  }

  public function add()
  {
    $data = $this->request->data('request');
    $connection = ConnectionManager::get('default');
    $connection->insert('data', [ 'text' => $data ]);
  }

}
