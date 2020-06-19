<?php

namespace App\Models;

/**
 * Class Tag
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $tag_id
 * @package App\Repositories
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag whereTagId($value)
 */
class PageTag extends BaseModel
{
    protected $table = 'page_tag';
    public $timestamps = false;
    protected $fillable = ['page_id', 'tag_id'];
}