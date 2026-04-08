# Integration: Bitly

> Bitly integration for the [Laravel AI SDK](https://github.com/laravel/ai) — shorten links, manage Bitlinks, track clicks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to link management. Shorten URLs, create and update Bitlinks with metadata, track click analytics, and manage groups — all through the [Bitly API](https://dev.bitly.com).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Bitly tool lets AI agents shorten URLs, manage link metadata, and track click performance — giving agents the ability to handle link operations as part of automated workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-bitly
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Bitly access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'bitly' => [
        'access_token' => env('BITLY_ACCESS_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `bitly_shorten_link` | write | Shorten a long URL into a Bitlink |
| `bitly_get_link` | read | Retrieve details for a Bitlink |
| `bitly_update_link` | write | Update a Bitlink's title, tags, or archived status |
| `bitly_get_clicks` | read | Get click metrics for a Bitlink |
| `bitly_list_groups` | read | List all groups in the account |
| `bitly_get_group` | read | Retrieve details for a specific group |
| `bitly_create_bitlink` | write | Create a new Bitlink with title and tags |
| `bitly_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\Integrations\Bitly\Tools\BitlyShortenLink;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClicks;

// Create tools
$service = app(BitlyService::class);
$tools = [
    new BitlyShortenLink($service),
    new BitlyGetClicks($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Shorten this URL and track its clicks: https://example.com/long-path');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('bitly');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Bitly\Tools\BitlyShortenLink::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Bitly\BitlyService;

$service = app(BitlyService::class);

// Shorten a URL
$link = $service->shortenLink('https://example.com/long-path');

// Create a Bitlink with metadata
$link = $service->createBitlink(
    'https://example.com/campaign',
    title: 'Q1 Campaign',
    tags: ['marketing', 'q1'],
);

// Get click metrics
$clicks = $service->getClicks('bit.ly/abc123', unit: 'day', units: 30);

// List groups
$groups = $service->listGroups();
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
- A [Bitly](https://bitly.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
