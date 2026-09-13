<?php

declare(strict_types=1);

/*
 * The theme must build on Filament's own CSS architecture: it reads the
 * runtime colour variables Filament injects (`--primary-500`, `--gray-200`,
 * `--color-500` inside a `.fi-color-*` scope…) instead of defining parallel
 * scales, and layers its component overrides the way Filament does.
 */

beforeEach(function (): void {
    $this->css = file_get_contents(__DIR__.'/../resources/css/index.css');
});

it('only reads colour scales that Filament registers on the panel', function (): void {
    preg_match_all('/var\(--([a-z]+)-(?:50|[1-9]00|950)\b/', $this->css, $matches);

    expect($matches[1])->not->toBeEmpty()
        ->and(array_values(array_unique($matches[1])))
        ->each->toBeIn(['primary', 'gray', 'success', 'warning', 'danger', 'info', 'color']);
});

it('does not ship its own colour scales or palette body classes', function (): void {
    expect($this->css)
        ->not->toContain('--fi-color-')
        ->not->toContain('-palette-')
        ->not->toContain('--color-honey')
        ->not->toContain('--color-powder')
        ->not->toContain('--color-minty');
});

it('layers its component overrides like Filament does', function (): void {
    expect($this->css)->toContain('@layer components {')
        ->and(substr_count($this->css, '--tw-ring-shadow: 0 0 #0000'))->toBe(0);
});

it('publishes a theme entry-point that imports Filament before the package', function (): void {
    $stub = file_get_contents(__DIR__.'/../stubs/theme.css');

    $filament = strpos($stub, 'vendor/filament/filament/resources/css/theme.css');
    $package = strpos($stub, 'vendor/laboiteacode/filament-tribute-theme/resources/css/index.css');

    expect($filament)->toBeInt()
        ->and($package)->toBeInt()
        ->and($filament)->toBeLessThan($package)
        ->and($stub)->toContain('fonts.bunny.net/css?family=outfit');
});
