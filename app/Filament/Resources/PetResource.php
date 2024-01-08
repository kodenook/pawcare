<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'tni-paw';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.full_name')
                    ->searchable(['first_name', 'last_name']),
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
            RelationManagers\TreatmentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit')
        ];
    }
}
