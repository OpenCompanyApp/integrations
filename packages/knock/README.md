# Integration: Knock

> Knock notification engine integration for the [Laravel AI SDK](https://github.com/laravel/ai) — trigger workflows, list messages, and manage recipients. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Knock](https://knock.app) notification engine. Trigger notification workflows, inspect message delivery, and manage recipients — all through the Knock API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Knock tool lets AI agents trigger notifications, monitor message delivery, and manage recipients — giving agents the ability to communicate through your configured notification channels.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-knock
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Knock API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'knock' => [
        'api_key' => env('KNOCK_API_KEY'),
        'url'     => env('KNOCK_URL', 'https://api.knock.app'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `knock_list_workflows` | read | List notification workflows |
| `knock_get_workflow` | read | Get details of a specific workflow |
| `knock_trigger_workflow` | write | Trigger a notification workflow for recipients |
| `knock_list_messages` | read | List notification messages with optional status filter |
| `knock_get_message` | read | Get details of a specific message |
| `knock_list_recipients` | read | List notification recipients |
| `knock_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Knock\KnockService;
use OpenCompany\Integrations\Knock\Tools\KnockListWorkflows;
use OpenCompany\Integrations\Knock\Tools\KnockTriggerWorkflow;

// Create tools
$service = app(KnockService::class);
$tools = [
    new KnockListWorkflows($service),
    new KnockTriggerWorkflow($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome notification to user@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('knock');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Knock\Tools\KnockTriggerWorkflow::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Knock\KnockService;

$service = app(KnockService::class);

// List workflows
$workflows = $service->listWorkflows();

// Get a workflow
$workflow = $service->getWorkflow('workflow-id');

// Trigger a workflow
$result = $service->triggerWorkflow('welcome', ['user-123'], [
    'name' => 'John',
]);

// List messages
$messages = $service->listMessages(status: 'delivered');

// List recipients
$recipients = $service->listRecipients();

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
- A [Knock](https://knock.app) account with API access

## License

MIT — see [LICENSE](LICENSE)
