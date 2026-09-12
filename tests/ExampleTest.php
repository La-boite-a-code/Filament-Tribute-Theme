<?php

declare(strict_types=1);

use Laboiteacode\FilamentTributeTheme\FilamentTributeTheme;
use Laboiteacode\FilamentTributeTheme\FilamentTributeThemePlugin;

it('has a version', function (): void {
    expect((new FilamentTributeTheme)->version())->toBe('1.0.0');
});

it('exposes a plugin id', function (): void {
    expect(FilamentTributeThemePlugin::make()->getId())->toBe('filament-tribute-theme');
});
