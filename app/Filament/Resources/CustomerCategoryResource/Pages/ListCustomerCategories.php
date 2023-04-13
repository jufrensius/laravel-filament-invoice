<?php

namespace App\Filament\Resources\CustomerCategoryResource\Pages;

use App\Filament\Resources\CustomerCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerCategories extends ListRecords
{
    protected static string $resource = CustomerCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
