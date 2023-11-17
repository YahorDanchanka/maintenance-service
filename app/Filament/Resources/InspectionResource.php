<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InspectionResource\Pages;
use App\Filament\Resources\InspectionResource\RelationManagers;
use App\Models\Expert;
use App\Models\Inspection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InspectionResource extends Resource
{
    protected static ?string $model = Inspection::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Тех. осмотр';
    protected static ?string $pluralModelLabel = 'Тех. осмотры';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->maxDate(now())
                    ->label('Дата'),
                Forms\Components\Select::make('expert_id')
                    ->relationship('expert')
                    ->required()
                    ->label('Специалист')
                    ->getOptionLabelFromRecordUsing(fn(Expert $expert) => $expert->full_name),
                Forms\Components\Textarea::make('result')
                    ->required()
                    ->label('Результат'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Дата')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expert.full_name')
                    ->label('Специалист')
                    ->sortable(),
                Tables\Columns\TextColumn::make('result')
                    ->label('Результат')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\Action::make('print')
                    ->label(false)
                    ->url(fn($record): string => route('inspections.print', $record))
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
            'index' => Pages\ListInspections::route('/'),
            'create' => Pages\CreateInspection::route('/create'),
            'edit' => Pages\EditInspection::route('/{record}/edit'),
        ];
    }
}
