<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentDesign;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Laboiteacode\FilamentDesign\Commands\InstallCommand;
use Laboiteacode\FilamentDesign\Testing\TestsFilamentDesign;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentDesignServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-design';

    public static string $viewNamespace = 'filament-design';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasConfigFile(static::$name);

        // Register the branded `filament-design:install` command. Built directly
        // (instead of `->hasInstallCommand()`) so it uses our renamed subclass
        // rather than spatie's short-name-derived `design:install`.
        $installCommand = new InstallCommand($package);
        $installCommand
            ->publishConfigFile()
            ->endWith(function (InstallCommand $command): void {
                $command->call('vendor:publish', [
                    '--tag' => 'filament-design-theme',
                ]);
            })
            ->askToStarRepoOnGitHub('laboiteacode/filament-design');

        $package->consoleCommands[] = $installCommand;

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        FilamentIcon::register($this->getIcons());

        // Filament panel theme entry-point — published to the host app
        // by the install command (or via `vendor:publish --tag=filament-design-theme`).
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/theme.css' => resource_path('css/filament/admin/theme.css'),
            ], 'filament-design-theme');
        }

        // Testing
        Testable::mixin(new TestsFilamentDesign);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'laboiteacode/filament-design';
    }

    /**
     * @return array<Asset>
     *
     * The FilamentDesign theme CSS is compiled by the host application's
     * Vite/Tailwind pipeline (the host app imports
     * packages/filament-design/resources/css/index.css from its own
     * Filament theme entrypoint). No precompiled CSS is shipped here.
     *
     * If you need to ship runtime JS / Alpine components later, register
     * them in this method.
     */
    protected function getAssets(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }
}
