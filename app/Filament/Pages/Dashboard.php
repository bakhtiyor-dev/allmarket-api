<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\Route;

class Dashboard extends BasePage
{
    protected static bool $shouldRegisterNavigation = false;

    protected function getWidgets(): array
    {
        return [];
    }
}
