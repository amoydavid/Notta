<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Page
 *
 * @property integer                                                                      $id
 * @property integer                                                                      $pid
 * @property string                                                                       $title
 * @property string                                                                       $description
 * @property string                                                                       $content
 * @property integer                                                                      $project_id
 * @property integer                                                                      $user_id
 * @property integer                                                                      $last_modified_uid
 * @property integer                                                                      $history_id
 * @property integer                                                                      $type
 * @property integer                                                                      $status
 * @property integer                                                                      $sort_level
 * @property string                                                                       $sync_url
 * @property Carbon                                                                       $last_sync_at
 * @property Carbon                                                                       $created_at
 * @property Carbon                                                                       $updated_at
 * @package App\Repositories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[]    $comments
 * @property-read \App\Models\User                                                  $lastModifiedUser
 * @property-read \App\Models\Document                                              $parentPage
 * @property-read \App\Models\Project                                               $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[]   $subPages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[]        $tags
 * @property-read \App\Models\User                                                  $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document withoutTrashed()
 * @mixin \Eloquent
 * @property \Carbon\Carbon|null                                                          $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereLastModifiedUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereUserId($value)
 * @property-read int|null $attachments_count
 * @property-read int|null $comments_count
 * @property-read int|null $sub_pages_count
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereLastSyncAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereSortLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Document whereSyncUrl($value)
 */
	class Document extends \Eloquent {}
}

namespace App\Models{
/**
 * 项目目录
 *
 * @package App\Repositories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \App\Models\User                                               $user
 * @property int                                                                       $id
 * @property string                                                                    $name         项目目录名称
 * @property int                                                                       $sort_level   排序，排序值越大越靠后
 * @property int                                                                       $user_id      创建用户ID
 * @property int                                                                       $show_in_home 是否在首页展示
 * @property \Carbon\Carbon|null                                                       $created_at
 * @property \Carbon\Carbon|null                                                       $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereSortLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereUserId($value)
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereShowInHome($value)
 */
	class Catalog extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read int|null $projects_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group query()
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @property integer                                                                                                        $id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $password
 * @property integer                                                                                                        $role
 * @property integer                                                                                                        $status
 * @property string                                                                                                         $objectguid
 * @property Carbon                                                                                                         $created_at
 * @property Carbon                                                                                                         $updated_at
 * @package App\Repositories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[]                                      $favoriteProjects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[]                                        $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocumentHistory[]                              $histories
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[]                                     $pages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[]                                      $projects
 * @mixin \Eloquent
 * @property string                                                                                                         $email
 * @property string|null                                                                                                    $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @property-read int|null $favorite_projects_count
 * @property-read int|null $groups_count
 * @property-read int|null $histories_count
 * @property-read int|null $notifications_count
 * @property-read int|null $pages_count
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereObjectguid($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageTag query()
 */
	class PageTag extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read int|null $attachments_count
 * @property-read int|null $favorite_users_count
 * @property-read int|null $groups_count
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereLastSyncAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereSortLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentHistory whereSyncUrl($value)
 */
	class DocumentHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Comment
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $user_id
 * @property string  $content
 * @property integer $reply_to_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 * @package App\Repositories
 * @property-read \App\Models\Document $document
 * @property-read \App\Models\Comment $replyComment
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereReplyToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Template
 *
 * @property integer $id
 * @property string  $name
 * @property string  $description
 * @property string  $content
 * @property string  $user_id
 * @property string  $type
 * @property string  $status
 * @property string  $scope
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @package App\Repositories
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template query()
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Widget
 *
 * @property string $name
 * @property string $ref_id
 * @property integer $type
 * @property string $description
 * @property string $content
 * @property integer $user_id
 * @property integer $operator_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Repositories
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereRefId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Widget whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withoutTrashed()
 */
	class Widget extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Attachment
 *
 * @property integer $id
 * @property string  $name
 * @property string  $path
 * @property integer $page_id
 * @property integer $project_id
 * @property integer $user_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 * @package App\Repositories
 * @property-read \App\Models\Document $page
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attachment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attachment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attachment withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attachment query()
 */
	class Attachment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Repositories\OperationLogs
 *
 * @property mixed $context
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id 操作用户ID
 * @property string|null $message 日志消息内容
 * @property string $created_at 创建时间
 * @property int|null $project_id 关联的项目ID
 * @property int|null $page_id 关联的文档ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLogs query()
 */
	class OperationLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SocialAccount
 *
 * @property int $id
 * @property int $user_id 用户
 * @property string $provider 来源
 * @property string $provider_id 来源id
 * @property string $token
 * @property string $avatar 头像
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereUserId($value)
 */
	class SocialAccount extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageShare query()
 */
	class PageShare extends \Eloquent {}
}

