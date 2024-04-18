<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;
use app\Models\Project;
class Task extends Model
{
    use HasFactory;
    public $fillable=[
       "title","description","due_date","priority","status","project_id","created_by"


    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
//    public function user(){
//
//
//        return $this->belongsToMany(User::class);
//    }




}
