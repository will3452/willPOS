<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function getPublicImageAttribute(){
        if($this->image == '/noimage.jpg') return $this->image;
        $data = explode('/', $this->image);
        $end = end($data);
        return '/storage/product/'.$end;
    }
}
