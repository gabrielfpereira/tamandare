<?php

namespace App\Policies;

use App\Models\{Record, User};

class RecordPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Record $record): bool
    {
        return $user->id === $record->user->id;
    }

}
