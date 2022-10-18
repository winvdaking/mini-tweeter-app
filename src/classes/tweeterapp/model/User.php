<?php

namespace iutnc\tweeterapp\model;

class User extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'user';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */
                                          
       public function tweets(){
              return $this->hasMany('iutnc\tweeterapp\model\Tweet', 'author');
       }
}
