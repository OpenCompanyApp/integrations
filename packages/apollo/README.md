# Integration: Apollo.io

> Apollo.io integration for the [Laravel AI SDK](https://github.com/laravel/ai) — search contacts, enrich data, manage organizations. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to sales intelligence. Search for contacts, enrich person data, and browse organizations — all through the [Apollo.io](https://apollo.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Apollo tool lets AI agents search for prospects, enrich contact data, and explore company information — giving agents sales intelligence capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-apollo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Apollo.io API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'apollo' => [
        'api_key' => env('APOLLO_API_KEY'),
        'url'     => env('APOLLO_URL', 'https://api.apollo.io'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `apollo_search_contacts` | read | Search for people by name, email, or keyword |
| `apollo_get_contact` | read | Retrieve full contact details by ID |
| `apollo_enrich` | read | Enrich a contact by matching on email or name |
| `apollo_list_organizations` | read | List organizations from your Apollo account |
| `apollo_get_organization` | read | Retrieve full organization details by ID |
| `apollo_get_current_user` | read | Retrieve the authenticated user's profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchContacts;
use OpenCompany\Integrations\Apollo\Tools\ApolloEnrich;

// Create tools
$service = app(ApolloService::class);
$tools = [
    new ApolloSearchContacts($service),
    new ApolloEnrich($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find the CTO of Acme Corp on Apollo');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('apollo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Apollo\Tools\ApolloSearchContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Apollo\ApolloService;

$service = app(ApolloService::class);

// Search contacts
$results = $service->searchContacts('john smith', page: 1, perPage: 10);

// Get a specific contact
$contact = $service->getContact('63f3b1c2XXXXXXXXXXXX');

// Enrich a contact
$enriched = $service->enrich(email: 'john@example.com');

// List organizations
$orgs = $service->listOrganizations(page: 1, perPage: 25);

// Get a specific organization
$org = $service->getOrganization('63f3b1c2XXXXXXXXXXXX');

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
- An [Apollo.io](https://apollo.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
