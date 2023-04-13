<?php

namespace App\Filament\Resources\CompanyCategoryResource\Pages;

use App\Filament\Resources\CompanyCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyCategories extends ListRecords
{
    protected static string $resource = CompanyCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
