<?php

namespace App\Filament\Resources\PanierResource\Pages;

use App\Filament\Resources\PanierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanier extends EditRecord
{
    protected static string $resource = PanierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
