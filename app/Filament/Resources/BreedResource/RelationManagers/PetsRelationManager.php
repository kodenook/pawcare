<?php

namespace App\Filament\Resources\BreedResource\RelationManagers;

use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class PetsRelationManager extends RelationManager
{
    protected static string $relationship = 'pets';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->autofocus()
                    ->required()->string()->maxLength(50),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'full_name', function ($query) {
                        $query->select('id', 'first_name', 'last_name');
                        $query->addSelect(DB::raw('concat(first_name, " ", last_name) as full_name'));
                        $query->orderBy('full_name');
                    })
                    ->searchable()->preload(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.full_name')
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('type.name')
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->relationship('type', 'name')
                    ->searchable()->preload()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                //
            ]);
    }
}
