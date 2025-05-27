<?php

namespace App\Filament\Resources\OrderMenuResource\Pages;

use App\Filament\Resources\OrderMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderMenu extends EditRecord
{
    protected static string $resource = OrderMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
