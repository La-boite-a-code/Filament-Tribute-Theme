# FilamentDesign

A free Filament v5 theme paying homage to **Filament's own brand** — warm
honey & cream surfaces, pill buttons with dark cocoa ink, soft pastel
accents, and the Outfit + Albert Sans type pairing straight from the
[Filament media kit](https://filamentphp.com/media-kit). Three brand
palettes ship out of the box (Honey · Powder · Minty).

One of a series of homage themes by
[La Boite à Code](https://laboiteacode.fr).

---

## Requirements

- PHP `^8.2`
- Laravel `^12.0`
- Filament `^5.0`
- Tailwind CSS `^4.0` (shipped with Filament v5)

---

## Installation

### 1. Pull the package

```bash
composer require laboiteacode/filament-design
```

### 2. Run the installer

```bash
php artisan filament-design:install
```

This publishes:
- `config/filament-design.php` — optional env-driven palette default
- `resources/css/filament/admin/theme.css` — Filament panel theme entry-point

### 3. Wire the theme into your panel

Edit `app/Providers/Filament/AdminPanelProvider.php` and register both the
theme stylesheet and the plugin:

```php
use Laboiteacode\FilamentDesign\Enums\Palette;
use Laboiteacode\FilamentDesign\FilamentDesignPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('resources/css/filament/admin/theme.css')
        ->plugin(
            FilamentDesignPlugin::make()
                ->palette(Palette::Honey),
        );
}
```

### 4. Build the assets

```bash
npm run build      # production
npm run dev        # development (HMR)
```

Reload the panel and the theme is live.

---

## Picking a palette

Three brand palettes ship out of the box. Each one swaps the panel's
`primary` color and applies a `.fd-palette-{name}` class on `<body>` so the
CSS can remap `--fi-color-primary-*` tokens consistently.

```php
use Laboiteacode\FilamentDesign\Enums\Palette;

FilamentDesignPlugin::make()->palette(Palette::Honey)  // #EFAF5D (default)
FilamentDesignPlugin::make()->palette(Palette::Powder) // #AEC6F4
FilamentDesignPlugin::make()->palette(Palette::Minty)  // #BFE6D9
```

Cards, callouts, sidebar active states, focus rings, primary buttons,
notification dots and pagination chips all follow the chosen palette
automatically — no further configuration needed.

### Driving the palette from env

The plugin reads `config('filament-design.palette')` automatically when
`->palette()` is not called explicitly. Set the env var and the panel
follows — no extra wiring needed:

```dotenv
FILAMENT_DESIGN_PALETTE=powder
```

Supported values: `honey` (default), `powder`, `minty`. Calling
`->palette(Palette::Powder)` always wins over the env value.

---

## Plugin API

All options are fluent and can be chained on `FilamentDesignPlugin::make()`.

| Method | Purpose | Default |
| --- | --- | --- |
| `palette(Palette $palette)` | Pick the brand palette | `Palette::Honey` |
| `font(?string $font)` | Override the panel body font (`null` to leave Filament's choice) | `'Albert Sans'` |
| `maxContentWidth(bool\|string $value = true)` | `true` for `'full'`, any Filament preset string, or `false` to keep the panel's setting | `false` |
| `colors(array $colors)` | Replace the auto-resolved color array with your own (`Color::hex()` / Filament palettes) | auto |
| `withoutColors()` | Skip color injection entirely — keep the panel's `->colors()` untouched | enabled |

> Headings render in **Outfit** and body text in **Albert Sans** (Filament's
> brand typefaces), loaded by the published `theme.css`. `font()` overrides the
> body face only.

### Example — full configuration

```php
use Filament\Support\Colors\Color;
use Laboiteacode\FilamentDesign\Enums\Palette;
use Laboiteacode\FilamentDesign\FilamentDesignPlugin;

FilamentDesignPlugin::make()
    ->palette(Palette::Powder)
    ->maxContentWidth('full')
    ->colors([
        'primary' => Color::hex('#7c3aed'),
        'gray' => Color::Stone,
    ]);
```

---

## What the theme styles

Out of the box, FilamentDesign restyles every Filament v5 surface to match
the filamentphp.com art direction:

- **Buttons** — honey **pill** with dark cocoa ink (the site's signature CTA),
  quiet ghost/outlined secondaries, focus glow at the panel's primary
- **Canvas** — warm cream / peach wash so the panel reads like the marketing
  site rather than a flat white admin
- **Sections & cards** — soft rounded surfaces on cream, hairline warm borders,
  gentle elevation
- **Tables** — flat header band, hairline row dividers, primary-tinted hover,
  pastel status badges, honey pagination
- **Forms** — inputs with honey required marks, honey focus glow, fieldset
  framing, reactive validation states
- **Notifications** — toasts with severity-tinted left edge; database panel
  reads as a clean list with the unread dot in the primary color
- **Sidebar** — tinted honey gradient active state with a primary edge bar,
  dark-ink badges on the current item, group titles with refined tracking;
  the active treatment auto-simplifies to a colored icon when collapsed
- **Modals** — header/content/footer mirror the section structure
- **Tabs** — segmented pill on contained tabs, underlined inline tabs
- **Page headers** — bold Outfit display titles with a honey period accent

---

## Customizing tokens

FilamentDesign exposes a handful of CSS custom properties so you can tweak
geometry without rewriting selectors. Add overrides in your panel's theme
CSS, **after** the package import:

```css
@import '../../../../vendor/filament/filament/resources/css/theme.css';
@import '../../../../vendor/laboiteacode/filament-design/resources/css/index.css';

/* Your overrides */
:root {
    --fd-radius-sm: 0.375rem;    /* tighter buttons */
    --fd-radius:    0.625rem;    /* softer cards */
    --fd-frame-gap: 4px;         /* wider double-frame gap */
}

.dark {
    --fd-frame-ring-color: oklch(0.30 0.005 75);
}
```

Available tokens:

| Token | Role |
| --- | --- |
| `--fd-radius-xs` / `-sm` / `--fd-radius` / `-lg` | Corner radius scale |
| `--fd-pill` | Pill radius (buttons, badges, segmented tabs) |
| `--fd-stroke` | Default border thickness |
| `--fd-border-soft-light` / `-dark` | Hairline divider colour, per mode |
| `--fd-canvas` | Body canvas colour |
| `--fd-frame-gap` | Gap between inner border and outer ring |
| `--fd-frame-gap-color` | Gap fill colour (defaults to canvas) |
| `--fd-frame-ring-color` | Outer ring colour |
| `--fd-shadow-sm` / `--fd-shadow-lg` | Elevation scale |
| `--fd-glow-mix` | Focus glow intensity (0–100%) |
| `--fd-duration-slow` | Motion timing |
| `--fd-ease-out` | Motion curve |

Two opt-in utility classes are also available: `.fd-eyebrow` (uppercase
tracked eyebrow text) and `.fd-display` (Outfit display heading).

---

## How it's compiled

FilamentDesign ships only source CSS — no precompiled bundle. The host
app's Vite/Tailwind pipeline picks up the package's
`resources/css/index.css` through the theme entrypoint published to
`resources/css/filament/admin/theme.css`, alongside Filament's own theme
import. That keeps Tailwind's `@source` scanning aware of both your panel
classes and the package's selectors, so unused utilities are pruned in
your build like any other dependency.

---

## Credits

- Built on top of [`filamentphp/plugin-skeleton`](https://github.com/filamentphp/plugin-skeleton).
- Brand colours and typography from the official [Filament media kit](https://filamentphp.com/media-kit).
- Maintained by [La Boite à Code](https://laboiteacode.fr).

---

## License

MIT — see [LICENSE.md](./LICENSE.md).
