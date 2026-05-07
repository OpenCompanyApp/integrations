# Integration: Bland AI

> Bland AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage AI phone calls, batches, voices, knowledge bases, and custom call tools. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to make and analyze phone calls using [Bland AI](https://www.bland.ai/). Initiate calls, manage batches, inspect voices, create knowledge bases, and register custom tools through the documented Bland AI API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Bland AI tool lets agents make phone calls, review call transcripts, extract insights, and prepare voice-agent support resources for outreach and follow-up workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-blandai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Bland AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'blandai' => [
        'api_key' => env('BLANDAI_API_KEY'),
        'url'     => env('BLANDAI_URL', 'https://api.bland.ai'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `blandai_make_call` | write | Initiate an AI-powered phone call |
| `blandai_get_call` | read | Retrieve details and transcript for a specific call |
| `blandai_list_calls` | read | List phone calls with optional filters |
| `blandai_stop_call` | write | Stop one active call |
| `blandai_stop_all_active_calls` | write | Stop all active calls |
| `blandai_analyze_call` | read | Analyze a call transcript |
| `blandai_create_batch` | write | Create a batch or campaign |
| `blandai_list_batches` | read | List batches and campaigns |
| `blandai_list_voices` | read | List available voices |
| `blandai_get_voice` | read | Get voice details |
| `blandai_list_knowledge_bases` | read | List knowledge bases |
| `blandai_create_text_knowledge_base` | write | Create a text knowledge base |
| `blandai_update_knowledge_base` | write | Update knowledge base metadata |
| `blandai_chat_knowledge_base` | write | Chat with a knowledge base |
| `blandai_create_tool` | write | Create a custom call tool |
| `blandai_get_current_user` | read | Compatibility credential check |

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

If you have `integration-core` installed, all 16 tools auto-register with the `ToolProviderRegistry`:

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
$calls = $service->listCalls(['limit' => 10]);

// Analyze a call
$analysis = $service->analyzeCall(
    $call['call_id'],
    'Summarize the key points and action items from this call.',
    [['Did the customer request follow up?', 'boolean']]
);

// List voices and batches
$voices = $service->listVoices();
$batches = $service->listBatches(['take' => 10]);
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
