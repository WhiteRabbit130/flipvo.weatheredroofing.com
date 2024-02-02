<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class House extends Model
{
    use HasFactory;
    protected $fillable = ['title','user_id','address','status','description','selectedImage','specification'];
    protected $casts = [
        'specification' => 'json',
        'address' => 'json'
    ];
    protected $appends = [
        'images'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getImagesAttribute(): array
    {
        $files = Storage::disk('public')->files('users/user_'.$this->user_id.'/houses/house_'.$this->id);

        return $files;
    }
}
