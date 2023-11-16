<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Actions\DeleteAction $action) {
                if ($this->record->materials()->exists()) {
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
