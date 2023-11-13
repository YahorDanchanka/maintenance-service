<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpertResource\Pages;
use App\Filament\Resources\ExpertResource\RelationManagers;
use App\Models\Expert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExpertResource extends Resource
{
    protected static ?string $model = Expert::class;
    protected static ?string $navigationIcon = 'healthicons-f-factory-worker';
    protected static ?string $modelLabel = 'Специалист';
    protected static ?string $pluralModelLabel = 'Специалисты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->label('Имя'),
                Forms\Components\TextInput::make('surname')->required()->maxLength(255)->label('Фамилия'),
                Forms\Components\TextInput::make('patronymic')->maxLength(255)->label('Отчество'),
                Forms\Components\Select::make('rank')->required()->label('Разряд')->options([
                    '1' => 'Первый',
                    '2' => 'Второй',
                    '3' => 'Третий',
                    '4' => 'Четвёртый',
                ]),
                Forms\Components\DatePicker::make('hire_date')->required()->maxDate(now())->label('Дата принятия на работу'),
                Forms\Components\TextInput::make('phone')->maxLength(255)->label('Телефон'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя')->sortable(),
                Tables\Columns\TextColumn::make('surname')->label('Фамилия')->sortable(),
                Tables\Columns\TextColumn::make('patronymic')->label('Отчество')->sortable(),
                Tables\Columns\TextColumn::make('rank')->label('Разряд')->sortable(),
                Tables\Columns\TextColumn::make('hire_date')->label('Дата принятия на работу')->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Телефон')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListExperts::route('/'),
            'create' => Pages\CreateExpert::route('/create'),
            'edit' => Pages\EditExpert::route('/{record}/edit'),
        ];
    }
}
