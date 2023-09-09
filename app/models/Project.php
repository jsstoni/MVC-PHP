<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

require_once("./src/DataBase.php");

class Project extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $keyType = "int";
    protected $fillable = ["name"];
}
