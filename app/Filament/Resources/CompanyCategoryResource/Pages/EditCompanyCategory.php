<?php

namespace App\Filament\Resources\CompanyCategoryResource\Pages;

use App\Filament\Resources\CompanyCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyCategory extends EditRecord
{
    protected static string $resource = CompanyCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
