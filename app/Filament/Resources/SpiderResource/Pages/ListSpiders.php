<?php

namespace App\Filament\Resources\SpiderResource\Pages;

use App\Filament\Resources\SpiderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpiders extends ListRecords
{
    protected static string $resource = SpiderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
