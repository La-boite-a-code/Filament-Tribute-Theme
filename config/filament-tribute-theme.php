<?php

declare(strict_types=1);

use Laboiteacode\FilamentTributeTheme\Enums\Palette;

/*
 * Filament Tribute Theme configuration.
 *
 * The whole theme is configured fluently from your Filament PanelProvider:
 *
 *     ->plugin(
 *         FilamentTributeThemePlugin::make()
 *             ->palette(Palette::Powder)
 *             ->maxContentWidth('full'),
 *     )
 *
 * This config file only exists for projects that prefer environment-driven
 * defaults. Publish it with:
 *   php artisan vendor:publish --tag="filament-tribute-theme-config"
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Default palette
    |--------------------------------------------------------------------------
    |
    | Brand palette used when ->palette() is not called explicitly.
    | Accepts a Palette enum case, or the string value of one — useful when
    | driving the choice from an env variable.
    |
    | Supported values: 'honey' (golden), 'powder' (blue), 'minty' (green).
    |
    */

    'palette' => env('FILAMENT_TRIBUTE_THEME_PALETTE', Palette::Honey->value),

];
