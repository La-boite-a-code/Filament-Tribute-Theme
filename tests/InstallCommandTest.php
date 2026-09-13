<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;

it('registers the install command under the package name', function (): void {
    expect(array_keys(Artisan::all()))->toContain('filament-tribute-theme:install');
});
