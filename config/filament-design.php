<?php

declare(strict_types=1);

use Laboiteacode\FilamentDesign\Enums\Palette;

/*
 * FilamentDesign theme configuration.
 *
 * The whole theme is configured fluently from your Filament PanelProvider:
 *
 *     ->plugin(
 *         FilamentDesignPlugin::make()
 *             ->palette(Palette::Powder)
 *             ->maxContentWidth('full'),
 *     )
 *
 * This config file only exists for projects that prefer environment-driven
 * defaults. Publish it with:
 *   php artisan vendor:publish --tag="filament-design-config"
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

    'palette' => env('FILAMENT_DESIGN_PALETTE', Palette::Honey->value),

];
