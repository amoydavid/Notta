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
 * Class Group
 *
 * @property integer $id
 * @property string  $name
 * @property integer $user_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @package App\Repositories
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereUserId($value)
 */
class Group extends BaseModel
{
    protected $table = 'groups';
    protected $fillable
        = [
            'name',
            'user_id',
        ];

    /**
     * 分组包含的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group_ref', 'group_id', 'user_id');
    }

    /**
     * 分组创建者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 分组包含的项目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_group_ref', 'group_id', 'project_id')
            ->withPivot('created_at', 'updated_at', 'privilege');
    }
}