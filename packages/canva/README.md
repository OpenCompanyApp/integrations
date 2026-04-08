# Integration: Canva

> Canva integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list and create designs, manage folders, upload assets, and get user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Canva's design platform. Browse designs, create new ones, manage folders, and upload assets — all through the [Canva Connect API](https://www.canva.dev/docs/connect/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Canva tool lets AI agents manage designs and assets — giving agents the ability to create, browse, and organize visual content in Canva.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-canva
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Canva Connect API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'canva' => [
        'access_token' => env('CANVA_ACCESS_TOKEN'),
        'url'          => env('CANVA_API_URL', 'https://api.canva.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `canva_list_designs` | read | List designs with optional search and type filtering |
| `canva_get_design` | read | Get details of a specific design by ID |
| `canva_create_design` | write | Create a new design with title, type, and dimensions |
| `canva_list_folders` | read | List folders the user has access to |
| `canva_get_folder` | read | Get details of a specific folder by ID |
| `canva_upload_asset` | write | Upload an asset to Canva from a URL |
| `canva_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\Integrations\Canva\Tools\CanvaListDesigns;
use OpenCompany\Integrations\Canva\Tools\CanvaCreateDesign;

// Create tools
$service = app(CanvaService::class);
$tools = [
    new CanvaListDesigns($service),
    new CanvaCreateDesign($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent Canva presentations');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('canva');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Canva\Tools\CanvaListDesigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Canva\CanvaService;

$service = app(CanvaService::class);

// List designs
$designs = $service->listDesigns(limit: 10, query: 'marketing');

// Get a specific design
$design = $service->getDesign(' DESIGN_ID');

// Create a design
$design = $service->createDesign(
    title: 'Q4 Marketing Plan',
    type: 'presentation',
    width: 1920,
    height: 1080,
);

// List folders
$folders = $service->listFolders();

// Upload an asset
$asset = $service->uploadAsset(
    fileUrl: 'https://example.com/image.png',
    name: 'Hero Image',
    folderId: 'FOLDER_ID',
);

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
- A [Canva](https://www.canva.com) account with Connect API access

## License

MIT — see [LICENSE](LICENSE)
