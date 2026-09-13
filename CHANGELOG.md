# Changelog

All notable changes to `filament-tribute-theme` will be documented in this file.

## 1.0.0 - 2026-09-12

First release.

- Filament v5 theme paying tribute to filamentphp.com: warm off-white dotted
  canvas, cream cards marked by two corner ticks, honey pill buttons with the
  site's dark "flood" hover, flat underlined tabs, tan hairlines and Outfit
  headings on Stone ink.
- Three brand palettes (Honey, Powder, Minty) registered as full OKLCH shade
  scales through the panel's `->colors()`; every rule reads Filament's runtime
  colour variables, nothing is remapped.
- Component overrides written with Filament's Tailwind utilities inside
  `@layer components`, so Filament keeps owning focus, invalid, disabled and
  responsive states. Under 550 lines of CSS.
- Albert Sans registered through Filament's `->font()` (Bunny Fonts, with
  italics); Outfit imported by the published theme entry-point.
- `filament-tribute-theme:install` publishes the config file and the theme
  entry-point; `tribute-card`, `tribute-display` and `tribute-eyebrow`
  utilities for custom Blade views.
- Tested on PHP 8.2–8.5 with Laravel 12 and 13; a CI job compiles the theme
  against Filament so an invalid utility fails the build.
