# Integration: Gong

> Gong revenue intelligence integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list calls, users, deals, and interactions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to revenue intelligence data from Gong. Retrieve call recordings, user profiles, deal pipeline data, and customer interactions — all through the Gong REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Gong tool lets AI agents query call recordings, review deal pipelines, and analyze customer interactions — giving agents sales intelligence context.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-gong
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Gong API access key and access key secret.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'gong' => [
        'access_key'        => env('GONG_ACCESS_KEY'),
        'access_key_secret' => env('GONG_ACCESS_KEY_SECRET'),
        'url'               => env('GONG_URL', 'https://api.gong.io'),
    ],
];
```

Generate API credentials in Gong under **Settings → API → Company API Keys**.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gong_list_calls` | read | List call recordings with date and participant filters |
| `gong_get_call` | read | Get detailed information about a specific call |
| `gong_list_users` | read | List users in the Gong workspace |
| `gong_list_deals` | read | List deals tracked in Gong |
| `gong_list_interactions` | read | List customer interactions (calls, emails, meetings) |
| `gong_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\Integrations\Gong\Tools\GongListCalls;
use OpenCompany\Integrations\Gong\Tools\GongGetCurrentUser;

// Create tools
$service = app(GongService::class);
$tools = [
    new GongListCalls($service),
    new GongGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all calls from the past week and summarize the key topics discussed.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('gong');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Gong\Tools\GongListCalls::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Gong\GongService;

$service = app(GongService::class);

// List calls from January 2025
$calls = $service->listCalls([
    'fromDateTime' => '2025-01-01T00:00:00Z',
    'toDateTime'   => '2025-01-31T23:59:59Z',
]);

// Get a specific call
$call = $service->getCall('1234567890');

// List users
$users = $service->listUsers();

// Get current user
$me = $service->getCurrentUser();

// List deals
$deals = $service->listDeals([
    'fromDateTime' => '2025-01-01T00:00:00Z',
]);

// List interactions
$interactions = $service->listInteractions([
    'activityTypes' => ['call', 'meeting'],
]);
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
- A [Gong](https://www.gong.io) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
