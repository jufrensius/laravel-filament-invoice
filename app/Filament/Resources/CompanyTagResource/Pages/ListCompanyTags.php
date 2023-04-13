<?php

namespace App\Filament\Resources\CompanyTagResource\Pages;

use App\Filament\Resources\CompanyTagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyTags extends ListRecords
{
    protected static string $resource = CompanyTagResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
