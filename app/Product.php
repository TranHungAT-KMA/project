<?php
  
namespace App;
  
use Illuminate\Database\Eloquent\Model;
   
class Product extends Model
{
    protected $fillable = [
        'name', 'detail'
    ];

    public function users(){
    	return $this->belongsTo('App\user');
    }
}
//