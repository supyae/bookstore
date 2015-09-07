<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

	public  $table = 'genres';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['type'];

//
//    public function getByOrder(){
//        $genres = $this->orderBy('type','ASC')->get();
//
//        return $genres;
//    }

}
