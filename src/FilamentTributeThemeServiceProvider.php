<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentTributeTheme;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTributeThemeServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-tribute-theme';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile(static::$name)
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command
                    ->publishConfigFile()
                    ->endWith(function (InstallCommand $command): void {
                        $command->call('vendor:publish', [
                            '--tag' => 'filament-tribute-theme-css',
                        ]);
                    })
                    ->askToStarRepoOnGitHub('La-boite-a-code/Filament-Tribute-Theme');
            });
    }

    public function packageBooted(): void
    {
        /*
         * The theme ships as source CSS only: the host application's Vite /
         * Tailwind pipeline compiles `resources/css/index.css` through the
         * panel theme entry-point published below (also available via
         * `vendor:publish --tag=filament-tribute-theme-css`).
         */
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/theme.css' => resource_path('css/filament/admin/theme.css'),
            ], 'filament-tribute-theme-css');
        }
    }
}
