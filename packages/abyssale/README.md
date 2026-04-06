# Integration: Abyssale

> Abyssale image generation integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage templates, formats, and generate images. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to automated image generation. Browse templates, list formats, and generate custom images through the [Abyssale](https://abyssale.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Abyssale tool lets AI agents browse design templates, discover output formats, and generate images — giving agents creative automation capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-abyssale
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Abyssale access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'abyssale' => [
        'access_token' => env('ABYSSALE_ACCESS_TOKEN'),
        'url'          => env('ABYSSALE_URL', 'https://api.abyssale.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `abyssale_list_generations` | read | List image generation jobs with pagination and status filter |
| `abyssale_get_generation` | read | Get details of a specific image generation |
| `abyssale_create_generation` | write | Generate images from a template with custom modifications |
| `abyssale_list_templates` | read | List available design templates |
| `abyssale_get_template` | read | Get details of a specific template |
| `abyssale_list_formats` | read | List available output formats |
| `abyssale_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListTemplates;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleCreateGeneration;

// Create tools
$service = app(AbyssaleService::class);
$tools = [
    new AbyssaleListTemplates($service),
    new AbyssaleCreateGeneration($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Abyssale templates and generate a banner from the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('abyssale');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Abyssale\Tools\AbyssaleListTemplates::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Abyssale\AbyssaleService;

$service = app(AbyssaleService::class);

// List templates
$templates = $service->listTemplates();

// Get a specific template
$template = $service->getTemplate('tmpl_abc123');

// List formats
$formats = $service->listFormats();

// Generate images
$generation = $service->createGeneration(
    'tmpl_abc123',
    ['fmt_abc123', 'fmt_def456'],
    [
        'headline' => ['payload' => 'New Banner Text'],
        'background_image' => ['payload' => 'https://example.com/bg.jpg'],
    ]
);

// Check generation status
$status = $service->getGeneration('gen_xyz789');

// List generations
$generations = $service->listGenerations(1, 20, 'finished');
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
- An [Abyssale](https://abyssale.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
