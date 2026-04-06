# Integration: Pipedream

> Pipedream integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage workflows, components, triggers and connected accounts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Pipedream](https://pipedream.com) automation platform. List and inspect workflows, browse components, check connected accounts, and monitor event triggers — all through the Pipedream REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Pipedream tool lets AI agents inspect automation workflows, discover available components, and audit connected accounts — giving agents visibility into the organization's automation infrastructure.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pipedream
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Pipedream personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pipedream' => [
        'access_token' => env('PIPEDREAM_ACCESS_TOKEN'),
        'url'          => env('PIPEDREAM_URL', 'https://api.pipedream.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pipedream_list_workflows` | read | List automation workflows |
| `pipedream_get_workflow` | read | Get details of a specific workflow |
| `pipedream_list_components` | read | List available components (actions, triggers) |
| `pipedream_get_component` | read | Get details of a specific component |
| `pipedream_list_connected_accounts` | read | List connected third-party accounts |
| `pipedream_list_triggers` | read | List event triggers for a workflow |
| `pipedream_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamListWorkflows;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamGetCurrentUser;

// Create tools
$service = app(PipedreamService::class);
$tools = [
    new PipedreamListWorkflows($service),
    new PipedreamGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me my Pipedream workflows');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pipedream');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pipedream\Tools\PipedreamListWorkflows::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pipedream\PipedreamService;

$service = app(PipedreamService::class);

// List workflows
$workflows = $service->listWorkflows(page: 1, limit: 10);

// Get a specific workflow
$workflow = $service->getWorkflow('abc_123');

// List components
$components = $service->listComponents(type: 'action', limit: 20);

// Get a component
$component = $service->getComponent('slack', 'send-message');

// List connected accounts
$accounts = $service->listConnectedAccounts();

// List triggers for a workflow
$triggers = $service->listTriggers('abc_123');

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
- A [Pipedream](https://pipedream.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
