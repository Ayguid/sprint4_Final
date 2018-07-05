<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRelationship extends Model
{

    protected $table = 'user_relationship';

    public $timestamps = false;


    public function relative(){
        return $this->belongsTo('App\Models\User', 'related_user_id');
    }

    public function main(){
        return $this->belongsTo('App\Models\User', 'main_user_id');
    }

    public function getAllow(){
        return $this->allow;
    }

    public function getType(){
        if ($this->relation_type == 0){
            return "Amigo";
        }else if($this->relation_type == 1){
            return "Mejor Amigo";
        }else if($this->relation_type == 2){
            return "Familiar";
        }else if($this->relation_type == 3){
            return "No me caes bien";
        }else if($this->relation_type == 4){
            return "Chongo/a";
        }else{
            return "Conocido";
        }
    }
}
