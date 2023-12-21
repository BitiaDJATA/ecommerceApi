<?php

namespace App\Filament\Resources\PanierResource\Pages;

use App\Filament\Resources\PanierResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPanier extends ViewRecord
{
    protected static string $resource = PanierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
