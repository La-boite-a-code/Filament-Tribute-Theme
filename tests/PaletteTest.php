<?php

declare(strict_types=1);

use Laboiteacode\FilamentTributeTheme\Enums\Palette;

it('ships a full oklch shade scale for every palette', function (Palette $palette): void {
    $shades = $palette->shades();

    expect(array_keys($shades))->toBe([50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950]);

    foreach ($shades as $shade) {
        expect($shade)->toMatch('/^oklch\(\d\.\d+ \d\.\d+ \d+(\.\d+)?\)$/');
    }
})->with(Palette::cases());

it('keeps every scale monotonically darker from 50 to 950', function (Palette $palette): void {
    $lightness = array_map(
        static fn (string $shade): float => (float) sscanf($shade, 'oklch(%f %f %f)')[0],
        array_values($palette->shades()),
    );

    $sorted = $lightness;
    rsort($sorted);

    expect($lightness)->toBe($sorted);
})->with(Palette::cases());
