# Integration: Insightly

> Insightly CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, deals (opportunities), and projects. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Insightly CRM. Manage contacts, track deals through pipelines, and browse projects — all through the [Insightly REST API](https://api.na1.insightly.com/v3.1/Help).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Insightly tool lets AI agents search and manage CRM contacts, create and update deals, and browse project information — giving agents data-driven awareness of your sales pipeline and project portfolio.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-insightly
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires an Insightly API key and your API region.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'insightly' => [
        'api_key' => env('INSIGHTLY_API_KEY'),
        'region'  => env('INSIGHTLY_REGION', 'na1'),
    ],
];
```

### Finding Your API Key

1. Log in to Insightly.
2. Go to **User Settings** → **API Keys**.
3. Generate or copy your API key.

### Regions

| Region | Code | API Base URL |
|--------|------|-------------|
| North America | `na1` | `https://api.na1.insightly.com/v3.1` |
| Europe | `eu1` | `https://api.eu1.insightly.com/v3.1` |
| Australia | `au1` | `https://api.au1.insightly.com/v3.1` |

Check your Insightly URL (e.g., `https://na1.insightly.com`) to determine your region code.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `insightly_list_contacts` | read | List contacts with pagination, ordering, and filtering |
| `insightly_get_contact` | read | Get a single contact by ID |
| `insightly_create_contact` | write | Create a new contact |
| `insightly_update_contact` | write | Update an existing contact |
| `insightly_list_deals` | read | List deals (opportunities) with pagination and filtering |
| `insightly_get_deal` | read | Get a single deal by ID |
| `insightly_create_deal` | write | Create a new deal (opportunity) |
| `insightly_list_projects` | read | List projects with pagination and filtering |
| `insightly_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateDeal;

// Create tools
$service = app(InsightlyService::class);
$tools = [
    new InsightlyListContacts($service),
    new InsightlyCreateDeal($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the 5 most recently created contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('insightly');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Insightly\InsightlyService;

$service = app(InsightlyService::class);

// List contacts
$contacts = $service->listContacts(top: 20, orderBy: 'DATE_CREATED_UTC desc');

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'FIRST_NAME' => 'Jane',
    'LAST_NAME' => 'Smith',
    'EMAIL_ADDRESS' => 'jane@example.com',
]);

// Update a contact
$contact = $service->updateContact(12345, ['TITLE' => 'CTO']);

// List deals
$deals = $service->listDeals(top: 10, orderBy: 'BID_AMOUNT desc');

// Create a deal
$deal = $service->createDeal([
    'OPPORTUNITY_NAME' => 'Enterprise License',
    'BID_AMOUNT' => 50000,
    'BID_CURRENCY' => 'USD',
]);

// List projects
$projects = $service->listProjects(brief: 'true');

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
- An [Insightly](https://www.insightly.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
