# Integration: Retell AI

> Legacy compatibility wrapper for older `retell` installs.

New installs and new automations should use `opencompanyapp/integration-retell-ai` instead. The canonical `retell-ai` package has broader Retell API coverage and is the package shown in discovery catalogs.

Retell AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage AI voice calls, agents, and phone calls via the Retell AI API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to AI-powered voice calls. List and retrieve call details, manage voice agents, and initiate phone calls - all through the [Retell AI](https://retellai.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Retell AI tool lets AI agents manage voice calls, create and configure voice agents, and review call transcripts - enabling voice-aware automation workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-retell
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Retell AI API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'retell' => [
        'access_token' => env('RETELL_ACCESS_TOKEN'),
        'url'          => env('RETELL_URL', 'https://api.retellai.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `retell_list_calls` | read | List AI voice calls with filtering and pagination |
| `retell_get_call` | read | Get details of a specific call (transcript, duration, status) |
| `retell_create_phone_call` | write | Initiate a new AI-powered phone call |
| `retell_list_agents` | read | List all configured AI voice agents |
| `retell_get_agent` | read | Get details of a specific agent |
| `retell_create_agent` | write | Create a new AI voice agent |
| `retell_get_current_user` | read | Get the authenticated user's details |

## Quick Start

```php
use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\Integrations\Retell\Tools\RetellListCalls;
use OpenCompany\Integrations\Retell\Tools\RetellCreatePhoneCall;

// Create tools
$service = app(RetellService::class);
$tools = [
    new RetellListCalls($service),
    new RetellCreatePhoneCall($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent Retell calls and start a new one with agent abc123');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('retell');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Retell\Tools\RetellListCalls::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Retell\RetellService;

$service = app(RetellService::class);

// List calls
$calls = $service->listCalls(limit: 10);

// Get a specific call
$call = $service->getCall('call_abcdef123456');

// Create a phone call
$call = $service->createPhoneCall(
    agentId: 'agent_abcdef123456',
    metadata: ['customer' => 'Acme Corp'],
);

// List agents
$agents = $service->listAgents();

// Get an agent
$agent = $service->getAgent('agent_abcdef123456');

// Create an agent
$agent = $service->createAgent(
    model: 'gpt-4o',
    voiceId: '11labs-Adrian',
    prompt: 'You are a helpful customer support agent.',
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
- A [Retell AI](https://retellai.com) account with API access

## License

MIT - see [LICENSE](LICENSE)
