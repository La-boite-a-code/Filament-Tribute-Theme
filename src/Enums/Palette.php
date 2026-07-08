<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentDesign\Enums;

/**
 * Brand palette presets shipped with FilamentDesign. Each case carries the
 * official Filament brand HEX anchor and the CSS class name applied to <body>
 * when the palette is active.
 *
 * Add a new case here to introduce a new palette — the plugin and CSS
 * pick it up automatically as long as a matching `.fd-palette-{value}`
 * block is defined in the theme stylesheet.
 */
enum Palette: string
{
    case Honey = 'honey';

    case Powder = 'powder';

    case Minty = 'minty';

    /**
     * Brand HEX anchor — sourced from the official Filament media kit
     * (Honey · Powder · Minty). Used to seed the panel's `primary` color.
     */
    public function hex(): string
    {
        return match ($this) {
            self::Honey => '#EFAF5D',
            self::Powder => '#AEC6F4',
            self::Minty => '#BFE6D9',
        };
    }

    /**
     * The body class consumed by the theme stylesheet to remap the
     * `--fi-color-primary-*` tokens for non-Honey palettes.
     */
    public function cssClass(): string
    {
        return "fd-palette-{$this->value}";
    }
}
