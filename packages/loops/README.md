# Integration: Loops

> Loops email marketing integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, send events. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Loops](https://loops.so) email marketing. Manage contacts, send custom events, and trigger automations — all through the Loops API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Loops tool lets AI agents manage email contacts and trigger event-based automations — enabling conversational email marketing workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-loops
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Loops API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'loops' => [
        'api_key' => env('LOOPS_API_KEY'),
        'url'     => env('LOOPS_URL', 'https://app.loops.so/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `loops_list_contacts` | read | List contacts with pagination |
| `loops_get_contact` | read | Get a single contact by ID |
| `loops_create_contact` | write | Create a new contact (email, first_name, last_name) |
| `loops_update_contact` | write | Update an existing contact |
| `loops_send_event` | write | Send a custom event for a contact |
| `loops_get_current_user` | read | Get the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\Integrations\Loops\Tools\LoopsListContacts;
use OpenCompany\Integrations\Loops\Tools\LoopsCreateContact;
use OpenCompany\Integrations\Loops\Tools\LoopsSendEvent;

// Create tools
$service = app(LoopsService::class);
$tools = [
    new LoopsListContacts($service),
    new LoopsCreateContact($service),
    new LoopsSendEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a contact for jane@example.com and send them a welcome event');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('loops');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Loops\Tools\LoopsListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Loops\LoopsService;

$service = app(LoopsService::class);

// List contacts
$contacts = $service->listContacts(limit: 50, offset: 0);

// Get a contact
$contact = $service->getContact('contact_id_here');

// Create a contact
$service->createContact('jane@example.com', 'Jane', 'Doe');

// Update a contact
$service->updateContact('contact_id_here', ['first_name' => 'Janet']);

// Send an event
$service->sendEvent('jane@example.com', 'signup', ['plan' => 'pro']);

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
- A [Loops](https://loops.so) account with API access

## License

MIT — see [LICENSE](LICENSE)
