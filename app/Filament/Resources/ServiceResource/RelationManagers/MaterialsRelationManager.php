<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'materials';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Название'),
            Forms\Components\TextInput::make('pivot_count')
                ->numeric()
                ->required()
                ->minValue(1)
                ->label('Количество'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('Состав')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название'),
                Tables\Columns\TextColumn::make('pivot.count')->label('Количество'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->form(
                    fn(Tables\Actions\AttachAction $action) => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('count')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->label('Количество'),
                    ]
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->using(function ($record, array $data) {
                    $record->update($data);
                    $record->pivot->update(
                        collect($data)
                            ->filter(fn($value, $key) => str_starts_with($key, 'pivot_'))
                            ->mapWithKeys(function ($value, $key) {
                                return [str_replace('pivot_', '', $key) => $value];
                            })
                            ->toArray()
                    );
                    return $record;
                }),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
