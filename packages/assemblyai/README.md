# Integration: AssemblyAI

> AssemblyAI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — transcribe audio, manage transcripts, upload files, and access account info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful speech-to-text capabilities. Transcribe audio and video files, retrieve completed transcripts, upload local files, and manage your AssemblyAI account — all through the [AssemblyAI](https://www.assemblyai.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This AssemblyAI tool lets AI agents transcribe audio and video files, monitor transcription status, and access AI-powered audio intelligence features like speaker diarization, sentiment analysis, and summarization — giving agents the ability to work with spoken content.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-assemblyai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an AssemblyAI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'assemblyai' => [
        'api_key' => env('ASSEMBLYAI_API_KEY'),
        'url'     => env('ASSEMBLYAI_URL', 'https://api.assemblyai.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `assemblyai_transcribe` | write | Submit an audio/video URL for AI transcription |
| `assemblyai_get_transcript` | read | Retrieve a transcript by ID (status, text, features) |
| `assemblyai_list_transcripts` | read | List transcripts with filtering and pagination |
| `assemblyai_upload` | write | Upload a local audio/video file for transcription |
| `assemblyai_get_lemons` | read | Retrieve billing credits and usage information |
| `assemblyai_get_current_user` | read | Get the authenticated user's profile and plan info |

## Quick Start

```php
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAITranscribe;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAIGetTranscript;

// Create tools
$service = app(AssemblyAIService::class);
$tools = [
    new AssemblyAITranscribe($service),
    new AssemblyAIGetTranscript($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Transcribe https://example.com/meeting.mp3 and summarize it');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('assemblyai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAITranscribe::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

$service = app(AssemblyAIService::class);

// Submit transcription
$transcript = $service->transcribe([
    'audio_url' => 'https://example.com/podcast.mp3',
    'speaker_labels' => true,
    'summarization' => true,
]);

// Check status
$result = $service->getTranscript($transcript['id']);

// List recent transcripts
$transcripts = $service->listTranscripts(['limit' => 10, 'status' => 'completed']);

// Upload a local file
$upload = $service->upload('/tmp/recording.mp3');
$transcript = $service->transcribe(['audio_url' => $upload['upload_url']]);

// Account info
$user = $service->getCurrentUser();
$lemons = $service->getLemons();
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
- An [AssemblyAI](https://www.assemblyai.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
