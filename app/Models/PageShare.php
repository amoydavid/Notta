<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class PageShare
 *
 * @property string  $code
 * @property integer $project_id
 * @property integer $page_id
 * @property integer $user_id
 * @property Carbon  $expired_at
 * @package App\Repositories
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare whereUserId($value)
 */
class PageShare extends BaseModel
{
    protected $table = 'page_share';
    protected $fillable
        = [
            'code',
            'project_id',
            'page_id',
            'user_id',
            'expired_at',
        ];
}