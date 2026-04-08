# Integration: Phantombuster

> Phantombuster integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage agents, launch tasks, and monitor containers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Phantombuster's automation platform. List and inspect agents, launch automations, and monitor execution containers — all through the Phantombuster API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Phantombuster tool lets AI agents manage automation agents, launch scraping tasks, and monitor execution status — enabling autonomous workflow orchestration.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-phantombuster
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Phantombuster API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'phantombuster' => [
        'api_key' => env('PHANTOMBUSTER_API_KEY'),
        'url'     => env('PHANTOMBUSTER_URL', 'https://api.phantombuster.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `phantombuster_list_agents` | read | List all Phantombuster agents |
| `phantombuster_get_agent` | read | Get details for a specific agent |
| `phantombuster_launch_agent` | write | Launch an agent to start an automation |
| `phantombuster_list_containers` | read | List all containers (execution history) |
| `phantombuster_get_container` | read | Get details for a specific container |
| `phantombuster_get_current_user` | read | Get authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListAgents;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterLaunchAgent;

// Create tools
$service = app(PhantombusterService::class);
$tools = [
    new PhantombusterListAgents($service),
    new PhantombusterLaunchAgent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Phantombuster agents and launch the LinkedIn one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('phantombuster');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListAgents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Phantombuster\PhantombusterService;

$service = app(PhantombusterService::class);

// Get current user
$user = $service->getCurrentUser();

// List agents
$agents = $service->listAgents();

// Get a specific agent
$agent = $service->getAgent('1234567890123456789');

// Launch an agent
$container = $service->launchAgent('1234567890123456789');

// List containers (execution history)
$containers = $service->listContainers();

// Get a specific container
$container = $service->getContainer('9876543210987654321');
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
- A [Phantombuster](https://phantombuster.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
