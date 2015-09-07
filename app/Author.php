<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;

class Author extends Model {

	//
    public $table = 'authors';
    //public $primaryKey = 'id';
    public $timestamps = true;
    public $fillable = ['name'];



}
