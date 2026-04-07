# Integration: Buffer

> Buffer integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage social media profiles and scheduled updates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to social media management. Schedule posts, review pending and sent updates, list connected social profiles, and look up account details — all through the [Buffer](https://buffer.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Buffer tool lets AI agents manage social media publishing, review scheduled updates, and coordinate profiles — enabling automated social media workflows within the OpenCompany workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-buffer
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Buffer access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'buffer' => [
        'access_token' => env('BUFFER_ACCESS_TOKEN'),
        'url'          => env('BUFFER_URL', 'https://api.bufferapp.com/1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `buffer_list_profiles` | read | List all connected social media profiles |
| `buffer_get_profile` | read | Get details of a specific social profile by ID |
| `buffer_list_pending_updates` | read | List scheduled (pending) updates for a profile |
| `buffer_create_update` | write | Create and schedule a new social media update |
| `buffer_list_sent_updates` | read | List already posted (sent) updates for a profile |
| `buffer_get_update` | read | Get details of a specific update by ID |
| `buffer_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\Integrations\Buffer\Tools\BufferListPendingUpdates;
use OpenCompany\Integrations\Buffer\Tools\BufferCreateUpdate;

// Create tools
$service = app(BufferService::class);
$tools = [
    new BufferListPendingUpdates($service),
    new BufferCreateUpdate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our scheduled social media posts for this week');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('buffer');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Buffer\Tools\BufferListPendingUpdates::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Buffer\BufferService;

$service = app(BufferService::class);

// List profiles
$profiles = $service->listProfiles();

// Get a specific profile
$profile = $service->getProfile('4eb8572a512f7f621800004e');

// List pending updates
$pending = $service->listPendingUpdates('4eb8572a512f7f621800004e', count: 20, page: 1);

// Create and schedule an update
$result = $service->createUpdate(
    text: 'Check out our latest blog post! https://example.com/blog',
    profileIds: ['4eb8572a512f7f621800004e', '4eb8572a512f7f6218000050'],
    scheduledAt: '2025-02-01T09:00:00Z',
);

// List sent updates
$sent = $service->listSentUpdates('4eb8572a512f7f621800004e', count: 10);

// Get a specific update
$update = $service->getUpdate('4eb8586e512f7f621800005d');

// Get current user
$me = $service->getCurrentUser();
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
- A [Buffer](https://buffer.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
