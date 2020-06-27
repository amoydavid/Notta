<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Policies;

use App\Models\Group;
use App\Models\PermissionAssignment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * 项目策略
 *
 * @package App\Policies
 */
class ProjectPolicy
{
    use HandlesAuthorization, GroupHasProjectPrivilege;

    /**
     * 项目配置修改权限
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function setting($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        return $user->isAdmin() || $this->isOwner($user, $project);
    }

    /**
     * 项目查看权限
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function view($user, $project)
    {
        $project = $this->getProject($project);
        if ($project->visibility == Project::VISIBILITY_PUBLIC) {
            return true;
        }

        if (empty($user)) {
            return false;
        }

        return $user->isAdmin()
            || $this->isOwner($user, $project)
            || $this->groupHasProjectPrivilege($project, $user, Project::PRIVILEGE_RO)
            || $this->hasReadPermission($user, $project)
            ;
    }

    /**
     *
     *  用户是否可以评论项目下的文档
     *
     * @param User|null $user
     * @param Project   $project
     *
     * @return bool
     */
    public function comment($user, $project)
    {
        $canView = $this->view($user, $project);
        if (!$canView) {
            return false;
        }

        if (empty($user)) {
            return false;
        }

        /**
         * 第三方用户不可评论
         */
        if($user->role == User::ROLE_EXT) {
            return false;
        }

        return $user->isActivated();
    }

    /**
     * 新增页面权限
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function addPage($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        // 管理员
        if ($user->isAdmin()) {
            return true;
        }

        // 项目创建者
        if ($this->isOwner($user, $project)) {
            return true;
        }

        $project = $this->getProject($project);
        return $this->groupHasProjectPrivilege($project, $user);
    }


    /**
     * 编辑项目信息权限
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function edit($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        return $user->isAdmin() || $this->isOwner($user, $project);
    }

    /**
     * 项目删除权限检查
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function delete($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        return $user->isAdmin() || $this->isOwner($user, $project);
    }

    /**
     * 检查用户是否有创建项目权限
     *
     * @param User|null $user
     *
     * @return bool
     */
    public function create(User $user = null)
    {
        if (empty($user)) {
            return false;
        }

        return $user->isActivated();
    }

    /**
     * 项目排序权限
     *
     * @param User|null $user
     * @param Project   $project
     *
     * @return bool
     */
    public function sortLevel(User $user = null, $project = null)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        return $user->isAdmin();
    }

    /**
     * 是否是项目的创建者
     *
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    private function isOwner($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }

        $project = $this->getProject($project);

        return (int)$user->id === (int)$project->user_id;
    }

    private function getProject($project): Project
    {
        if (!$project instanceof Project) {
            $project = Project::where('id', $project)->firstOrFail();
        }

        return $project;
    }


    /**
     * 是否可读项目
     * @param User $user
     * @param Project $project
     * @return bool
     */
    private function hasReadPermission($user, $project)
    {
        if (empty($user) || !$user->isActivated()) {
            return false;
        }
        $project = $this->getProject($project);

        return PermissionAssignment::valid($user, $project);
    }
}
