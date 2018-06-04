<?php

 namespace App\Model\Table;

 use Cake\ORM\Table;
 use Cake\ORM\TableRegistry;
 use Cake\Validation\Validator;

 class PostsTable extends Table
 {
   public function initialize(array $config)
   {
     $this->addBehavior('Timestamp');
     $this->hasMany('Comments',[
       'dependent'=>true
     ]);
     $this->belongsTo('Categories',[
       'dependent'=>true
     ]);
     $this->belongsToMany('Tags', [
            'joinTable' => 'posts_tags',
     ]);
   }

   public function validationDefault(Validator $validator)
   {
     $validator
     ->notEmpty('title')
     ->requirePresence('title')
     ->notEmpty('image')
     ->requirePresence('image')
     ->notEmpty('body')
     ->requirePresence('body')
     ->add('body',[
       'length' =>[
         'rule' =>['minLength',10],
         'message' =>'body length must be 10+'
       ]
     ]);
     return $validator;
  }

 }
