<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Task;
use app\Models\User;
class Project extends Model
{
    use HasFactory;
    public $fillable=[
        "name","description","created_by"


    ];
    public function user(){

        return $this->belongsTo(User::class,"created_by");

    }
public function tasks(){
        return $this->hasMany(Task::class,"project_id");
}


}
