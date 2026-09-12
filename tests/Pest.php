<?php

declare(strict_types=1);

use Filament\Panel;
use Laboiteacode\FilamentTributeTheme\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function makePanel(): Panel
{
    return Panel::make()->id('filament-tribute-theme-test');
}
