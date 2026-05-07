# Integration: Invoice Ninja

Invoice Ninja integration for the OpenCompany integration ecosystem. It exposes the v5 REST API for invoicing, billing, client management, products, payments, quotes, credits, projects, tasks, vendors, expenses, recurring invoices, purchase orders, tax rates, activities, users and static reference data.

## Installation

```console
composer require opencompanyapp/integration-invoiceninja
```

Laravel auto-discovers the service provider.

## Configuration

Create an Invoice Ninja API token in Settings > Account Management > Integrations > API Tokens.

```php
return [
    'invoiceninja' => [
        'api_token' => env('INVOICENINJA_API_TOKEN'),
        'url' => env('INVOICENINJA_URL', 'https://invoicing.co'),
    ],
];
```

Self-hosted instances should set `INVOICENINJA_URL` to the instance base URL without `/api/v1`.

## Coverage

The provider registers 100 tools. Core resource groups include:

| Resource | Operations |
| --- | --- |
| Clients | list, get, create, update, delete, blank, bulk |
| Invoices | list, get, create, update, delete, blank, bulk |
| Products | list, get, create, update, delete, blank, bulk |
| Payments | list, get, create, update, delete, refund, blank, bulk |
| Quotes | list, get, create, update, delete, blank, bulk |
| Credits | list, get, create, update, delete, blank, bulk |
| Projects | list, get, create, update, delete, blank, bulk |
| Tasks | list, get, create, update, delete, blank, bulk |
| Vendors | list, get, create, update, delete, blank, bulk |
| Expenses | list, get, create, update, delete, blank, bulk |
| Recurring invoices | list, get, create, update, delete, blank, bulk |
| Purchase orders | list, get, create, update, delete, blank, bulk |
| Tax rates | list, get, create, update, delete, blank, bulk |
| Activities | list, get |
| Users | list, get, current user |
| System/reference | ping, health check, statics |

## Payload Tools

The handwritten client and invoice create tools expose friendly top-level parameters. The broader generated create/update/bulk tools accept a `payload` object that is sent directly as the JSON body for the matching Invoice Ninja endpoint. This keeps the integration aligned with Invoice Ninja's schema while still exposing one focused tool per API operation.

## Service Usage

```php
use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;

$service = app(InvoiceNinjaService::class);

$clients = $service->apiGet('/api/v1/clients', [
    'per_page' => 50,
    'sort' => 'name|desc',
]);

$quote = $service->apiPost('/api/v1/quotes', [
    'client_id' => 'client_123',
    'line_items' => [
        ['product_key' => 'consulting', 'notes' => 'Strategy session', 'quantity' => 2, 'cost' => 150],
    ],
]);
```

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- Invoice Ninja v5 API token

## License

MIT. See [LICENSE](LICENSE).
