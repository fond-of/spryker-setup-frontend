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

You need to list all templates in your configration like:
```
$config[\FondOfSpryker\Shared\SetupFrontend\SetupFrontendConstants::YVES_THEMES] = ['theme1', 'theme2'];
```


## Usage

frontend:yves:build

Ask the user if all themes should be created

frontend:yves:build --force

Build all themes without confirmation

frontend:yves:build themeName

Build only the given theme





