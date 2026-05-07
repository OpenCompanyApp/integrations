# Integration: Missive

> Missive REST API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — conversations, drafts, tasks, contacts, teams, responses, analytics, and webhooks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Missive conversations and tasks. List email threads and messages, create drafts and posts, manage tasks, read contacts and teams, generate analytics reports, and manage hooks through the [Missive Public API](https://missiveapp.com/docs/developers/rest-api/endpoints).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Missive integration lets AI agents read and respond to email conversations, post internal comments, manage tasks, inspect contact books, and automate team workflow metadata.

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
| `missive_list_conversation_messages` | read | List messages in a conversation |
| `missive_list_conversation_comments` | read | List comments in a conversation |
| `missive_list_conversation_drafts` | read | List drafts in a conversation |
| `missive_list_conversation_posts` | read | List posts in a conversation |
| `missive_merge_conversation` | write | Merge one conversation into another |
| `missive_create_comment` | write | Add a comment to a conversation |
| `missive_create_draft` / `missive_delete_draft` | write | Create or delete drafts |
| `missive_list_messages` | read | Find messages by documented message query parameters |
| `missive_create_post` / `missive_delete_post` | write | Create or delete posts |
| `missive_list_tasks` | read | List tasks with filters (state, assignee) and pagination |
| `missive_get_task` / `missive_update_task` | read/write | Get or update a task |
| `missive_create_task` | write | Create a new task (title, description, assignee, due_date) |
| `missive_get_current_user` | read | Get the authenticated user's profile |
| `missive_list_organizations`, `missive_list_users`, `missive_list_teams`, `missive_create_teams` | read/write | Organization user and team metadata |
| `missive_list_contacts`, `missive_get_contact`, `missive_create_contacts`, `missive_update_contacts` | read/write | Contact management |
| `missive_list_contact_books`, `missive_list_contact_groups` | read | Contact book metadata |
| `missive_list_shared_labels` | read | Shared label metadata |
| `missive_list_responses`, `missive_get_response`, `missive_create_responses`, `missive_update_responses`, `missive_delete_responses` | read/write | Canned responses |
| `missive_create_analytics_report`, `missive_get_analytics_report` | read/write | Asynchronous analytics reports |
| `missive_list_hooks`, `missive_create_hook`, `missive_delete_hook` | read/write | Webhook subscriptions |
| `missive_api_get`, `missive_api_post`, `missive_api_patch`, `missive_api_delete` | read/write | Generic documented REST endpoint helpers |

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

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

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

// Create a draft
$draft = $service->createDraft([
    'subject' => 'Follow up',
    'body' => 'Thanks for the details.',
]);

// List contacts
$contacts = $service->listContacts(['search' => 'Example']);

// Create a task
$service->createTask([
    'title' => 'Follow up with client',
    'description' => 'Reply to the inquiry about pricing',
    'due_date' => '2025-12-31',
]);

// Get current user
$user = $service->getCurrentUser();

// Create an analytics report
$report = $service->createAnalyticsReport([
    'organization' => 'org-uuid',
    'start' => '2026-05-01',
    'end' => '2026-05-06',
    'time_zone' => 'UTC',
]);
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
