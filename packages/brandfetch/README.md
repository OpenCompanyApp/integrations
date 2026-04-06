# Integration: Brandfetch

> Brandfetch integration for the [Laravel AI SDK](https://github.com/laravel/ai) — look up brand logos, colors, fonts, and assets. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to brand asset data. Look up logos, colors, fonts, and other brand information for any company — all through the [Brandfetch](https://brandfetch.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Brandfetch tool lets AI agents look up brand assets on demand — giving agents visual awareness of company brands for marketing, design, and research tasks.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-brandfetch
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Brandfetch access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'brandfetch' => [
        'access_token' => env('BRANDFETCH_ACCESS_TOKEN'),
        'url'          => env('BRANDFETCH_URL', 'https://api.brandfetch.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `brandfetch_get_brand` | read | Look up a brand by domain — logos, colors, fonts, assets |
| `brandfetch_search_brands` | read | Search for brands by name or domain |
| `brandfetch_list_logos` | read | List logo variants for a brand (SVG, PNG, themes) |
| `brandfetch_get_logo` | read | Get a single logo by ID |
| `brandfetch_list_colors` | read | List official brand colors (hex values) |
| `brandfetch_list_fonts` | read | List fonts used by a brand |
| `brandfetch_get_current_user` | read | Get authenticated user's account details |

## Quick Start

```php
use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetBrand;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchSearchBrands;

// Create tools
$service = app(BrandfetchService::class);
$tools = [
    new BrandfetchGetBrand($service),
    new BrandfetchSearchBrands($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are Nike\'s brand colors?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('brandfetch');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetBrand::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Brandfetch\BrandfetchService;

$service = app(BrandfetchService::class);

// Get a brand by domain
$brand = $service->getBrand('spotify.com');

// Search for brands
$results = $service->searchBrands('Nike', limit: 5);

// List logos for a brand
$logos = $service->listLogos($brandId);

// Get a specific logo
$logo = $service->getLogo($logoId);

// List brand colors
$colors = $service->listColors($brandId);

// List brand fonts
$fonts = $service->listFonts($brandId);

// Get current user
$user = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Brandfetch](https://brandfetch.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
