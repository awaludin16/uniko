<?php

namespace App\Filament\Resources\OrderMenuResource\Pages;

use App\Filament\Resources\OrderMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderMenu extends CreateRecord
{
    protected static string $resource = OrderMenuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
