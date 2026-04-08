# Integration: Keap

> Keap CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, opportunities, and tags. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Keap CRM data. List and create contacts, manage sales opportunities, and browse tags — all through the [Keap REST API](https://developer.keap.com/docs/rest/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Keap tool lets AI agents manage CRM contacts, track sales opportunities, and interact with tags — enabling data-driven sales automation.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-keap
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Keap access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'keap' => [
        'access_token' => env('KEAP_ACCESS_TOKEN'),
        'url'          => env('KEAP_URL', 'https://api.keap.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `keap_list_contacts` | read | List contacts with pagination |
| `keap_get_contact` | read | Retrieve a single contact by ID |
| `keap_create_contact` | write | Create a new contact |
| `keap_list_opportunities` | read | List sales opportunities with optional stage filter |
| `keap_get_opportunity` | read | Retrieve a single opportunity by ID |
| `keap_list_tags` | read | List all tags |
| `keap_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\Integrations\Keap\Tools\KeapListContacts;
use OpenCompany\Integrations\Keap\Tools\KeapCreateContact;

// Create tools
$service = app(KeapService::class);
$tools = [
    new KeapListContacts($service),
    new KeapCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our 10 most recent contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('keap');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Keap\Tools\KeapListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Keap\KeapService;

$service = app(KeapService::class);

// List contacts (page 1, 20 per page)
$contacts = $service->listContacts(1, 20);

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'given_name'   => 'Jane',
    'family_name'  => 'Doe',
    'email_addresses' => [['email' => 'jane@example.com', 'field' => 'EMAIL1']],
]);

// List opportunities
$opportunities = $service->listOpportunities(1, 20, 'New');

// Get a specific opportunity
$opportunity = $service->getOpportunity(67890);

// List tags
$tags = $service->listTags();

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
- A [Keap](https://keap.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
