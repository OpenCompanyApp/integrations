# Integration: Perplexity

> Perplexity AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — chat completions, ask queries, model listing, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Perplexity's AI-powered search and answer engine. Ask questions, get cited answers, and use chat completions — all through the [Perplexity AI](https://perplexity.ai) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Perplexity tool lets AI agents search the web, get cited answers, and interact with Perplexity's language models — giving agents real-time knowledge retrieval capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-perplexity
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Perplexity AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'perplexity' => [
        'api_key' => env('PERPLEXITY_API_KEY'),
        'url'     => env('PERPLEXITY_URL', 'https://api.perplexity.ai'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `perplexity_chat` | read | Chat completions with multi-turn messages and citations |
| `perplexity_ask` | read | Ask a question and get a concise answer with cited sources |
| `perplexity_list_models` | read | List available Perplexity AI models |
| `perplexity_get_current_user` | read | Get authenticated user information |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityChat;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityAsk;

// Create tools
$service = app(PerplexityService::class);
$tools = [
    new PerplexityChat($service),
    new PerplexityAsk($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the latest developments in quantum computing?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 4 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('perplexity');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Perplexity\Tools\PerplexityAsk::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Perplexity\PerplexityService;

$service = app(PerplexityService::class);

// Chat completion
$response = $service->chat([
    ['role' => 'system', 'content' => 'Be precise and concise.'],
    ['role' => 'user', 'content' => 'What is the capital of France?'],
], 'sonar');

// Ask a question
$answer = $service->ask('What are the latest developments in AI?');

// List models
$models = $service->listModels();

// Get current user
$user = $service->getCurrentUser();
```

## Available Models

| Model | Description |
|-------|-------------|
| `sonar` | Fast, lightweight search-grounded responses |
| `sonar-pro` | Advanced model with deeper search and reasoning |
| `sonar-reasoning` | Reasoning-focused model |
| `sonar-reasoning-pro` | Advanced reasoning with comprehensive search |

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Perplexity AI](https://perplexity.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
