# fond-of-spryker/setup-frontend
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/product-storage)

## What does it do

Extends the default module with required parameter themename. The theme must be stored under ./frontend/themename. The foldername must be lowercase.

## Install

```
composer require fond-of-spryker/setup-frontend
```

## Configration

Add the new module to your ConsoleDependencyProvider, mostly stored unter Pyz\Zed\Console

```
protected function getConsoleCommands(Container $container) 
{
    ...
    new YvesBuildFrontendConsole(),
    ...
}
```