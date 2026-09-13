<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentTributeTheme\Enums;

/**
 * Brand palette presets shipped with Filament Tribute Theme.
 *
 * Each case carries a full 50–950 shade scale that the plugin registers as
 * the panel's `primary` colour through Filament's own `$panel->colors()`
 * API. Filament then exposes it as `--primary-{shade}` CSS variables and
 * resolves every component's contrast-aware shade mapping from it — no CSS
 * remapping or `<body>` class is needed to switch palettes.
 *
 * The scales are hand-tuned in OKLCH around the official media-kit anchors
 * (Honey #EFAF5D, Powder #AEC6F4, Minty #BFE6D9) and deepen toward Cocoa
 * on the dark end so the UI shades (600+) keep enough contrast for text.
 */
enum Palette: string
{
    case Honey = 'honey';

    case Powder = 'powder';

    case Minty = 'minty';

    /**
     * @return array<int, string>
     */
    public function shades(): array
    {
        return match ($this) {
            self::Honey => [
                50 => 'oklch(0.982 0.014 82)',
                100 => 'oklch(0.963 0.030 82)',
                200 => 'oklch(0.928 0.058 80)',
                300 => 'oklch(0.880 0.082 76)',
                400 => 'oklch(0.798 0.124 71)',
                500 => 'oklch(0.760 0.108 68)',
                600 => 'oklch(0.670 0.110 62)',
                700 => 'oklch(0.560 0.098 57)',
                800 => 'oklch(0.460 0.076 53)',
                900 => 'oklch(0.380 0.056 50)',
                950 => 'oklch(0.265 0.040 48)',
            ],
            self::Powder => [
                50 => 'oklch(0.980 0.010 258)',
                100 => 'oklch(0.958 0.022 258)',
                200 => 'oklch(0.918 0.045 260)',
                300 => 'oklch(0.858 0.070 262)',
                400 => 'oklch(0.770 0.100 264)',
                500 => 'oklch(0.670 0.130 264)',
                600 => 'oklch(0.570 0.150 264)',
                700 => 'oklch(0.480 0.145 265)',
                800 => 'oklch(0.400 0.120 266)',
                900 => 'oklch(0.330 0.090 267)',
                950 => 'oklch(0.240 0.060 268)',
            ],
            self::Minty => [
                50 => 'oklch(0.983 0.010 165)',
                100 => 'oklch(0.962 0.022 165)',
                200 => 'oklch(0.928 0.040 165)',
                300 => 'oklch(0.888 0.055 166)',
                400 => 'oklch(0.800 0.085 168)',
                500 => 'oklch(0.700 0.110 170)',
                600 => 'oklch(0.600 0.110 172)',
                700 => 'oklch(0.505 0.098 173)',
                800 => 'oklch(0.420 0.078 174)',
                900 => 'oklch(0.345 0.058 175)',
                950 => 'oklch(0.250 0.040 176)',
            ],
        };
    }
}
