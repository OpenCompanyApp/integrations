# Integration: Unbounce

> Unbounce integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list pages, manage leads, sub accounts, and more. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Unbounce landing page platform. List landing pages, retrieve form submissions (leads), and manage sub-accounts — all through the [Unbounce API](https://developer.unbounce.com/api_reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Unbounce tool lets AI agents query landing pages, retrieve lead data, and monitor conversion marketing performance — giving agents marketing-awareness and lead management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-unbounce
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Unbounce API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'unbounce' => [
        'access_token' => env('UNBOUNCE_ACCESS_TOKEN'),
        'url'          => env('UNBOUNCE_URL', 'https://api.unbounce.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `unbounce_list_pages` | read | List landing pages with pagination and sorting |
| `unbounce_get_page` | read | Get details of a specific landing page |
| `unbounce_list_leads` | read | List form submissions (leads) for a page |
| `unbounce_get_lead` | read | Get details of a specific lead |
| `unbounce_list_sub_accounts` | read | List sub-accounts in Unbounce |
| `unbounce_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListPages;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListLeads;

// Create tools
$service = app(UnbounceService::class);
$tools = [
    new UnbounceListPages($service),
    new UnbounceListLeads($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the top 5 landing pages by conversion rate');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('unbounce');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Unbounce\Tools\UnbounceListPages::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Unbounce\UnbounceService;

$service = app(UnbounceService::class);

// List pages
$pages = $service->listPages(limit: 20, sort: '-created_at');

// Get a page
$page = $service->getPage('a2834fde-1234-5678-abcd-1234567890ab');

// List leads for a page
$leads = $service->listLeads('a2834fde-1234-5678-abcd-1234567890ab', limit: 25);

// Get a lead
$lead = $service->getLead('b3945gef-2345-6789-bcde-2345678901bc');

// List sub-accounts
$subAccounts = $service->listSubAccounts();

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
- An [Unbounce](https://unbounce.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
