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
 * Class DocumentHistory
 *
 * @property integer                     $id
 * @property integer                     $page_id
 * @property integer                     $pid
 * @property string                      $title
 * @property string                      $description
 * @property string                      $content
 * @property integer                     $project_id
 * @property integer                     $user_id
 * @property string                      $type
 * @property string                      $status
 * @property integer                     $sort_level
 * @property string                      $sync_url
 * @property Carbon                      $last_sync_at
 * @property integer                     $operator_id
 * @property string                      $created_at
 * @property string                      $updated_at
 * @package App\Repositories
 * @property-read \App\Models\User $operator
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereUserId($value)
 */
class DocumentHistory extends BaseModel
{
    protected $table = 'page_histories';
    protected $fillable
        = [
            'page_id',
            'pid',
            'title',
            'description',
            'content',
            'project_id',
            'user_id',
            'type',
            'status',
            'operator_id',
            'sort_level',
            'sync_url',
            'last_sync_at',
        ];

    /**
     * 记录文档历史
     *
     * @param Document $document
     *
     * @return DocumentHistory
     */
    public static function write(Document $document): DocumentHistory
    {
        $history = self::create(array_only(
                $document->toArray(),
                (new static)->fillable) + [
                'operator_id' => $document->last_modified_uid,
                'page_id'     => $document->id,
            ]
        );

        $document->history_id = $history->id;
        $document->save();

        return $history;
    }

    /**
     * 文档所属用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 记录操作用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }
}