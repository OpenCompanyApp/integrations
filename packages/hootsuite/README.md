# Integration: Hootsuite

> Hootsuite integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage messages, social profiles, and team members. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to social media management. Schedule posts, review messages, list connected social profiles, and look up team members — all through the [Hootsuite](https://hootsuite.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Hootsuite tool lets AI agents manage social media publishing, review scheduled messages, and coordinate team members — enabling automated social media workflows within the OpenCompany workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-hootsuite
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Hootsuite access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'hootsuite' => [
        'access_token' => env('HOOTSUITE_ACCESS_TOKEN'),
        'url'          => env('HOOTSUITE_URL', 'https://platform.hootsuite.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `hootsuite_list_messages` | read | List scheduled and past messages with optional time range and profile filters |
| `hootsuite_get_message` | read | Get details of a specific message by ID |
| `hootsuite_create_message` | write | Schedule a new social media message |
| `hootsuite_list_social_profiles` | read | List all connected social media profiles |
| `hootsuite_get_social_profile` | read | Get details of a specific social profile |
| `hootsuite_list_members` | read | List organization members |
| `hootsuite_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteListMessages;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteCreateMessage;

// Create tools
$service = app(HootsuiteService::class);
$tools = [
    new HootsuiteListMessages($service),
    new HootsuiteCreateMessage($service),
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
$provider = $registry->get('hootsuite');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Hootsuite\Tools\HootsuiteListMessages::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Hootsuite\HootsuiteService;

$service = app(HootsuiteService::class);

// List messages
$messages = $service->listMessages(
    startTime: '2025-01-01T00:00:00Z',
    endTime: '2025-01-31T23:59:59Z',
    limit: 20,
);

// Get a specific message
$message = $service->getMessage('123456789');

// Schedule a new message
$result = $service->createMessage(
    text: 'Check out our latest blog post!',
    socialProfileIds: ['12345', '67890'],
    scheduledSendTime: '2025-02-01T09:00:00Z',
);

// List social profiles
$profiles = $service->listSocialProfiles();

// Get a social profile
$profile = $service->getSocialProfile('12345');

// List members
$members = $service->listMembers(limit: 50);

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
- A [Hootsuite](https://hootsuite.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
