<?php

namespace App\Filament\Resources\OrderMenuResource\Pages;

use App\Filament\Resources\OrderMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderMenus extends ListRecords
{
    protected static string $resource = OrderMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
