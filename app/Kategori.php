<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $fillable=['nama'];

    public function barangs()
    {
    	return $this->hasMany('App\Barang');
    }
}
