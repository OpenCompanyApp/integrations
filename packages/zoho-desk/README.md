# Integration: Zoho Desk

> Zoho Desk integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tickets, contacts, articles, and departments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Zoho Desk help desk. List and manage support tickets, search contacts, browse knowledge base articles, and query departments — all through the [Zoho Desk REST API](https://desk.zoho.com/DeskAPIDocument).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Desk tool lets AI agents interact with your help desk — creating and updating tickets, looking up contacts, searching the knowledge base, and querying department structure.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-desk
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Zoho Desk OAuth2 access token and organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho-desk' => [
        'access_token' => env('ZOHO_DESK_ACCESS_TOKEN'),
        'base_url'     => env('ZOHO_DESK_BASE_URL', 'https://desk.zoho.com/api/v1'),
        'org_id'       => env('ZOHO_DESK_ORG_ID'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zohodesk_list_tickets` | read | List support tickets with filtering and pagination |
| `zohodesk_get_ticket` | read | Get a single ticket by ID with full details |
| `zohodesk_create_ticket` | write | Create a new support ticket |
| `zohodesk_update_ticket` | write | Update an existing ticket (status, priority, assignee, etc.) |
| `zohodesk_list_contacts` | read | List customer contacts |
| `zohodesk_list_articles` | read | List knowledge base articles |
| `zohodesk_list_departments` | read | List all departments in the organization |
| `zohodesk_get_current_user` | read | Get the currently authenticated user profile |

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
    ->prompt('Show me all open tickets in the Support department');
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
$tickets = $service->listTickets(['status' => 'Open', 'limit' => 25]);

// Get a single ticket
$ticket = $service->getTicket('123456789');

// Create a ticket
$newTicket = $service->createTicket([
    'subject' => 'Cannot access account',
    'departmentId' => '987654321',
    'description' => 'User reports being locked out after password change.',
    'priority' => 'High',
]);

// Update a ticket
$service->updateTicket('123456789', ['status' => 'Resolved']);

// List contacts
$contacts = $service->listContacts(['search' => 'john@example.com']);

// List knowledge base articles
$articles = $service->listArticles(['departmentId' => '987654321']);

// List departments
$departments = $service->listDepartments();

// Current user
$me = $service->getCurrentUser();
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
- A [Zoho Desk](https://desk.zoho.com) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
