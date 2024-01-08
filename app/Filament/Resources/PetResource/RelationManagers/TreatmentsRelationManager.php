<?php

namespace App\Filament\Resources\PetResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->autofocus()
                    ->required()->string()->maxLength(255),
                Forms\Components\RichEditor::make('prescription')
                    ->autofocus()
                    ->required()->string()
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->default(Carbon::today()->subDays(30)),
                        Forms\Components\DatePicker::make('created_until')
                            ->default(Carbon::today())
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query): Builder => $query->whereDate('created_at', '>=', Carbon::today()->subDays(30))
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query): Builder => $query->whereDate('created_at', '<=', Carbon::today())
                            );
                    })
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make('show')
            ])
            ->bulkActions([
                //
            ]);
    }
}
