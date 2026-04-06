# Integration: Capsule CRM

> Capsule CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, opportunities, and tasks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Capsule CRM data. List and create contacts, track sales opportunities, manage tasks, and verify credentials — all through the [Capsule CRM API v2](https://developer.capsulecrm.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Capsule CRM tool lets AI agents access contact data, sales pipeline information, and task management — giving agents CRM awareness and the ability to act on behalf of users.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-capsule
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Capsule CRM personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'capsule' => [
        'access_token' => env('CAPSULE_ACCESS_TOKEN'),
        'url'          => env('CAPSULE_URL', 'https://api.capsulecrm.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `capsule_list_contacts` | read | List contacts (people and organisations) with pagination |
| `capsule_get_contact` | read | Retrieve a single contact by ID |
| `capsule_create_contact` | write | Create a new person or organisation contact |
| `capsule_list_opportunities` | read | List sales opportunities with optional status filter |
| `capsule_get_opportunity` | read | Retrieve a single opportunity by ID |
| `capsule_list_tasks` | read | List tasks with optional status filter |
| `capsule_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListContacts;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateContact;

// Create tools
$service = app(CapsuleService::class);
$tools = [
    new CapsuleListContacts($service),
    new CapsuleCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all open sales opportunities');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('capsule');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Capsule\Tools\CapsuleListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Capsule\CapsuleService;

$service = app(CapsuleService::class);

// List contacts
$contacts = $service->listContacts(page: 1, perPage: 25);

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact(
    type: 'person',
    firstName: 'Jane',
    lastName: 'Doe',
    emailAddresses: [['address' => 'jane@example.com']],
);

// List open opportunities
$opportunities = $service->listOpportunities(status: 'OPEN');

// Get a specific opportunity
$opportunity = $service->getOpportunity(67890);

// List tasks
$tasks = $service->listTasks(status: 'OPEN');

// Current user
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
- A [Capsule CRM](https://capsulecrm.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
