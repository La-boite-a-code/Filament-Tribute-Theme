<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentTributeTheme;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Laboiteacode\FilamentTributeTheme\Enums\Palette;

class FilamentTributeThemePlugin implements Plugin
{
    /**
     * @var array<string, mixed>
     */
    protected array $colors = [];

    protected bool $registerColors = true;

    protected ?string $font = 'Albert Sans';

    /**
     * Filament's default provider is Bunny Fonts; its generated URL carries
     * no italic axis, so the brand face ships its own URL with italics.
     */
    protected ?string $fontUrl = 'https://fonts.bunny.net/css?family=albert-sans:400,400i,500,500i,600,600i,700,700i&display=swap';

    protected bool|string $maxContentWidth = false;

    protected ?Palette $palette = null;

    public function getId(): string
    {
        return 'filament-tribute-theme';
    }

    public function register(Panel $panel): void
    {
        if ($this->registerColors) {
            $panel->colors($this->resolveColors($this->getPalette()));
        }

        if ($this->font !== null) {
            $panel->font($this->font, $this->fontUrl);
        }

        if ($this->maxContentWidth !== false) {
            $panel->maxContentWidth($this->maxContentWidth === true ? 'full' : $this->maxContentWidth);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    /**
     * Pick the brand palette: Honey (default), Powder, or Minty.
     */
    public function palette(Palette $palette): static
    {
        $this->palette = $palette;

        return $this;
    }

    /**
     * The active palette: an explicit `->palette()` call wins; otherwise the
     * published config value (driven by `FILAMENT_TRIBUTE_THEME_PALETTE`); otherwise
     * Honey.
     */
    public function getPalette(): Palette
    {
        if ($this->palette instanceof Palette) {
            return $this->palette;
        }

        $configured = (string) config('filament-tribute-theme.palette', Palette::Honey->value);

        return Palette::tryFrom($configured) ?? Palette::Honey;
    }

    /**
     * Override the colour array registered on the panel.
     *
     * @param  array<string, mixed>  $colors
     */
    public function colors(array $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * Skip colour registration entirely and keep the panel's own
     * `->colors([...])` configuration untouched.
     */
    public function withoutColors(): static
    {
        $this->registerColors = false;

        return $this;
    }

    /**
     * Body font registered through Filament's `->font()`. Pass `null` to keep
     * the panel's own font; pass a `$url` to load the family from elsewhere.
     */
    public function font(?string $font, ?string $url = null): static
    {
        $this->font = $font;
        $this->fontUrl = $url;

        return $this;
    }

    /**
     * Force a specific max content width on the panel. Pass `true` for
     * 'full', a string for any Filament max-width preset, or `false` to
     * keep the panel's own configuration.
     */
    public function maxContentWidth(bool|string $value = true): static
    {
        $this->maxContentWidth = $value;

        return $this;
    }

    /**
     * The brand palette as the primary colour, warm Stone grays (the
     * filamentphp.com text colours) and Filament's stock semantic colours.
     *
     * @return array<string, mixed>
     */
    protected function resolveColors(Palette $palette): array
    {
        if ($this->colors !== []) {
            return $this->collapseClosures($this->colors);
        }

        return [
            'primary' => $palette->shades(),
            'gray' => Color::Stone,
            'info' => Color::Sky,
            'success' => Color::Emerald,
            'warning' => Color::Amber,
            'danger' => Color::Red,
        ];
    }

    /**
     * @param  array<string, mixed>  $values
     * @return array<string, mixed>
     */
    protected function collapseClosures(array $values): array
    {
        return array_map(
            static fn (mixed $value): mixed => $value instanceof Closure ? $value() : $value,
            $values,
        );
    }
}
