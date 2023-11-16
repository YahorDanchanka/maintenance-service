<?php

namespace App\Filament\Resources\MaterialResource\Pages;

use App\Filament\Resources\MaterialResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMaterial extends EditRecord
{
    protected static string $resource = MaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Actions\DeleteAction $action) {
                if ($this->record->services()->exists()) {
                    Notification::make()
                        ->warning()
                        ->title('Запись задействована в других таблицах')
                        ->send();
                    $action->halt();
                }
            }),
        ];
    }
}
