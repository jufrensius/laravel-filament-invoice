<?php

namespace App\Filament\Resources\CompanyTagResource\Pages;

use App\Filament\Resources\CompanyTagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyTag extends EditRecord
{
    protected static string $resource = CompanyTagResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
