<?php

namespace App\Filament\Resources\ExpertResource\Pages;

use App\Filament\Resources\ExpertResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditExpert extends EditRecord
{
    protected static string $resource = ExpertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Actions\DeleteAction $action) {
                if ($this->record->acts()->exists() || $this->record->inspections()->exists()) {
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
