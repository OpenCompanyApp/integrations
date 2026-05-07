# Integration: Chargebee

Chargebee integration for the OpenCompany integration ecosystem. It exposes Chargebee API v2 tools for subscription billing, customers, invoices, catalog records, payment flows, hosted checkout pages, estimates, events, orders and business entities.

## Installation

```console
composer require opencompanyapp/integration-chargebee
```

Laravel auto-discovers the service provider.

## Configuration

This integration requires a Chargebee API key and site name. Chargebee authenticates API v2 requests with HTTP Basic Auth, using the API key as the username and an empty password.

```php
return [
    'chargebee' => [
        'access_token' => env('CHARGEBEE_ACCESS_TOKEN'),
        'site_name' => env('CHARGEBEE_SITE_NAME'),
    ],
];
```

The service builds API URLs as `https://{site_name}.chargebee.com/api/v2`.

## Coverage

The provider registers 80 tools. Core coverage includes:

| Area | Examples |
| --- | --- |
| Customers | list, get, create, update, delete |
| Subscriptions | list, get, create for items, update for items, cancel, reactivate, pause, resume, delete, scheduled-change helpers |
| Invoices | list, get, create non-recurring invoice, close, void, delete, collect payment, record payment, PDF metadata, payment schedules |
| Credit notes | list, get, create, void, delete, PDF metadata |
| Catalog | items, item prices, attached items, coupons |
| Payments | transactions, refunds, payment sources |
| Hosted pages | checkout new/existing for items, update payment method, manage payment sources, collect now |
| Estimates | create/update/cancel subscription estimates, invoice estimates, renewal estimates |
| Operations | events, orders, currencies, business entities |

## Payload Tools

Chargebee write endpoints accept form-encoded parameter names, including bracketed names such as `subscription_items[item_price_id][0]`. Expanded write tools accept a `payload` object and pass it directly to Chargebee, so callers can use the exact field names from the API docs.

```php
$service->apiPost('/customers/customer_123/subscription_for_items', [
    'subscription_items[item_price_id][0]' => 'basic-USD',
    'subscription_items[quantity][0]' => 3,
]);
```

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- Chargebee API v2 key

## License

MIT. See [LICENSE](LICENSE).
