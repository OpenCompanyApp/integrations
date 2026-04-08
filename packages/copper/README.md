# Integration: Copper CRM

> Copper CRM integration for Laravel — manage contacts, companies, opportunities, and pipelines. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Copper CRM data. Search contacts and companies, manage deals, and explore pipelines — all through the [Copper](https://www.copper.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Copper integration lets AI agents manage CRM data, look up contact details, track deals through pipelines, and keep customer information up to date — all from within the OpenCompany workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-copper
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Copper API key and the email address associated with your Copper account.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'copper' => [
        'api_key' => env('COPPER_API_KEY'),
        'email'   => env('COPPER_EMAIL'),
    ],
];
```

### Generating an API Key

1. Log in to Copper CRM
2. Navigate to **Settings** → **Integrations** → **API Keys**
3. Generate a new API key
4. Copy the key and your account email into your configuration

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `copper_list_contacts` | read | Search and list contacts |
| `copper_get_contact` | read | Get contact details by ID |
| `copper_create_contact` | write | Create a new contact |
| `copper_update_contact` | write | Update an existing contact |
| `copper_delete_contact` | write | Delete a contact |
| `copper_list_companies` | read | Search and list companies |
| `copper_get_company` | read | Get company details by ID |
| `copper_create_company` | write | Create a new company |
| `copper_list_opportunities` | read | Search and list opportunities (deals) |
| `copper_get_opportunity` | read | Get opportunity details by ID |
| `copper_create_opportunity` | write | Create a new opportunity |
| `copper_list_pipelines` | read | List all sales pipelines and stages |
| `copper_get_current_user` | read | Get the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\Integrations\Copper\Tools\CopperListContacts;
use OpenCompany\Integrations\Copper\Tools\CopperGetContact;

// Create tools
$service = app(CopperService::class);
$tools = [
    new CopperListContacts($service),
    new CopperGetContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 13 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('copper');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Copper\Tools\CopperListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Copper\CopperService;

$service = app(CopperService::class);

// List contacts
$contacts = $service->listContacts(['page_size' => 25]);

// Get a contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'name' => 'Jane Smith',
    'emails' => [['email' => 'jane@example.com', 'category' => 'work']],
]);

// List pipelines
$pipelines = $service->listPipelines();

// Create an opportunity
$opp = $service->createOpportunity([
    'name' => 'New Deal',
    'pipeline_id' => $pipelines[0]['id'],
]);
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
- A [Copper CRM](https://www.copper.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
