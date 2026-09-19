# Changelog

All notable changes to `filament-tribute-theme` will be documented in this file.

## Unreleased

- `FilamentTributeTheme::version()` reads the installed version from
  Composer's runtime API instead of returning a hard-coded `1.0.0`.

## 1.0.0 - 2026-09-19

First release.

- Filament v5 theme paying tribute to filamentphp.com: warm off-white dotted
  canvas, cream cards marked by two corner ticks, honey pill buttons with the
  site's dark "flood" hover, flat underlined tabs, tan hairlines and Outfit
  headings on Stone ink.
- One brand colour, honey, anchored on the media kit's `#EFAF5D` and shipped
  as a hand-tuned 50–950 OKLCH scale registered through the panel's
  `->colors()`. Every rule reads Filament's runtime colour variables, nothing
  is remapped. `colors()` and `withoutColors()` remain for panels that need
  their own accent.
- Component overrides written with Filament's Tailwind utilities inside
  `@layer components`, so Filament keeps owning focus, invalid, disabled and
  responsive states. Under 550 lines of CSS.
- Albert Sans registered through Filament's `->font()` (Bunny Fonts, with
  italics); Outfit imported by the published theme entry-point.
- `filament-tribute-theme:install` publishes the theme entry-point;
  `tribute-card`, `tribute-display` and `tribute-eyebrow` utilities for custom
  Blade views.
- Tested on PHP 8.2–8.5 with Laravel 12 and 13; a CI job compiles the theme
  against Filament so an invalid utility fails the build.
- Cover art plus panel screenshots in light and dark mode.
