# Integration: Close

> Close CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage leads, contacts, activities, and tasks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full access to your Close CRM. Search and manage leads, view contacts, track activities, create tasks, and query the current user — all through the [Close API](https://developer.close.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Close integration lets AI agents manage your CRM pipeline — creating leads, updating statuses, tracking activities, and assigning tasks. Agents can operate as virtual sales assistants with full context on your deals.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-close
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Close CRM API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'close' => [
        'api_key' => env('CLOSE_API_KEY'),
        'url'     => env('CLOSE_API_URL', 'https://api.close.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `close_list_leads` | read | Search and list leads with powerful query syntax |
| `close_get_lead` | read | Get full details for a single lead |
| `close_create_lead` | write | Create a new lead with contacts |
| `close_update_lead` | write | Update lead fields (name, status, custom fields) |
| `close_delete_lead` | write | Permanently delete a lead |
| `close_list_contacts` | read | List contacts, optionally filtered by lead |
| `close_list_activities` | read | List activities (emails, calls, notes) |
| `close_create_task` | write | Create a new task |
| `close_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\Integrations\Close\Tools\CloseListLeads;
use OpenCompany\Integrations\Close\Tools\CloseCreateLead;

// Create tools
$service = app(CloseService::class);
$tools = [
    new CloseListLeads($service),
    new CloseCreateLead($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find all leads named Acme and create a follow-up task');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('close');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Close\Tools\CloseListLeads::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Close\CloseService;

$service = app(CloseService::class);

// Search leads
$leads = $service->listLeads('Acme', limit: 10);

// Get a specific lead
$lead = $service->getLead('lead_abc123XYZ');

// Create a lead with a contact
$lead = $service->createLead('Acme Corp', [
    [
        'name' => 'Jane Smith',
        'emails' => [['email' => 'jane@acme.com', 'type' => 'office']],
    ],
]);

// Update a lead
$service->updateLead('lead_abc123XYZ', ['name' => 'Acme Corp (Updated)']);

// List activities
$activities = $service->listActivities(leadId: 'lead_abc123XYZ', type: 'email');

// Create a task
$task = $service->createTask(
    text: 'Follow up with prospect',
    leadId: 'lead_abc123XYZ',
    dueDate: '2026-04-15',
);

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

Close uses HTTP Basic authentication with your API key as the username and an empty password. This is handled automatically by the `CloseService`. Generate an API key in Close under **Settings → API Keys**.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Close CRM](https://close.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
