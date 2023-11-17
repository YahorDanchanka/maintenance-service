<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;
    protected static ?string $navigationIcon = 'bi-nut';
    protected static ?string $modelLabel = 'Материал';
    protected static ?string $pluralModelLabel = 'Материалы';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Название'),
            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required()
                ->minValue(1)
                ->label('Цена за шт.'),
            Forms\Components\TextInput::make('count')
                ->numeric()
                ->required()
                ->minValue(1)
                ->label('Количество'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена за шт.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('count')
                    ->label('Количество на складе')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
