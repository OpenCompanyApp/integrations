# Integration: Discourse

> Discourse forum integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage topics, posts, and categories. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Discourse forum. List and read topics, create posts and replies, manage categories — all through the [Discourse API](https://docs.discourse.org/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Discourse tool lets AI agents interact with your forum — reading discussions, posting replies, creating topics, and managing categories — giving agents community awareness and engagement capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-discourse
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Discourse API key, API username, and hostname.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'discourse' => [
        'api_key'      => env('DISCOURSE_API_KEY'),
        'api_username'  => env('DISCOURSE_API_USERNAME', 'system'),
        'hostname'     => env('DISCOURSE_HOSTNAME'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `discourse_list_topics` | read | List latest topics from the forum |
| `discourse_get_topic` | read | Get a single topic with its posts |
| `discourse_create_topic` | write | Create a new topic in a category |
| `discourse_update_topic` | write | Update a topic's title or category |
| `discourse_list_categories` | read | List all forum categories |
| `discourse_get_category` | read | Get a category with its topic list |
| `discourse_create_post` | write | Reply to an existing topic |
| `discourse_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\Integrations\Discourse\Tools\DiscourseListTopics;
use OpenCompany\Integrations\Discourse\Tools\DiscourseCreatePost;

// Create tools
$service = app(DiscourseService::class);
$tools = [
    new DiscourseListTopics($service),
    new DiscourseCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the latest topics on the forum and summarize them.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('discourse');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Discourse\Tools\DiscourseListTopics::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Discourse\DiscourseService;

$service = app(DiscourseService::class);

// List latest topics
$topics = $service->listTopics(page: 1);

// Get a specific topic
$topic = $service->getTopic(42);

// Create a new topic
$service->createTopic('Hello World', 'This is the body.', categoryId: 5);

// Reply to a topic
$service->createPost(42, 'This is a reply.');

// List categories
$categories = $service->listCategories();
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
- A [Discourse](https://www.discourse.org/) instance with API access enabled

## License

MIT — see [LICENSE](LICENSE)
