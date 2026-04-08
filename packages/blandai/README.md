# Integration: BlandAI

> BlandAI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — make AI-powered phone calls, retrieve call details, list calls, and analyze transcripts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to make and analyze phone calls using [BlandAI](https://www.bland.ai/). Initiate calls with custom instructions, retrieve transcripts, and extract insights — all through the BlandAI API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This BlandAI tool lets AI agents make phone calls, review call transcripts, and extract actionable insights from conversations — enabling voice-based outreach, follow-ups, and analysis.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-blandai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a BlandAI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'blandai' => [
        'api_key' => env('BLANDAI_API_KEY'),
        'url'     => env('BLANDAI_URL', 'https://api.bland.ai/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `blandai_make_call` | write | Initiate an AI-powered phone call |
| `blandai_get_call` | read | Retrieve details and transcript for a specific call |
| `blandai_list_calls` | read | List phone calls with optional pagination |
| `blandai_analyze_call` | read | Analyze a call transcript with a custom prompt |
| `blandai_get_current_user` | read | Get the authenticated user's account information |

## Quick Start

```php
use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIMakeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIListCalls;

// Create tools
$service = app(BlandAIService::class);
$tools = [
    new BlandAIMakeCall($service),
    new BlandAIListCalls($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Call +1234567890 and ask if the customer needs help');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('blandai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\BlandAI\Tools\BlandAIMakeCall::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\BlandAI\BlandAIService;

$service = app(BlandAIService::class);

// Make a call
$call = $service->makeCall(
    '+1234567890',
    'Ask the customer about their experience and collect feedback.',
    'josh'
);

// Get call details
$details = $service->getCall($call['call_id']);

// List recent calls
$calls = $service->listCalls(limit: 10);

// Analyze a call
$analysis = $service->analyzeCall(
    $call['call_id'],
    'Summarize the key points and action items from this call.'
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
- A [BlandAI](https://www.bland.ai/) account with API access

## License

MIT — see [LICENSE](LICENSE)
