# Integration: DeepL

> DeepL translation integration for the [Laravel AI SDK](https://github.com/laravel/ai) — translate text, batch translate, detect languages, check usage. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to AI-powered translation via the [DeepL API](https://www.deepl.com). Translate text, detect languages, and manage translation usage — all through a clean Laravel integration.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This DeepL tool lets AI agents translate content, detect languages, and manage translation resources — enabling multilingual communication across the workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-deepl
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a DeepL authentication key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'deepl' => [
        'auth_key' => env('DEEPL_AUTH_KEY'),
        'is_free'  => env('DEEPL_FREE_API', false),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `deepl_translate` | write | Translate a single text string |
| `deepl_batch_translate` | write | Translate multiple texts at once |
| `deepl_detect_language` | read | Detect the language of a text |
| `deepl_get_usage` | read | Check API usage and character limits |
| `deepl_list_languages` | read | List supported source and target languages |

## Quick Start

```php
use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\Integrations\DeepL\Tools\DeepLTranslate;
use OpenCompany\Integrations\DeepL\Tools\DeepLBatchTranslate;

// Create tools
$service = app(DeepLService::class);
$tools = [
    new DeepLTranslate($service),
    new DeepLBatchTranslate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Translate "Good morning" to French, German, and Japanese');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('deepl');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\DeepL\Tools\DeepLTranslate::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\DeepL\DeepLService;

$service = app(DeepLService::class);

// Translate text
$result = $service->translate('Hello world', 'DE');
// ['translations' => [['text' => 'Hallo Welt', 'detected_source_language' => 'EN']]]

// Batch translate
$result = $service->batchTranslate(['Hello', 'Goodbye'], 'FR');

// Detect language
$result = $service->detectLanguage('Bonjour le monde');
// ['language_code' => 'FR', ...]

// Check usage
$result = $service->getUsage();
// ['character_count' => 1234, 'character_limit' => 500000, ...]

// List languages
$result = $service->listLanguages('target');
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
- A [DeepL](https://www.deepl.com) account with API access (free or pro)

## License

MIT — see [LICENSE](LICENSE)
