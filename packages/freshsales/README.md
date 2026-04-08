# Integration: Freshsales

> Freshsales CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, deals, and accounts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your CRM data. List and create contacts, track deals in the pipeline, manage sales accounts, and verify the connection — all through the [Freshsales](https://www.freshworks.com/freshsales-crm/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshsales tool lets AI agents query and manage CRM contacts, deals, and accounts — giving agents direct access to your sales pipeline.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshsales
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Freshsales API key and your account domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshsales' => [
        'api_key' => env('FRESHSALES_API_KEY'),
        'domain'  => env('FRESHSALES_DOMAIN'), // e.g., "mycompany" from https://mycompany.myfreshworks.com
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshsales_list_contacts` | read | List contacts with pagination and sorting |
| `freshsales_get_contact` | read | Get details for a specific contact |
| `freshsales_create_contact` | write | Create a new contact |
| `freshsales_list_deals` | read | List deals with pagination |
| `freshsales_get_deal` | read | Get details for a specific deal |
| `freshsales_list_accounts` | read | List sales accounts with pagination |
| `freshsales_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListContacts;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesCreateContact;

// Create tools
$service = app(FreshsalesService::class);
$tools = [
    new FreshsalesListContacts($service),
    new FreshsalesCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our most recent contacts and show deal pipeline');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshsales');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Freshsales\Tools\FreshsalesListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Freshsales\FreshsalesService;

$service = app(FreshsalesService::class);

// List contacts
$contacts = $service->listContacts(page: 1, perPage: 20, sort: 'desc', sortBy: 'created_at');

// Get a contact
$contact = $service->getContact(12345);

// Create a contact
$newContact = $service->createContact([
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'email' => 'jane@example.com',
    'mobile_number' => '+1234567890',
]);

// List deals
$deals = $service->listDeals(page: 1, perPage: 20);

// List accounts
$accounts = $service->listAccounts(page: 1, perPage: 20);

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
- A [Freshsales](https://www.freshworks.com/freshsales-crm/) account with API access

## License

MIT — see [LICENSE](LICENSE)
