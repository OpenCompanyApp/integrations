# Integration: Typefully

> Typefully integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create drafts, list scheduled and published content, manage your Typefully account. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Typefully](https://typefully.com) for writing, scheduling, and publishing tweets, threads, and newsletters. Create drafts, review your content calendar, and manage your social media presence — all through the Typefully API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Typefully tool lets AI agents create and manage social media drafts, review scheduled content, and track published posts — enabling agents to act as social media assistants.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-typefully
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Typefully API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'typefully' => [
        'api_key' => env('TYPEFULLY_API_KEY'),
        'url'     => env('TYPEFULLY_URL', 'https://api.typefully.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `typefully_create_draft` | write | Create a new tweet, thread, or newsletter draft |
| `typefully_list_scheduled` | read | List scheduled drafts awaiting publication |
| `typefully_list_published` | read | List already published drafts |
| `typefully_get_draft` | read | Get details of a specific draft by ID |
| `typefully_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\Integrations\Typefully\Tools\TypefullyCreateDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListScheduled;

// Create tools
$service = app(TypefullyService::class);
$tools = [
    new TypefullyCreateDraft($service),
    new TypefullyListScheduled($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a thread about Laravel tips and schedule it for tomorrow at 9am');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('typefully');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Typefully\Tools\TypefullyCreateDraft::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Typefully\TypefullyService;

$service = app(TypefullyService::class);

// Get current user
$user = $service->getCurrentUser();

// Create a tweet draft
$draft = $service->createDraft('Hello from the API! 🚀');

// Create a scheduled thread
$thread = $service->createDraft(
    "Tip 1: Keep it short.\n\n\n\nTip 2: Use hooks.\n\n\n\nTip 3: End with a CTA.",
    'thread',
    ['schedule_date' => '2026-04-10T09:00:00Z']
);

// List scheduled drafts
$scheduled = $service->listScheduled();

// List published drafts
$published = $service->listPublished();

// Get a specific draft
$draft = $service->getDraft('draft-id-here');
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
- A [Typefully](https://typefully.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
