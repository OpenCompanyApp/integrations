# Integration: Google Gemini

> Google Gemini AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list models, generate content, manage files and tuned models. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Gemini generative AI. List available models, generate content from prompts, manage uploaded files, and browse tuned models — all through the [Gemini API](https://ai.google.dev/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Gemini tool lets AI agents query available models, generate text content, and manage AI resources — giving agents powerful generative capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-gemini
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google Gemini API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
        'url'     => env('GEMINI_URL', 'https://generativelanguage.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gemini_list_models` | read | List available Gemini AI models |
| `gemini_get_model` | read | Get details for a specific model |
| `gemini_generate_content` | write | Generate content using a Gemini model |
| `gemini_list_files` | read | List uploaded files |
| `gemini_get_file` | read | Get details for an uploaded file |
| `gemini_list_tuned_models` | read | List tuned (fine-tuned) models |
| `gemini_get_current_user` | read | Get authenticated user info |

## Quick Start

```php
use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiListModels;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiGenerateContent;

// Create tools
$service = app(GeminiService::class);
$tools = [
    new GeminiListModels($service),
    new GeminiGenerateContent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List available Gemini models and generate a haiku about AI.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-gemini');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleGemini\Tools\GeminiGenerateContent::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleGemini\GeminiService;

$service = app(GeminiService::class);

// List models
$models = $service->listModels();

// Get a specific model
$model = $service->getModel('models/gemini-2.0-flash');

// Generate content
$result = $service->generateContent('models/gemini-2.0-flash', [
    ['role' => 'user', 'parts' => [['text' => 'Write a poem about the sea.']]],
], [
    'temperature' => 0.7,
    'maxOutputTokens' => 256,
]);

// List files
$files = $service->listFiles();

// List tuned models
$tuned = $service->listTunedModels();

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
- A [Google AI Studio](https://aistudio.google.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
