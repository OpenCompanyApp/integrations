# Integration: Freshworks CRM

> Freshworks CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, deals, and accounts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your CRM data. List and create contacts, manage deals, browse sales accounts, and verify credentials — all through the [Freshworks CRM](https://www.freshworks.com/crm/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshworks CRM tool lets AI agents query and manage CRM data — giving agents sales awareness and the ability to create contacts, review deals, and look up accounts.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshworks-crm
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Freshworks CRM API key and your domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshworks_crm' => [
        'api_key'  => env('FRESHWORKS_CRM_API_KEY'),
        'domain'   => env('FRESHWORKS_CRM_DOMAIN'), // e.g., "mycompany"
    ],
];
```

The base URL is automatically constructed as `https://{domain}.myfreshworks.com/crm/sales`. You can override this by setting `base_url` directly.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshworks_crm_list_contacts` | read | List contacts with pagination |
| `freshworks_crm_get_contact` | read | Get a single contact by ID |
| `freshworks_crm_create_contact` | write | Create a new contact |
| `freshworks_crm_list_deals` | read | List deals with pagination and optional stage filter |
| `freshworks_crm_get_deal` | read | Get a single deal by ID |
| `freshworks_crm_list_accounts` | read | List sales accounts with pagination |
| `freshworks_crm_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListContacts;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmCreateContact;

// Create tools
$service = app(FreshworksCrmService::class);
$tools = [
    new FreshworksCrmListContacts($service),
    new FreshworksCrmCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the 5 most recent contacts in our CRM');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshworks_crm');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;

$service = app(FreshworksCrmService::class);

// List contacts
$contacts = $service->listContacts(page: 1, perPage: 20);

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
    'mobile_number' => '+1234567890',
]);

// List deals (optionally filtered by stage)
$deals = $service->listDeals(page: 1, perPage: 20, stage: 5);

// List sales accounts
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
- A [Freshworks CRM](https://www.freshworks.com/crm/) account with API access

## License

MIT — see [LICENSE](LICENSE)
