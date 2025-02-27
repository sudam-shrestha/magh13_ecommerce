<?php

namespace App\Filament\Shop\Resources\ShopProfileResource\Pages;

use App\Filament\Shop\Resources\ShopProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopProfiles extends ListRecords
{
    protected static string $resource = ShopProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
