# Integration: Zendesk Sell

> Zendesk Sell integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, deals, and leads via the Sell API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your sales CRM. List and create contacts, track deals, manage leads, and verify the connected account — all through the [Zendesk Sell (formerly Base CRM)](https://www.zendesk.com/sell/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zendesk Sell tool lets AI agents interact with your sales pipeline — managing contacts, tracking deals, and working with leads — giving agents real-time CRM awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zendesk-sell
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zendesk Sell personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zendesk-sell' => [
        'access_token' => env('ZENDESK_SELL_ACCESS_TOKEN'),
        'url'          => env('ZENDESK_SELL_URL', 'https://api.getbase.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zendesk_sell_list_contacts` | read | List contacts with pagination and sorting |
| `zendesk_sell_get_contact` | read | Get details of a specific contact |
| `zendesk_sell_create_contact` | write | Create a new contact |
| `zendesk_sell_list_deals` | read | List deals with pagination and status filter |
| `zendesk_sell_get_deal` | read | Get details of a specific deal |
| `zendesk_sell_list_leads` | read | List leads with pagination |
| `zendesk_sell_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListContacts;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateContact;

// Create tools
$service = app(ZendeskSellService::class);
$tools = [
    new ZendeskSellListContacts($service),
    new ZendeskSellCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my most recently created contacts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zendesk-sell');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;

$service = app(ZendeskSellService::class);

// List contacts (page 1, 25 per page, sorted by created_at)
$contacts = $service->listContacts(1, 25, 'created_at');

// Get a specific contact
$contact = $service->getContact(12345);

// Create a contact
$contact = $service->createContact([
    'first_name' => 'Jane',
    'last_name' => 'Doe',
    'email' => 'jane@example.com',
]);

// List deals (filter by status)
$openDeals = $service->listDeals(1, 25, 'open');

// Get a specific deal
$deal = $service->getDeal(67890);

// List leads
$leads = $service->listLeads(1, 25);

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
- A [Zendesk Sell](https://www.zendesk.com/sell/) account with API access

## License

MIT — see [LICENSE](LICENSE)
