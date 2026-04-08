# Integration: Zoho Desk

> Zoho Desk integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tickets, contacts, articles, and departments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to customer support operations. List and manage tickets, browse contacts, search knowledge base articles, and retrieve department information — all through the [Zoho Desk](https://desk.zoho.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Desk tool lets AI agents manage support tickets, look up contact information, search knowledge base articles, and navigate department structures — giving agents full helpdesk awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-desk
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zoho Desk OAuth access token and organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho-desk' => [
        'access_token' => env('ZOHO_DESK_ACCESS_TOKEN'),
        'url'          => env('ZOHO_DESK_URL', 'https://desk.zoho.com/api/v1'),
        'org_id'       => env('ZOHO_DESK_ORG_ID'),
    ],
];
```

### Setting Up OAuth

1. Go to the [Zoho API Console](https://api-console.zoho.com/)
2. Register a new client with the `Desk.tickets.READ`, `Desk.tickets.WRITE`, `Desk.contacts.READ`, `Desk.articles.READ`, `Desk.departments.READ`, and `Desk.users.READ` scopes
3. Generate an OAuth access token
4. Find your Organization ID in Zoho Desk under **Setup → Organization → Organization Profile**

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zohodesk_list_tickets` | read | List support tickets with optional filters |
| `zohodesk_get_ticket` | read | Get full details of a specific ticket |
| `zohodesk_create_ticket` | write | Create a new support ticket |
| `zohodesk_update_ticket` | write | Update an existing ticket's fields |
| `zohodesk_list_contacts` | read | List and search contacts |
| `zohodesk_list_articles` | read | List knowledge base articles |
| `zohodesk_list_departments` | read | List support departments |
| `zohodesk_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListTickets;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskCreateTicket;

// Create tools
$service = app(ZohoDeskService::class);
$tools = [
    new ZohoDeskListTickets($service),
    new ZohoDeskCreateTicket($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all open high-priority tickets');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zoho-desk');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListTickets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;

$service = app(ZohoDeskService::class);

// List tickets
$tickets = $service->listTickets(['status' => 'Open', 'limit' => 10]);

// Get a specific ticket
$ticket = $service->getTicket('123456789');

// Create a ticket
$ticket = $service->createTicket([
    'subject' => 'Login issue',
    'departmentId' => '123456',
    'description' => 'User cannot log in to the application.',
    'priority' => 'High',
]);

// Update a ticket
$service->updateTicket('123456789', ['status' => 'Closed']);

// List contacts
$contacts = $service->listContacts(['search' => 'john']);

// List articles
$articles = $service->listArticles(['departmentId' => '123456']);

// List departments
$departments = $service->listDepartments();

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
- A [Zoho Desk](https://desk.zoho.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
