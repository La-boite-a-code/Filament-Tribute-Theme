# Changelog

All notable changes to `filament-tribute-theme` will be documented in this file.

## [Unreleased]

### Changed
- The package is now **Filament Tribute Theme** (`laboiteacode/filament-tribute-theme`,
  namespace `Laboiteacode\FilamentTributeTheme`, config `filament-tribute-theme`,
  env `FILAMENT_TRIBUTE_THEME_PALETTE`, CSS tokens `--tribute-*` and utilities
  `tribute-card` / `tribute-display` / `tribute-eyebrow`), published at
  https://github.com/La-boite-a-code/Filament-Tribute-Theme.
- The theme now builds on Filament's own CSS architecture: palettes are
  registered as full OKLCH shade scales through `$panel->colors()`, rules read
  Filament's runtime variables (`--primary-*`, `--gray-*`, `--color-*`) and are
  written with Filament's Tailwind utilities inside `@layer components`.
  The stylesheet shrinks from ~2,600 to under 500 lines and Filament keeps
  owning focus, invalid, disabled and responsive states.
- Primary buttons rely on Filament's contrast engine (honey-400 + dark ink);
  the theme only adds the pill and the filamentphp.com dark "flood" hover.
- Palette switching no longer injects a `<body>` class through a render hook.
- Albert Sans is loaded through Filament's `->font()`; the published
  `theme.css` only imports Outfit.
- Laravel 13, Pest 5 and Orchestra Testbench 11 are supported; the CI matrix
  covers PHP 8.2–8.5 and Laravel 12/13.

### Added
- `Palette::shades()` — the 50–950 scale behind each palette.
- `FilamentTributeThemePlugin::getPalette()` — the resolved palette (explicit call,
  then config, then Honey).
- `tribute-card`, `tribute-display` and `tribute-eyebrow` utilities for custom Blade views.
- Tests covering palette scales, panel colour/font registration, config
  fallbacks and the stylesheet's use of Filament variables.

### Removed
- `Palette::hex()` and `Palette::cssClass()`, the `.fd-palette-*` classes and
  the `--fi-color-*` aliases.
- Unused asset, icon, script-data and Livewire testing registrations, and the
  custom install command subclass (`filament-tribute-theme:install` is the
  name Spatie derives natively).
- `--fd-radius-*`, `--fd-stroke`, `--fd-border-soft-*`, `--fd-shadow-sm`,
  `--fd-glow-mix` and `--fd-duration-slow` tokens.
