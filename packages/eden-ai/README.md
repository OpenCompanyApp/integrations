# Integration: Eden AI

> Eden AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — text generation, image analysis, translation, audio transcription, OCR, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful AI capabilities through a single, unified API. Generate text, analyze images, translate between languages, transcribe audio, extract text from documents — all through the [Eden AI](https://edenai.co) aggregation platform.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Eden AI tool lets AI agents leverage multiple AI providers through a single integration — enabling text generation, image analysis, translation, transcription, and OCR without managing individual provider accounts.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-eden-ai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Eden AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'eden-ai' => [
        'api_key' => env('EDENAI_API_KEY'),
        'url'     => env('EDENAI_URL', 'https://api.edenai.run/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `edenai_generate_text` | write | Generate text using AI models (GPT-4, Claude, Gemini, etc.) |
| `edenai_analyze_image` | read | Analyze images for objects, content, and features |
| `edenai_translate_text` | write | Translate text between 50+ languages |
| `edenai_transcribe_audio` | read | Convert audio and video to text |
| `edenai_ocr` | read | Extract text from images and documents |
| `edenai_get_current_user` | read | Get account information and usage |

## Quick Start

```php
use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiGenerateText;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiTranslateText;

// Create tools
$service = app(EdenAiService::class);
$tools = [
    new EdenAiGenerateText($service),
    new EdenAiTranslateText($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Translate "Hello, world!" to French, German, and Japanese');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('eden-ai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\EdenAi\Tools\EdenAiGenerateText::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\EdenAi\EdenAiService;

$service = app(EdenAiService::class);

// Generate text
$result = $service->generateText([
    'providers' => 'openai',
    'text' => 'Explain quantum computing in one paragraph.',
    'temperature' => 0.7,
    'max_tokens' => 256,
]);

// Translate text
$translation = $service->translateText([
    'providers' => 'google',
    'text' => 'Hello, world!',
    'source_language' => 'en',
    'target_language' => 'fr',
]);

// Transcribe audio
$transcription = $service->transcribeAudio([
    'providers' => 'openai',
    'file_url' => 'https://example.com/recording.mp3',
    'language' => 'en',
]);

// OCR
$ocr = $service->ocr([
    'providers' => 'google',
    'file_url' => 'https://example.com/document.pdf',
]);

// Get current user
$user = $service->getCurrentUser();
```

## Supported Providers

Eden AI aggregates multiple AI providers. Common provider names:

| Capability | Providers |
|------------|-----------|
| Text Generation | `openai`, `anthropic`, `google`, `mistral`, `cohere`, `meta` |
| Image Analysis | `google`, `amazon`, `microsoft` |
| Translation | `google`, `deepl`, `amazon`, `microsoft` |
| Audio Transcription | `openai`, `google`, `amazon`, `microsoft` |
| OCR | `google`, `amazon`, `microsoft`, `mindee` |

See the [Eden AI documentation](https://docs.edenai.co/reference) for the full list of providers and capabilities.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- An [Eden AI](https://edenai.co) account with API access

## License

MIT — see [LICENSE](LICENSE)
