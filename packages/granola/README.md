# Integration: Granola

> Granola meeting notes integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list meetings, get transcripts, create notes, share meetings. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to meeting transcripts, notes, and sharing through the [Granola](https://granola.ai) API. Search past meetings, retrieve detailed transcripts, add notes, and share meeting content with teammates.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Granola tool lets AI agents browse meeting history, retrieve transcripts and notes, create new notes, and share meetings — giving agents full context from conversations and meetings.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-granola
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Granola API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'granola' => [
        'api_key' => env('GRANOLA_API_KEY'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `granola_list_meetings` | read | List recent meetings with optional search |
| `granola_get_meeting` | read | Get a single meeting with full transcript and notes |
| `granola_create_note` | write | Create a note on a meeting |
| `granola_share_meeting` | write | Share a meeting with others |
| `granola_get_current_user` | read | Get the current authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\Integrations\Granola\Tools\GranolaListMeetings;
use OpenCompany\Integrations\Granola\Tools\GranolaGetMeeting;

// Create tools
$service = app(GranolaService::class);
$tools = [
    new GranolaListMeetings($service),
    new GranolaGetMeeting($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What meetings did I have yesterday?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('granola');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Granola\Tools\GranolaListMeetings::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Granola\GranolaService;

$service = app(GranolaService::class);

// List recent meetings
$meetings = $service->listMeetings(['limit' => 10]);

// Get a specific meeting
$meeting = $service->getMeeting('meeting-id-123');

// Create a note
$note = $service->createNote('meeting-id-123', [
    'content' => 'Follow up on action items from Q1 review',
]);

// Share a meeting
$service->shareMeeting('meeting-id-123', [
    'emails' => ['team@example.com'],
]);

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
- A [Granola](https://granola.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
