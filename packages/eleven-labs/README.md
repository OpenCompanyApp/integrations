# Integration: ElevenLabs Legacy Wrapper

This package is retained for compatibility with the old `eleven-labs` package ID. New integrations should use `opencompanyapp/integration-elevenlabs`, which is the canonical ElevenLabs package with broader API coverage.

> Legacy ElevenLabs integration for the [Laravel AI SDK](https://github.com/laravel/ai). Prefer `opencompanyapp/integration-elevenlabs` for new installs.

Give your AI agents access to AI-powered voice synthesis and sound generation. Generate speech from text, create sound effects, browse voices and models through the [ElevenLabs](https://elevenlabs.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace, with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ElevenLabs tool lets AI agents generate speech and sound effects, browse available voices and models, and check account usage, enabling rich audio experiences within automated workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-elevenlabs
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an ElevenLabs API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'eleven-labs' => [
        'api_key' => env('ELEVENLABS_API_KEY'),
        'url'     => env('ELEVENLABS_URL', 'https://api.elevenlabs.io'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `elevenlabs_list_voices` | read | List available voices with names, IDs, and preview URLs |
| `elevenlabs_get_voice` | read | Get detailed information about a specific voice |
| `elevenlabs_generate_speech` | write | Generate speech audio from text using a voice |
| `elevenlabs_generate_sound` | write | Generate a sound effect from a text description |
| `elevenlabs_list_models` | read | List available ElevenLabs models |
| `elevenlabs_get_current_user` | read | Get user profile and subscription details |

## Quick Start

```php
use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGenerateSpeech;
use OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsListVoices;

// Create tools
$service = app(ElevenLabsService::class);
$tools = [
    new ElevenLabsListVoices($service),
    new ElevenLabsGenerateSpeech($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List available voices and generate a greeting using the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('eleven-labs');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ElevenLabs\Tools\ElevenLabsGenerateSpeech::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;

$service = app(ElevenLabsService::class);

// List voices
$voices = $service->listVoices();

// Generate speech
$audio = $service->generateSpeech(
    text: 'Hello, welcome to our platform!',
    voiceId: '21m00Tcm4TlvDq8ikWAM',
    modelId: 'eleven_multilingual_v2',
    stability: 0.5,
    similarityBoost: 0.75,
);

// Generate a sound effect
$sound = $service->generateSound('thunder rumbling in the distance');

// List models
$models = $service->listModels();

// Check user info
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
- An [ElevenLabs](https://elevenlabs.io) account with API access

## License

MIT - see [LICENSE](LICENSE)
