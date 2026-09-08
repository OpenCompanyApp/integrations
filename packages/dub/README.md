# Integration: Dub

Dub integration package for OpenCompany and compatible Laravel hosts.

This package exposes the official Dub API resource surface from the official
Dub PHP SDK. It registers 52 operation tools for links, analytics, domains,
folders, tags, events, customers, partners, commissions, payouts, QR codes, and
conversion tracking.

## Installation

```console
composer require opencompanyapp/integration-dub
```

Laravel auto-discovers the service provider.

## Configuration

```php
return [
    'dub' => [
        'access_token' => env('DUB_API_KEY'),
        'base_url' => env('DUB_BASE_URL', 'https://api.dub.co'),
    ],
];
```

Dub uses bearer-token authentication:

```text
Authorization: Bearer dub_xxxxxxxx
```

## Tool Coverage

The provider exposes one tool per official SDK operation. Tool arguments use
snake_case path parameters, `query` for query-string filters, and `payload` for
JSON bodies.

Representative tools:

- `dub_links_list`, `dub_links_create`, `dub_links_update`, `dub_links_delete`
- `dub_analytics_retrieve`, `dub_events_list`, `dub_qr_codes_get`
- `dub_domains_list`, `dub_domains_create`, `dub_domains_check_status`
- `dub_partners_list`, `dub_partners_create_link`, `dub_partners_analytics`
- `dub_track_lead`, `dub_track_sale`

See `script-docs/dub.md` for the full tool list and method/path reference.

## License

MIT
