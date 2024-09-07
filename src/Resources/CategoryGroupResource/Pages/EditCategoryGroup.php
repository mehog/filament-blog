<?php

namespace Firefly\FilamentBlog\Resources\CategoryGroupResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Resources\CategoryGroupResource;

class EditCategoryGroup extends EditRecord
{
    protected static string $resource = CategoryGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
