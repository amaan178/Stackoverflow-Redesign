<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function update(User $user, Question $question)
    {
        return $user->id === $question->user_id;
    }

    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id;
    }

    public function __construct()
    {
        //
    }

    public function markAsFavorite(User $user, Question $question)
    {
        return $user->id != $question->user_id;
    }
}
