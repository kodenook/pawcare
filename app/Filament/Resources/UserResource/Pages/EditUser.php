<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    /**
     * The function `getHeaderActions` returns an array of actions, including a delete action, if there
     * are more than one users and the authenticated user is not the same as the current record.
     *
     * @return array An array of header actions.
     */
    protected function getHeaderActions(): array
    {
        $response = [];

        $total_users = User::get('id')->count();

        if ($total_users > 1 && Auth::Id() !== $this->record->id) {
            array_push(
                $response,
                Actions\DeleteAction::make()
            );
        }
        return $response;
    }
}
