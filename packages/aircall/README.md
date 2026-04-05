# Integration: Aircall

> Aircall integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage calls, contacts, users, and phone numbers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to cloud phone system data. Query call history, manage contacts, list users, and retrieve phone numbers — all through the [Aircall API](https://developer.aircall.io/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Aircall tool lets AI agents query call records, look up contacts, and manage phone system data — giving agents telephony awareness and communication capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-aircall
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Aircall OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'aircall' => [
        'access_token' => env('AIRCALL_ACCESS_TOKEN'),
        'url'          => env('AIRCALL_API_URL', 'https://api.aircall.io/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `aircall_list_calls` | read | List calls with optional filters (date, direction, user, number, tags) |
| `aircall_get_call` | read | Retrieve details of a specific call by ID |
| `aircall_list_contacts` | read | List contacts with optional search and pagination |
| `aircall_create_contact` | write | Create a new contact with phone numbers and emails |
| `aircall_update_contact` | write | Update an existing contact's details |
| `aircall_list_users` | read | List all users in the Aircall account |
| `aircall_list_numbers` | read | List all phone numbers in the Aircall account |
| `aircall_get_current_user` | read | Retrieve the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\Integrations\Aircall\Tools\AircallListCalls;
use OpenCompany\Integrations\Aircall\Tools\AircallListContacts;

// Create tools
$service = app(AircallService::class);
$tools = [
    new AircallListCalls($service),
    new AircallListContacts($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many inbound calls did we receive today?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('aircall');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Aircall\Tools\AircallListCalls::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Aircall\AircallService;

$service = app(AircallService::class);

// List recent calls
$calls = $service->listCalls(['per_page' => 10, 'order' => 'desc']);

// Get a specific call
$call = $service->getCall(12345);

// Search contacts
$contacts = $service->listContacts(['q' => 'John']);

// Create a contact
$contact = $service->createContact([
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'phone_numbers' => [['label' => 'Work', 'value' => '+33612345678']],
]);

// Update a contact
$service->updateContact(5678, ['company_name' => 'Acme Corp']);

// List users
$users = $service->listUsers();

// Get current user
$me = $service->getCurrentUser();

// List phone numbers
$numbers = $service->listNumbers();
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
- An [Aircall](https://aircall.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
