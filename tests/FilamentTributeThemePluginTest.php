<?php

declare(strict_types=1);

use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Laboiteacode\FilamentTributeTheme\FilamentTributeThemePlugin;

it('registers honey, stone grays and the brand font by default', function (): void {
    $panel = makePanel();

    FilamentTributeThemePlugin::make()->register($panel);

    expect($panel->getColors())
        ->toHaveKeys(['primary', 'gray', 'info', 'success', 'warning', 'danger'])
        ->and($panel->getColors()['primary'])->toBe(FilamentTributeThemePlugin::HONEY)
        ->and($panel->getColors()['gray'])->toBe(Color::Stone)
        ->and($panel->getFontFamily())->toBe('Albert Sans')
        ->and($panel->getFontUrl())->toContain('fonts.bunny.net')->toContain('400i');
});

it('ships honey as a full oklch scale, monotonically darker from 50 to 950', function (): void {
    $shades = FilamentTributeThemePlugin::HONEY;

    expect(array_keys($shades))->toBe([50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950]);

    foreach ($shades as $shade) {
        expect($shade)->toMatch('/^oklch\(\d\.\d+ \d\.\d+ \d+(\.\d+)?\)$/');
    }

    $lightness = array_map(
        static fn (string $shade): float => (float) sscanf($shade, 'oklch(%f %f %f)')[0],
        array_values($shades),
    );

    $sorted = $lightness;
    rsort($sorted);

    expect($lightness)->toBe($sorted);
});

it('anchors honey on the media kit colour at shade 400', function (): void {
    expect(FilamentTributeThemePlugin::HONEY[400])->toBe('oklch(0.798 0.124 71)');
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
