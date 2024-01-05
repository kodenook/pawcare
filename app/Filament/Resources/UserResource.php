<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\PetsRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->autofocus()
                    ->required()->alpha()->maxLength(25),
                Forms\Components\TextInput::make('last_name')
                    ->autofocus()
                    ->required()->alpha()->maxLength(25),
                Forms\Components\TextInput::make('email')
                    ->autofocus()
                    ->required()->maxLength(255)->email()->unique()
                    ->prefixIcon('heroicon-m-envelope'),
                Forms\Components\TextInput::make('phone')
                    ->autofocus()
                    ->required()->maxLength(15)->tel()
                    ->prefixIcon('heroicon-m-phone'),
                Forms\Components\TextInput::make('password')
                    ->autofocus()
                    ->nullable()->maxLength(255)->password()
                    ->prefixIcon('heroicon-m-key')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->formatStateUsing(fn (string $state): string => '+' . trim(strrev(chunk_split(strrev($state), 4, ' ')))),
            ])
            ->defaultSort(
                function ($query) {
                    $query->select('id', 'first_name', 'last_name', 'email', 'phone');
                    $query->addSelect(DB::raw('concat(first_name, " ", last_name) as full_name'));
                    $query->orderBy('full_name');
                }
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PetsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit')
        ];
    }
}
