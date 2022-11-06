<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    const TYPE_TEXT = 'TEXT';
    const TYPE_IMAGE = 'IMAGE';
    const TYPE_URL = 'URL';
    const TYPE_MULTI_IMAGE = 'MULTI_IMAGE';

    protected $fillable = [
        'content_name', // not editable
        'content',
        'type', //text, image (store), image (url),
        'sort',
    ];

    protected $appends = ['image_url', 'multi_images'];

    public function getImageUrlAttribute()
    {
        return [
            self::TYPE_IMAGE => asset($this->content),
            self::TYPE_MULTI_IMAGE => function () {
                $contents = json_decode($this->content);
                if (is_array($contents->images)) {
                    return asset($contents->images[0]->url);
                }
                return '';
            },
            self::TYPE_TEXT => '',
            self::TYPE_URL => ''
        ][$this->type];
    }

    public function getMultiImagesAttribute()
    {
        if ($this->type == self::TYPE_MULTI_IMAGE) {
            $contents = json_decode($this->content);
            if (is_array($contents->images)) {
                return $contents->images;
            }
        }
        return [];
    }
}
