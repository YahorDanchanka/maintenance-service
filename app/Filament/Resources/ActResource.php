<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActResource\Pages;
use App\Filament\Resources\ActResource\RelationManagers;
use App\Models\Act;
use App\Models\Expert;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ActResource extends Resource
{
    protected static ?string $model = Act::class;
    protected static ?string $navigationIcon = 'akar-paper';
    protected static ?string $modelLabel = 'Акт';
    protected static ?string $pluralModelLabel = 'Акты';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Название'),
            Forms\Components\TextInput::make('address')
                ->required()
                ->maxLength(255)
                ->label('Адрес'),
            Forms\Components\DatePicker::make('date')
                ->required()
                ->maxDate(now())
                ->label('Дата'),
            Forms\Components\Select::make('service_id')
                ->relationship('service', 'name')
                ->required()
                ->label('Услуга'),
            Forms\Components\Select::make('expert_id')
                ->relationship('expert')
                ->required()
                ->label('Специалист')
                ->getOptionLabelFromRecordUsing(fn(Expert $expert) => $expert->full_name),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Адрес')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Дата')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Услуга')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expert.full_name')
                    ->label('Специалист')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\Action::make('print')
                    ->label(false)
                    ->url(fn($record): string => route('acts.print', $record))
                    ->icon('fas-print')
                    ->openUrlInNewTab(),
            ])
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
            'index' => Pages\ListActs::route('/'),
            'create' => Pages\CreateAct::route('/create'),
            'edit' => Pages\EditAct::route('/{record}/edit'),
        ];
    }
}
