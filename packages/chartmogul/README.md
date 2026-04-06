# Integration: ChartMogul

> ChartMogul integration for the [Laravel AI SDK](https://github.com/laravel/ai) — query customers, subscriptions, plans, invoices, and subscription metrics. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to subscription analytics. Query customer data, list subscriptions and plans, retrieve invoices, and pull key metrics like MRR, ARR, and churn — all through the [ChartMogul](https://chartmogul.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ChartMogul tool lets AI agents query subscription analytics, inspect customer billing data, and surface revenue insights — giving agents data-driven awareness of your SaaS metrics.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-chartmogul
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ChartMogul API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'chartmogul' => [
        'api_key' => env('CHARTMOGUL_API_KEY'),
        'url'     => env('CHARTMOGUL_URL', 'https://api.chartmogul.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `chartmogul_list_customers` | read | List customers with filtering by status/email and pagination |
| `chartmogul_get_customer` | read | Get a single customer by UUID |
| `chartmogul_list_subscriptions` | read | List subscriptions with filtering by customer/status |
| `chartmogul_list_plans` | read | List billing plans |
| `chartmogul_list_invoices` | read | List invoices with filtering by customer |
| `chartmogul_get_metrics` | read | Query subscription analytics (MRR, ARR, churn, etc.) |
| `chartmogul_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListCustomers;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetMetrics;

// Create tools
$service = app(ChartMogulService::class);
$tools = [
    new ChartMogulListCustomers($service),
    new ChartMogulGetMetrics($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What is our current MRR?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('chartmogul');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetMetrics::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ChartMogul\ChartMogulService;

$service = app(ChartMogulService::class);

// List customers
$customers = $service->listCustomers(perPage: 50, page: 1, status: 'Active');

// Get a single customer
$customer = $service->getCustomer('cus_abc123');

// List subscriptions for a customer
$subscriptions = $service->listSubscriptions(customerUuid: 'cus_abc123', status: 'active');

// List plans
$plans = $service->listPlans();

// List invoices for a customer
$invoices = $service->listInvoices(customerUuid: 'cus_abc123');

// Get metrics
$metrics = $service->getMetrics(
    startDate: '2025-01-01',
    endDate: '2025-03-31',
    interval: 'month',
);

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
- A [ChartMogul](https://chartmogul.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
