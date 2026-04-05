# Integration: Devin

> Devin AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create sessions, send messages, manage AI-powered tasks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Devin](https://devin.ai), the autonomous AI software engineer. Create sessions with task prompts, check session status, send follow-up messages, and manage AI-powered development workflows — all through the Devin API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Devin integration lets AI agents delegate software engineering tasks to Devin, monitor progress, and provide guidance — enabling multi-agent workflows where your agents orchestrate Devin sessions.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-devin
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Devin API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'devin' => [
        'api_key' => env('DEVIN_API_KEY'),
        'url'     => env('DEVIN_URL', 'https://api.devin.ai/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `devin_create_session` | write | Create a new Devin session with a task prompt |
| `devin_get_session` | read | Get details and status of a session |
| `devin_list_sessions` | read | List all Devin sessions |
| `devin_send_message` | write | Send a message to an active session |
| `devin_get_current_user` | read | Get the authenticated user info |

## Quick Start

```php
use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSession;
use OpenCompany\Integrations\Devin\Tools\DevinGetSession;

// Create tools
$service = app(DevinService::class);
$tools = [
    new DevinCreateSession($service),
    new DevinGetSession($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a Devin session to fix the login bug');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('devin');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Devin\Tools\DevinCreateSession::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Devin\DevinService;

$service = app(DevinService::class);

// Create a session
$session = $service->createSession('Build a REST API endpoint for user registration');

// Check session status
$status = $service->getSession($session['session_id']);

// Send a follow-up message
$service->sendMessage($session['session_id'], 'Also add input validation');

// List all sessions
$sessions = $service->listSessions();

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
- A [Devin](https://devin.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
