# Integration: Zoho Inventory

> Zoho Inventory integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage items, sales orders, shipments, and packages. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to inventory management data. Browse products, track sales orders, view shipments, and check packages — all through the [Zoho Inventory](https://www.zoho.com/inventory/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Inventory tool lets AI agents query product catalogs, monitor order fulfillment, and track shipments — giving agents real-time visibility into e-commerce operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-inventory
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zoho Inventory OAuth access token and an organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho_inventory' => [
        'access_token'    => env('ZOHO_INVENTORY_ACCESS_TOKEN'),
        'organization_id' => env('ZOHO_INVENTORY_ORGANIZATION_ID'),
        'url'             => env('ZOHO_INVENTORY_URL', 'https://www.zohoapis.com/inventory'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zoho_inventory_list_items` | read | List inventory items (products) with pagination and status filter |
| `zoho_inventory_get_item` | read | Get details of a specific inventory item |
| `zoho_inventory_list_orders` | read | List sales orders with pagination and status filter |
| `zoho_inventory_get_order` | read | Get details of a specific sales order |
| `zoho_inventory_list_shipments` | read | List shipments with pagination |
| `zoho_inventory_list_packages` | read | List packages with pagination |
| `zoho_inventory_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListItems;
use OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryGetOrder;

// Create tools
$service = app(ZohoInventoryService::class);
$tools = [
    new ZohoInventoryListItems($service),
    new ZohoInventoryGetOrder($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all open sales orders');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zoho_inventory');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoInventory\Tools\ZohoInventoryListItems::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;

$service = app(ZohoInventoryService::class);

// List items
$items = $service->listItems(page: 1, perPage: 50, status: 'active');

// Get a specific item
$item = $service->getItem('4815162342');

// List sales orders
$orders = $service->listOrders(page: 1, status: 'open');

// Get order details
$order = $service->getOrder('4815162342');

// List shipments
$shipments = $service->listShipments(page: 1);

// List packages
$packages = $service->listPackages(page: 1);

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
- A [Zoho Inventory](https://www.zoho.com/inventory/) account with OAuth access

## License

MIT — see [LICENSE](LICENSE)
