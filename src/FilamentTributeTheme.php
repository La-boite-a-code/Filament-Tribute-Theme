<?php

declare(strict_types=1);

namespace Laboiteacode\FilamentTributeTheme;

use Composer\InstalledVersions;

class FilamentTributeTheme
{
    public const PACKAGE = 'laboiteacode/filament-tribute-theme';

    /**
     * The installed version, read from Composer's runtime API so it always
     * matches the tag Packagist served (`1.0.0` for `v1.0.0`, or a branch
     * alias such as `dev-main` in development).
     */
    public function version(): string
    {
        return ltrim(InstalledVersions::getPrettyVersion(static::PACKAGE) ?? 'dev', 'v');
    }
}
