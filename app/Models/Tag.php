<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Class Tag
 *
 * @property integer $id
 * @property string  $name
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @package App\Repositories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $pages
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 */
class Tag extends BaseModel
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    /**
     * 标签的页面
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Document::class, 'page_tag', 'tag_id', 'page_id');
    }
}