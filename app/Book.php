<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
   <?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    public $table = 'books';
    protected $primaryKey = 'id';
    public  $timestamps = true;
    protected $fillable = ['title','description','authorId','genreId','pubHouse','doj'];
    // model relationship with author;
    public function author(){
        return $this->belongsTo('App\Author','authorId');
    }
    //model relationship with genre;
    public function genre(){
        return $this->belongsTo('App\Genre','genreId');
    }

}
