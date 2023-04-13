<?php

namespace App\Filament\Resources\CustomerCategoryResource\Pages;

use App\Filament\Resources\CustomerCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerCategory extends EditRecord
{
    protected static string $resource = CustomerCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
