# Integration: Productboard

> Productboard integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage features, notes, products, and companies. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to product management data. List and create features, capture customer feedback as notes, browse your product hierarchy, and look up companies — all through the [Productboard](https://productboard.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Productboard tool lets AI agents query product features, capture customer insights as notes, and browse your product portfolio — enabling data-driven product decisions and automated feedback management.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-productboard
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Productboard Personal Access Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'productboard' => [
        'access_token' => env('PRODUCTBOARD_ACCESS_TOKEN'),
        'url'          => env('PRODUCTBOARD_URL', 'https://api.productboard.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `productboard_list_features` | read | List features with cursor-based pagination |
| `productboard_get_feature` | read | Get details of a specific feature |
| `productboard_create_feature` | write | Create a new feature |
| `productboard_list_notes` | read | List notes (customer feedback) |
| `productboard_create_note` | write | Create a new note |
| `productboard_list_products` | read | List products |
| `productboard_list_companies` | read | List companies |
| `productboard_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\Integrations\Productboard\Tools\ProductboardListFeatures;
use OpenCompany\Integrations\Productboard\Tools\ProductboardCreateNote;

// Create tools
$service = app(ProductboardService::class);
$tools = [
    new ProductboardListFeatures($service),
    new ProductboardCreateNote($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What features are currently in development?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('productboard');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Productboard\Tools\ProductboardListFeatures::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Productboard\ProductboardService;

$service = app(ProductboardService::class);

// List features
$features = $service->listFeatures();

// Get a specific feature
$feature = $service->getFeature('feature_abc123');

// Create a feature
$newFeature = $service->createFeature([
    'name' => 'Dark Mode Support',
    'description' => 'Add a dark theme option',
    'product_id' => 'product_xyz789',
]);

// List notes
$notes = $service->listNotes();

// Create a note
$note = $service->createNote([
    'title' => 'Customer feedback: export feature',
    'content' => 'Enterprise customer needs bulk export',
]);

// List products and companies
$products = $service->listProducts();
$companies = $service->listCompanies();

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
- A [Productboard](https://productboard.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
