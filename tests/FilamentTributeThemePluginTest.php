<?php

declare(strict_types=1);

use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Laboiteacode\FilamentTributeTheme\Enums\Palette;
use Laboiteacode\FilamentTributeTheme\FilamentTributeThemePlugin;

it('registers the honey palette, stone grays and the brand font by default', function (): void {
    $panel = makePanel();

    FilamentTributeThemePlugin::make()->register($panel);

    expect($panel->getColors())
        ->toHaveKeys(['primary', 'gray', 'info', 'success', 'warning', 'danger'])
        ->and($panel->getColors()['primary'])->toBe(Palette::Honey->shades())
        ->and($panel->getColors()['gray'])->toBe(Color::Stone)
        ->and($panel->getFontFamily())->toBe('Albert Sans')
        ->and($panel->getFontUrl())->toContain('fonts.bunny.net')->toContain('400i');
});

it('registers the chosen palette as the primary colour', function (Palette $palette): void {
    $panel = makePanel();

    FilamentTributeThemePlugin::make()->palette($palette)->register($panel);

    expect($panel->getColors()['primary'])->toBe($palette->shades());
})->with(Palette::cases());

it('reads the palette from the published config when not set explicitly', function (): void {
    config()->set('filament-tribute-theme.palette', 'minty');

    expect(FilamentTributeThemePlugin::make()->getPalette())->toBe(Palette::Minty);
});

it('falls back to honey when the configured palette is unknown', function (): void {
    config()->set('filament-tribute-theme.palette', 'neon');

    expect(FilamentTributeThemePlugin::make()->getPalette())->toBe(Palette::Honey);
});

it('lets an explicit palette win over the config', function (): void {
    config()->set('filament-tribute-theme.palette', 'minty');

    expect(FilamentTributeThemePlugin::make()->palette(Palette::Powder)->getPalette())->toBe(Palette::Powder);
});

it('keeps the panel colours untouched with withoutColors()', function (): void {
    $panel = makePanel()->colors(['primary' => Color::Blue]);

    FilamentTributeThemePlugin::make()->withoutColors()->register($panel);

    expect($panel->getColors()['primary'])->toBe(Color::Blue)
        ->and($panel->getColors())->not->toHaveKey('gray');
});

it('registers custom colours verbatim, resolving closures', function (): void {
    $panel = makePanel();

    FilamentTributeThemePlugin::make()
        ->colors([
            'primary' => Color::Violet,
            'gray' => fn (): array => Color::Zinc,
        ])
        ->register($panel);

    expect($panel->getColors())->toBe([
        'primary' => Color::Violet,
        'gray' => Color::Zinc,
    ]);
});

it('can leave the panel font alone', function (): void {
    $panel = makePanel()->font('Inter');

    FilamentTributeThemePlugin::make()->font(null)->register($panel);

    expect($panel->getFontFamily())->toBe('Inter');
});

it('applies a full max content width on request', function (): void {
    $panel = makePanel();

    FilamentTributeThemePlugin::make()->maxContentWidth()->register($panel);

    $width = $panel->getMaxContentWidth();

    expect($width instanceof Width ? $width->value : $width)->toBe('full');
});
