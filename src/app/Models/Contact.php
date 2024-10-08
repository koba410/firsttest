<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tell',
        'address',
        'building',
        'detail',
    ];

    public function category() {
        return $this->belongsTo( Category::class, 'category_id' );
    }

    public function getGenderAttribute( $value ) {
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        return $genders[ $value ] ?? '不明';
    }

}
