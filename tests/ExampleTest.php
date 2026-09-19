<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use Laboiteacode\FilamentTributeTheme\FilamentTributeTheme;
use Laboiteacode\FilamentTributeTheme\FilamentTributeThemePlugin;

it('reports the version Composer installed', function (): void {
    $installed = InstalledVersions::getPrettyVersion('laboiteacode/filament-tribute-theme');

    expect((new FilamentTributeTheme)->version())
        ->not->toBeEmpty()
        ->toBe(ltrim((string) $installed, 'v'));
});

it('exposes a plugin id', function (): void {
    expect(FilamentTributeThemePlugin::make()->getId())->toBe('filament-tribute-theme');
});
