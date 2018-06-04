<?php

namespace App\Controller;

class PostsController extends AppController
{
  public function index()
  {
    $posts = $this->Posts->find('all');
    $this->set(compact('posts'));
    $this->loadModel('Categories');
    $categories = $this->set('categories', $this->Categories->find('all'));
    $this->loadModel('Tags');
    $tags = $this->set('tags', $this->Tags->find('all'));
  }

  public function view($id = null)
  {
  $post = $this->Posts->get($id,[
    'contain'=> ['Comments','Categories','Tags']
  ]);
  $this->set(compact('post'));
  }

  public function add()
  {
    $this->loadModel('Categories');
    $categories = $this->set('categories', $this->Categories->find('all'));
    $this->loadModel('Tags');
    $tags = $this->set('tags', $this->Tags->find('all'));

    $post = $this->Posts->newEntity();
    if($this->request->is('post')) {
      $post = $this->Posts->patchEntity($post,$this->request->getData());

      if($this->Posts->save($post)) {
        $tags = $this->request->getData("tags");
        $this->loadModel("PostsTags");

        foreach ($tags as $tag) {
          $post_tag = $this->PostsTags->newEntity();
          $post_tag->post_id = $post->id;
          $post_tag->tag_id = $tag;
          $this->PostsTags->save($post_tag);
        }

        $this->Flash->success('Add Success!');
        return $this->redirect(['action' => 'index']);

      } else {
        //error
        $this->Flash->error('Add Error!');
      }
    }
    $this->set(compact('post'));
  }

  public function edit($id = null)
  {
    $this->loadModel('Categories');
    $categories = $this->set('categories', $this->Categories->find('all'));
    $this->loadModel('Tags');
    $tags = $this->set('tags', $this->Tags->find('all'));
    $this->loadModel("PostsTags");
    $poststags = $this->set('poststags', $this->PostsTags->find('all'));

    $post = $this->Posts->get($id);
    if($this->request->is(['post','patch','put'])) {
      $post = $this->Posts->patchEntity($post,$this->request->getData());
      if($this->Posts->save($post)) {
        $tags = $this->request->getData("tags");
        /*
        $delete = $this->PostsTags->get($post_tag->post_id = $post->id);
        if($this->PostsTags->delete($delete)) {
        */
          foreach ($tags as $tag) {
            $post_tag = $this->PostsTags->newEntity();
            $post_tag->post_id = $post->id;
            $post_tag->tag_id = $tag;
            $this->PostsTags->save($post_tag);
          }
      //}

        $this->Flash->success('Edit Success!');
        return $this->redirect(['action' => 'index']);
      } else {
        //error
        $this->Flash->error('Edit Error!');
      }
    }
    $this->set(compact('post'));
  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post','delete']);
    $post = $this->Posts->get($id);
      if($this->Posts->delete($post)) {
        $this->Flash->success('Delete Success!');
      } else {
        //error
        $this->Flash->error('Delete Error!');
      }
    return $this->redirect(['action' => 'index']);
  }
}
