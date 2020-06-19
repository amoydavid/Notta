<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Repositories\Project
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read \App\Models\Catalog $catalog
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $favoriteUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $pages
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 项目名称
 * @property string|null $description 项目描述
 * @property int $visibility 可见性
 * @property int $user_id 创建用户ID
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $sort_level 项目排序，排序值越大越靠后
 * @property int|null $catalog_id 目录ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCatalogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereSortLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereVisibility($value)
 */
class Project extends BaseModel
{

    use SoftDeletes;

    /**
     * 公开项目
     */
    const VISIBILITY_PUBLIC = '1';
    /**
     * 私有项目
     */
    const VISIBILITY_PRIVATE = '2';

    /**
     * 读写
     */
    const PRIVILEGE_WR = 1;
    /**
     * 只读
     */
    const PRIVILEGE_RO = 2;

    protected $table = 'projects';
    protected $fillable
        = [
            'name',
            'description',
            'visibility',
            'user_id',
            'sort_level',
            'catalog_id',
        ];

    public $dates = ['deleted_at'];

    /**
     * 项目下的所有页面
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * 项目所属的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 项目所属的分组
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'project_group_ref', 'project_id', 'group_id')
            ->withPivot('created_at', 'updated_at', 'privilege');
    }

    /**
     * 关注该项目的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'project_stars', 'project_id', 'user_id');
    }

    /**
     * 项目下所有的附件
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'project_id', 'id');
    }

    /**
     * 项目所属的目录
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id', 'id');
    }

    /**
     * 判断是否用户关注了该项目
     *
     * @param User $user
     *
     * @return bool
     */
    public function isFavoriteByUser(User $user = null)
    {
        if (empty ($user)) {
            return false;
        }

        return $this->favoriteUsers()->wherePivot('user_id', $user->id)->exists();
    }
}