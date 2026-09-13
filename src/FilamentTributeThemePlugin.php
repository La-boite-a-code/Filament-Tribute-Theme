<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentTributeTheme;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;

class FilamentTributeThemePlugin implements Plugin
{
    /**
     * Honey — the filamentphp.com signature, anchored on the media kit's
     * #EFAF5D at shade 400 and deepening toward Cocoa for the UI shades.
     *
     * The scale is hand-tuned rather than generated: Filament picks button,
     * badge and link shades by contrast, and a generated scale drifts away
     * from the brand — the honey turns orange at the dark end and the calls
     * to action lose the dark ink they have on the site.
     *
     * @var array<int, string>
     */
    public const HONEY = [
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
    ];

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

    public function getId(): string
    {
        return 'filament-tribute-theme';
    }

    public function register(Panel $panel): void
    {
        if ($this->registerColors) {
            $panel->colors($this->resolveColors());
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
     * Override the colour array registered on the panel. Pass your own
     * `primary` to brand the theme without losing the rest of its material.
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
     * Honey as the primary colour, warm Stone grays (the site's text
     * colours) and Filament's stock semantic colours.
     *
     * @return array<string, mixed>
     */
    protected function resolveColors(): array
    {
        if ($this->colors !== []) {
            return $this->collapseClosures($this->colors);
        }

        return [
            'primary' => static::HONEY,
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
