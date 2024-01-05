<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Breed;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

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
                Forms\Components\Select::make('type_id')
                    ->relationship('type', 'name')
                    ->live()->searchable()->preload()
                    ->required()->exists(Type::class, 'id'),
                Forms\Components\Select::make('breed_id')
                    ->relationship('breed', 'name')
                    ->options(fn (Get $get): Collection => Breed::query()
                        ->where('type_id', $get('type_id'))
                        ->pluck('name', 'id'))
                    ->in(fn (Select $component): array => array_keys($component->getEnabledOptions()))
                    ->searchable()->preload()
                    ->exists(Breed::class, 'id')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.name'),
                Tables\Columns\TextColumn::make('breed.name')
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->relationship('type', 'name')
                    ->searchable()->preload(),
                Tables\Filters\SelectFilter::make('breed')
                    ->relationship('breed', 'name')
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
