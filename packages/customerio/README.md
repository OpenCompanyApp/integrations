# Integration: Customer.io

Customer.io integration package for OpenCompany and compatible Laravel hosts.

This package exposes the official Customer.io OpenAPI surface across the App,
Track, and Pipelines APIs. It registers 183 operation tools generated from
Customer.io's published API specs and keeps request shaping in the service layer.

## Installation

```console
composer require opencompanyapp/integration-customerio
```

Laravel auto-discovers the service provider.

## Configuration

Configure the credential sets needed by the operations you plan to use.

```php
return [
    'customerio' => [
        'api_key' => env('CUSTOMERIO_APP_API_KEY'),
        'url' => env('CUSTOMERIO_APP_URL', 'https://api.customer.io'),
        'site_id' => env('CUSTOMERIO_TRACK_SITE_ID'),
        'track_api_key' => env('CUSTOMERIO_TRACK_API_KEY'),
        'track_url' => env('CUSTOMERIO_TRACK_URL', 'https://track.customer.io'),
        'pipelines_api_key' => env('CUSTOMERIO_PIPELINES_API_KEY'),
        'pipelines_url' => env('CUSTOMERIO_PIPELINES_URL', 'https://cdp.customer.io/v1'),
    ],
];
```

App API tools use bearer auth with `api_key`. Track API tools use basic auth
with `site_id` and `track_api_key`. Pipelines API tools use basic auth with the
Pipelines API key as the username and an empty password.

## Tool Coverage

The provider exposes 183 tools:

- App API: campaigns, newsletters, broadcasts, messages, people, objects,
  segments, webhooks, snippets, assets, exports, and transactional messages.
- Track API: identify, track, delete, devices, segments, suppression,
  unsubscribe, forms, metrics, and region lookup.
- Pipelines API: identify, track, page, screen, group, alias, and batch calls.

Each generated tool accepts snake_case path and query arguments. JSON request
bodies go under `payload`. The Lua docs in `lua-docs/customerio.md` list every
tool, method, path, parameters, and body requirement.

## License

MIT
