# Integration: Wealthbox

> Wealthbox CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, tasks, opportunities, workflows, and events. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Wealthbox CRM. Manage contacts, tasks, opportunities, workflows, and calendar events — all through the [Wealthbox](https://www.wealthbox.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Wealthbox tool lets AI agents interact with CRM data — creating contacts, managing tasks, tracking opportunities, and more — giving agents full awareness of client relationships and sales pipelines.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wealthbox
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Wealthbox access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wealthbox' => [
        'access_token' => env('WEALTHBOX_ACCESS_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wealthbox_list_contacts` | read | List contacts from Wealthbox CRM |
| `wealthbox_get_contact` | read | Get a specific contact by ID |
| `wealthbox_create_contact` | write | Create a new contact in Wealthbox CRM |
| `wealthbox_list_tasks` | read | List tasks from Wealthbox CRM |
| `wealthbox_create_task` | write | Create a new task in Wealthbox CRM |
| `wealthbox_list_opportunities` | read | List opportunities (sales pipeline) |
| `wealthbox_list_workflows` | read | List workflows from Wealthbox CRM |
| `wealthbox_list_events` | read | List calendar events from Wealthbox CRM |
| `wealthbox_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListContacts;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxCreateContact;

// Create tools
$service = app(WealthboxService::class);
$tools = [
    new WealthboxListContacts($service),
    new WealthboxCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Wealthbox contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wealthbox');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Wealthbox\Tools\WealthboxListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Wealthbox\WealthboxService;

$service = app(WealthboxService::class);

// List contacts
$contacts = $service->listContacts(['page' => 1]);

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
]);

// List tasks
$tasks = $service->listTasks();

// Create a task
$task = $service->createTask([
    'name' => 'Follow up with client',
    'due_date' => '2026-04-15',
]);

// List opportunities
$opportunities = $service->listOpportunities();

// List workflows
$workflows = $service->listWorkflows();

// List events
$events = $service->listEvents();

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
- A [Wealthbox](https://www.wealthbox.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
