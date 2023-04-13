<?php

namespace App\Filament\Resources\CustomerTagResource\Pages;

use App\Filament\Resources\CustomerTagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerTag extends CreateRecord
{
    protected static string $resource = CustomerTagResource::class;
}
