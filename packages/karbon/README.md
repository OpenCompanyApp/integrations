# Integration: Karbon

> Karbon integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, work items, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Karbon practice management workspace. List and create contacts, manage work items, and look up team members — all through the [Karbon API](https://developer.karbonhq.com).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Karbon tool lets AI agents interact with contacts, work items, and users in your practice management system — giving agents real-time awareness of your firm's workflow.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-karbon
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Karbon API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'karbon' => [
        'access_token' => env('KARBON_ACCESS_TOKEN'),
        'url'          => env('KARBON_URL', 'https://api.karbonhq.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `karbon_list_contacts` | read | List contacts with pagination |
| `karbon_get_contact` | read | Get a single contact by ID |
| `karbon_create_contact` | write | Create a new contact |
| `karbon_list_work_items` | read | List work items with filters (status, assignee) |
| `karbon_get_work_item` | read | Get a single work item by ID |
| `karbon_list_users` | read | List users in the account |
| `karbon_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\Integrations\Karbon\Tools\KarbonListContacts;
use OpenCompany\Integrations\Karbon\Tools\KarbonCreateContact;

// Create tools
$service = app(KarbonService::class);
$tools = [
    new KarbonListContacts($service),
    new KarbonCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all contacts and create a new one for John Smith at Acme Corp');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('karbon');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Karbon\Tools\KarbonListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Karbon\KarbonService;

$service = app(KarbonService::class);

// List contacts
$contacts = $service->listContacts(page: 1, limit: 20);

// Get a contact
$contact = $service->getContact('contact-id');

// Create a contact
$contact = $service->createContact([
    'firstName' => 'John',
    'lastName' => 'Smith',
    'email' => 'john@example.com',
    'company' => 'Acme Corp',
    'phone' => '+1234567890',
]);

// List work items
$workItems = $service->listWorkItems(status: 'Open');

// Get a work item
$workItem = $service->getWorkItem('work-item-id');

// List users
$users = $service->listUsers();

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
- A [Karbon](https://karbonhq.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
