<?php

declare(strict_types=1);

use Laboiteacode\FilamentDesign\FilamentDesign;
use Laboiteacode\FilamentDesign\FilamentDesignPlugin;

it('has a version', function (): void {
    expect((new FilamentDesign)->version())->toBe('0.1.0');
});

it('exposes a plugin id', function (): void {
    expect(FilamentDesignPlugin::make()->getId())->toBe('filament-design');
});
