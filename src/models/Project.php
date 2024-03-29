<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

require_once("./src/utils/DataBase.php");

class Project extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $keyType = "int";
    protected $fillable = ["name"];
}
