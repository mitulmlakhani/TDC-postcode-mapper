<?php

namespace App\Providers;

use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        Window::open()->height(800)->width(800)->maximizable(true)->showDevTools(false)->title(config('app.name'));
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
            'memory_limit' => '1050M',
            'display_errors' => '0',
            'max_execution_time' => '0',
            'max_input_time' => '0',
        ];
    }
}
