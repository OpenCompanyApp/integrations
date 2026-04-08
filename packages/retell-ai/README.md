# Integration: Retell AI

> Retell AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create and manage AI-powered phone calls and voice agents. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to voice calling capabilities. Create phone calls using AI voice agents, retrieve call details and transcripts, and manage voice agent configurations — all through the [Retell AI](https://retellai.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Retell AI tool lets AI agents initiate phone calls, monitor call progress, and manage voice agents — enabling conversational AI workflows that reach beyond text-based interactions.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-retell-ai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Retell AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'retell-ai' => [
        'api_key' => env('RETELL_AI_API_KEY'),
        'url'     => env('RETELL_AI_URL', 'https://api.retellai.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `retell_ai_create_call` | write | Create a new AI-powered phone call |
| `retell_ai_get_call` | read | Retrieve details for a specific call |
| `retell_ai_list_calls` | read | List phone calls with optional filters |
| `retell_ai_list_agents` | read | List all configured voice agents |
| `retell_ai_create_agent` | write | Create a new voice AI agent |
| `retell_ai_get_current_user` | read | Retrieve current account information |

## Quick Start

```php
use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\Integrations\RetellAI\Tools\RetellAICreateCall;
use OpenCompany\Integrations\RetellAI\Tools\RetellAIListAgents;

// Create tools
$service = app(RetellAIService::class);
$tools = [
    new RetellAICreateCall($service),
    new RetellAIListAgents($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our voice agents and start an onboarding call for customer #12345');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('retell-ai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\RetellAI\Tools\RetellAICreateCall::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\RetellAI\RetellAIService;

$service = app(RetellAIService::class);

// List agents
$agents = $service->listAgents();

// Create a call
$call = $service->createCall('agent_17a9b81c3c0', [
    'customer_id' => '12345',
    'campaign' => 'onboarding',
]);

// Get call details
$details = $service->getCall('call_17a9b81c3c0');

// List calls
$calls = $service->listCalls(['agent_id' => 'agent_17a9b81c3c0']);

// Create an agent
$agent = $service->createAgent('11labs_Alice', 'You are a helpful support agent.');
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

MIT — see [LICENSE](LICENSE)
