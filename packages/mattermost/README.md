# Integration: Mattermost

> Mattermost integration for the [Laravel AI SDK](https://github.com/laravel/ai) - list channels, posts, teams, send messages, and manage workspace communication. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to team messaging and communication. List channels and posts, send messages, discover teams, and retrieve user profiles - all through the [Mattermost API v4](https://developers.mattermost.com/api-documentation/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mattermost tool lets AI agents interact with team channels, read and send messages, and navigate team structures - enabling agents to participate in communication workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mattermost
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Mattermost personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mattermost' => [
        'access_token' => env('MATTERMOST_ACCESS_TOKEN'),
        'url'          => env('MATTERMOST_URL', 'https://mattermost.example.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mattermost_list_channels` | read | List channels the current user belongs to |
| `mattermost_get_channel` | read | Get details of a specific channel |
| `mattermost_create_post` | write | Post a message to a channel |
| `mattermost_list_posts` | read | List posts in a channel |
| `mattermost_get_post` | read | Get a specific post by ID |
| `mattermost_list_teams` | read | List teams the current user belongs to |
| `mattermost_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\Integrations\Mattermost\Tools\MattermostListChannels;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreatePost;

// Create tools
$service = app(MattermostService::class);
$tools = [
    new MattermostListChannels($service),
    new MattermostCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Post "Hello team!" to the Town Square channel');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mattermost');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mattermost\Tools\MattermostCreatePost::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mattermost\MattermostService;

$service = app(MattermostService::class);

// List teams
$teams = $service->listTeams();

// List channels
$channels = $service->listChannels();

// Get a channel
$channel = $service->getChannel('channel-id-here');

// Post a message
$post = $service->createPost('channel-id-here', 'Hello from the API!');

// List posts
$posts = $service->listPosts('channel-id-here');

// Get a specific post
$post = $service->getPost('post-id-here');

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
- A [Mattermost](https://mattermost.com) account with API access (personal access token)

## License

MIT - see [LICENSE](LICENSE)
