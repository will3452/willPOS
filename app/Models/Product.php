<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 7, 'prefix' =>'P-']);
        });
    }
}
