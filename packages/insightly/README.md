# Integration: Insightly

> Insightly CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, opportunities, and projects. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Insightly CRM. Manage contacts, track opportunities through pipelines, and browse projects — all through the [Insightly REST API](https://api.na1.insightly.com/v3.1/Help).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Insightly tool lets AI agents search and manage CRM contacts, create deals, and browse project information — giving agents data-driven awareness of your sales pipeline and project portfolio.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-insightly
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires an Insightly API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'insightly' => [
        'access_token' => env('INSIGHTLY_ACCESS_TOKEN'),
        'base_url'     => env('INSIGHTLY_BASE_URL', 'https://api.na1.insightly.com'),
    ],
];
```

### Finding Your API Key

1. Log in to Insightly.
2. Go to **User Settings** → **API Keys**.
3. Generate or copy your API key — this is used as the Bearer access token.

### Base URL

The default base URL is `https://api.na1.insightly.com`. If your Insightly instance uses a different region, update the `base_url` accordingly:

| Region | Base URL |
|--------|----------|
| North America | `https://api.na1.insightly.com` |
| Europe | `https://api.eu1.insightly.com` |
| Australia | `https://api.au1.insightly.com` |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `insightly_list_contacts` | read | List contacts with pagination and search |
| `insightly_get_contact` | read | Get a single contact by ID |
| `insightly_create_contact` | write | Create a new contact |
| `insightly_list_opportunities` | read | List opportunities with pagination and status filter |
| `insightly_get_opportunity` | read | Get a single opportunity by ID |
| `insightly_list_projects` | read | List projects with pagination and status filter |
| `insightly_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateContact;

// Create tools
$service = app(InsightlyService::class);
$tools = [
    new InsightlyListContacts($service),
    new InsightlyCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the 5 most recently created contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

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
$contacts = $service->listContacts(top: 20, search: 'John');

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'FIRST_NAME' => 'Jane',
    'LAST_NAME' => 'Smith',
    'EMAIL_ADDRESS' => 'jane@example.com',
    'PHONE' => '+1-555-0100',
]);

// List opportunities
$opportunities = $service->listOpportunities(top: 10, status: 'Open');

// Get an opportunity
$opportunity = $service->getOpportunity(67890);

// List projects
$projects = $service->listProjects(status: 'In Progress');

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
