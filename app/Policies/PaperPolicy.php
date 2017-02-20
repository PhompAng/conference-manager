<?php

namespace App\Policies;

use App\User;
use App\Model\Paper;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaperPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        switch ($ability) {
            case 'review':
                break;
            case 'assign':
                break;
            default:
                if ($user->role >= 2) {
                    return true;
                }
        }
    }

    /**
     * Determine whether the user can view the paper.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Paper  $paper
     * @return mixed
     */
    public function view(User $user, Paper $paper)
    {
        return $user->id == $paper->user->id;
    }

    /**
     * Determine whether the user can create papers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the paper.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Paper  $paper
     * @return mixed
     */
    public function update(User $user, Paper $paper)
    {
        return $user->id == $paper->user->id;
    }

    /**
     * Determine whether the user can delete the paper.
     *
     * @param  \App\User  $user
     * @param  \App\Model\Paper  $paper
     * @return mixed
     */
    public function delete(User $user, Paper $paper)
    {
        return $user->id == $paper->user->id;
    }

    public function view_review(User $user, Paper $paper) {
        return $user->id == $paper->user->id;
    }

    public function review(User $user, Paper $paper) {
        return $paper->reviewers->contains('id', $user->id) && $paper->status != 'withdraw';
    }

    public function assign(User $user, Paper $paper) {
        return $user->role == 3 && $paper->status != 'withdraw';
    }
}
