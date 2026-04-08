# Integration: Affinity

> Affinity CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, organizations, and lists. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to relationship intelligence data. Search and create contacts, manage organizations, and browse lists — all through the [Affinity](https://www.affinity.co/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Affinity tool lets AI agents look up contacts, research organizations, and manage CRM data — giving agents contextual awareness of your team's relationships.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-affinity
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Affinity API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'affinity' => [
        'api_key' => env('AFFINITY_API_KEY'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `affinity_list_contacts` | read | List contacts with pagination |
| `affinity_get_contact` | read | Get a specific contact by ID |
| `affinity_create_contact` | write | Create a new contact |
| `affinity_list_organizations` | read | List organizations with pagination |
| `affinity_get_organization` | read | Get a specific organization by ID |
| `affinity_create_organization` | write | Create a new organization |
| `affinity_list_lists` | read | List all Affinity lists |
| `affinity_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\Integrations\Affinity\Tools\AffinityListContacts;
use OpenCompany\Integrations\Affinity\Tools\AffinityCreateContact;

// Create tools
$service = app(AffinityService::class);
$tools = [
    new AffinityListContacts($service),
    new AffinityCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Look up John Smith in Affinity and show me their details');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('affinity');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Affinity\Tools\AffinityListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Affinity\AffinityService;

$service = app(AffinityService::class);

// List contacts
$contacts = $service->listContacts(limit: 50);

// Get a contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'emails' => [['email' => 'jane@example.com']],
]);

// List organizations
$orgs = $service->listOrganizations();

// Create an organization
$org = $service->createOrganization([
    'name' => 'Acme Corp',
    'domain' => 'acme.com',
]);

// List lists
$lists = $service->listLists();

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
- An [Affinity](https://www.affinity.co/) account with API access

## License

MIT — see [LICENSE](LICENSE)
