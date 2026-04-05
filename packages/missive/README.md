# Integration: Missive

> Missive email and team chat integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage conversations, comments, and tasks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Missive conversations and tasks. List and read email threads, add comments, manage tasks — all through the [Missive Public API](https://missiveapp.com/help/api/rest).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Missive tool lets AI agents read and respond to email conversations, post internal comments, and manage tasks — giving agents communication awareness and the ability to act on team workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-missive
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Missive Personal Access Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'missive' => [
        'access_token' => env('MISSIVE_ACCESS_TOKEN'),
        'url'          => env('MISSIVE_URL', 'https://public.missiveapp.com/v1'),
    ],
];
```

Generate a Personal Access Token in Missive at **Settings → API → Personal access tokens**.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `missive_list_conversations` | read | List conversations with filters (inbox, assignee, state) and pagination |
| `missive_get_conversation` | read | Get a single conversation by ID with messages and metadata |
| `missive_create_comment` | write | Add a comment to a conversation |
| `missive_list_tasks` | read | List tasks with filters (state, assignee) and pagination |
| `missive_create_task` | write | Create a new task (title, description, assignee, due_date) |
| `missive_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\Integrations\Missive\Tools\MissiveListConversations;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateComment;

// Create tools
$service = app(MissiveService::class);
$tools = [
    new MissiveListConversations($service),
    new MissiveCreateComment($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my open conversations and summarize the latest one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('missive');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Missive\Tools\MissiveListConversations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Missive\MissiveService;

$service = app(MissiveService::class);

// List open conversations
$conversations = $service->listConversations(['state' => 'open', 'limit' => 10]);

// Get a specific conversation
$conversation = $service->getConversation('conv-uuid-here');

// Add a comment
$service->createComment([
    'conversation_id' => 'conv-uuid-here',
    'body' => 'Reviewed — looks good to ship.',
]);

// List tasks
$tasks = $service->listTasks(['state' => 'open']);

// Create a task
$service->createTask([
    'title' => 'Follow up with client',
    'description' => 'Reply to the inquiry about pricing',
    'due_date' => '2025-12-31',
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
- A [Missive](https://missiveapp.com) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
