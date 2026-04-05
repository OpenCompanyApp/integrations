# Integration: Mautic

> Mautic integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, emails, segments, and forms. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Mautic](https://mautic.org), the open-source marketing automation platform. Manage contacts, list emails and segments, and query forms — all through the Mautic REST API with HTTP Basic Authentication.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mautic tool lets AI agents manage marketing contacts, review email campaigns, and inspect form submissions — giving agents CRM and marketing automation awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mautic
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Mautic hostname, username, and password for HTTP Basic Authentication.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mautic' => [
        'hostname' => env('MAUTIC_URL', 'https://mautic.example.com'),
        'username' => env('MAUTIC_USERNAME'),
        'password' => env('MAUTIC_PASSWORD'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mautic_list_contacts` | read | List contacts with search, filters, and pagination |
| `mautic_get_contact` | read | Get a single contact by ID |
| `mautic_create_contact` | write | Create a new contact |
| `mautic_update_contact` | write | Update an existing contact |
| `mautic_delete_contact` | write | Delete a contact permanently |
| `mautic_list_emails` | read | List marketing emails |
| `mautic_list_segments` | read | List contact segments (lists) |
| `mautic_list_forms` | read | List forms |
| `mautic_get_current_user` | read | Get the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\Integrations\Mautic\Tools\MauticListContacts;
use OpenCompany\Integrations\Mautic\Tools\MauticCreateContact;

// Create tools
$service = app(MauticService::class);
$tools = [
    new MauticListContacts($service),
    new MauticCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find all contacts at example.com and add them to the VIP segment.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mautic');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mautic\Tools\MauticListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mautic\MauticService;

$service = app(MauticService::class);

// List contacts
$contacts = $service->listContacts(['search' => 'example.com', 'limit' => 10]);

// Get a contact
$contact = $service->getContact(42);

// Create a contact
$contact = $service->createContact([
    'email' => 'john@example.com',
    'firstname' => 'John',
    'lastname' => 'Doe',
]);

// Update a contact
$service->updateContact(42, ['company' => 'Acme Corp']);

// List segments
$segments = $service->listSegments();

// List emails
$emails = $service->listEmails();

// List forms
$forms = $service->listForms();

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
- A [Mautic](https://mautic.org) instance with REST API access enabled

## License

MIT — see [LICENSE](LICENSE)
