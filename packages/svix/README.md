# Integration: Svix

> Svix webhook service integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage applications, endpoints, and messages. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Svix](https://svix.com) webhook management. List and create applications, manage webhook endpoints, inspect message delivery — all through the Svix API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Svix tool lets AI agents manage webhook infrastructure — creating applications, configuring endpoints, and monitoring message delivery — giving agents the ability to orchestrate event-driven workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-svix
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Svix authentication token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'svix' => [
        'auth_token' => env('SVIX_AUTH_TOKEN'),
        'url'        => env('SVIX_URL', 'https://api.svix.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `svix_list_applications` | read | List all Svix applications |
| `svix_get_application` | read | Get details of a specific application |
| `svix_create_application` | write | Create a new Svix application |
| `svix_list_messages` | read | List messages for an application |
| `svix_list_endpoints` | read | List webhook endpoints for an application |
| `svix_create_endpoint` | write | Create a new webhook endpoint |
| `svix_get_current_user` | read | Get current authenticated user and dashboard usage |

## Quick Start

```php
use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\Integrations\Svix\Tools\SvixListApplications;
use OpenCompany\Integrations\Svix\Tools\SvixCreateEndpoint;

// Create tools
$service = app(SvixService::class);
$tools = [
    new SvixListApplications($service),
    new SvixCreateEndpoint($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Svix applications and their endpoints');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('svix');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Svix\Tools\SvixListApplications::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Svix\SvixService;

$service = app(SvixService::class);

// List applications
$apps = $service->listApplications();

// Get a specific application
$app = $service->getApplication('app_xxxxxxxxx');

// Create an application
$app = $service->createApplication('My App', 'my-app-uid');

// List endpoints for an application
$endpoints = $service->listEndpoints('app_xxxxxxxxx');

// Create an endpoint
$endpoint = $service->createEndpoint('app_xxxxxxxxx', 'https://example.com/webhooks', 1, 'Production webhook');

// List messages
$messages = $service->listMessages('app_xxxxxxxxx');

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
- A [Svix](https://svix.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
