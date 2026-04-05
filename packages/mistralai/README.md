# Integration: MistralAI

> MistralAI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — chat completions, embeddings, model management, fine-tuning, and agent management. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [MistralAI](https://mistral.ai) platform. Generate chat completions, create text embeddings, manage models, fine-tune custom models, and create AI agents — all through the MistralAI API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MistralAI tool lets AI agents interact with MistralAI's powerful language models, create embeddings for semantic search, manage fine-tuning jobs, and orchestrate MistralAI agents — giving agents advanced AI capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mistralai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a MistralAI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mistralai' => [
        'api_key' => env('MISTRALAI_API_KEY'),
        'url'     => env('MISTRALAI_URL', 'https://api.mistral.ai/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mistralai_chat` | write | Generate chat completions using MistralAI models |
| `mistralai_create_embedding` | write | Generate text embeddings for semantic search and similarity |
| `mistralai_list_models` | read | List available MistralAI models |
| `mistralai_finetune` | write | Create a fine-tuning job |
| `mistralai_list_agents` | read | List MistralAI agents |
| `mistralai_create_agent` | write | Create a new MistralAI agent |
| `mistralai_get_current_user` | read | Get authenticated user information |

## Quick Start

```php
use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIChat;
use OpenCompany\Integrations\MistralAI\Tools\MistralAIListModels;

// Create tools
$service = app(MistralAIService::class);
$tools = [
    new MistralAIChat($service),
    new MistralAIListModels($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What MistralAI models are available?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mistralai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MistralAI\Tools\MistralAIChat::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MistralAI\MistralAIService;

$service = app(MistralAIService::class);

// Chat completion
$response = $service->chat('mistral-large-latest', [
    ['role' => 'user', 'content' => 'Hello, how are you?'],
], temperature: 0.7);

// Create embeddings
$embeddings = $service->createEmbedding('mistral-embed', 'Hello world');

// List models
$models = $service->listModels();

// Create an agent
$agent = $service->createAgent(
    name: 'Support Bot',
    model: 'mistral-large-latest',
    instructions: 'You are a helpful customer support assistant.',
);
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
- A [MistralAI](https://mistral.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
