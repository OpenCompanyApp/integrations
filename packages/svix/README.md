# Integration: Svix

Svix webhook service integration for OpenCompany agents. The package exposes
the official Svix OpenAPI surface for applications, messages, endpoints, event
types, integrations, streams, ingest, connectors, background tasks, statistics,
authentication helpers, and operational webhooks.

## Installation

```console
composer require opencompanyapp/integration-svix
```

Laravel auto-discovers the service provider.

## Configuration

Configure a Svix auth token. Svix cloud uses `https://api.svix.com`; self-hosted
Svix deployments can set a custom base URL.

```php
return [
    'svix' => [
        'auth_token' => env('SVIX_AUTH_TOKEN'),
        'url' => env('SVIX_URL', 'https://api.svix.com'),
    ],
];
```

## Coverage

This package is generated from the official Svix OpenAPI document at
`https://api.svix.com/api/v1/openapi.json` and currently exposes 128 tools.
Representative tools include:

| Tool | Type | Description |
|------|------|-------------|
| `svix_list_applications` | read | List applications |
| `svix_create_application` | write | Create an application |
| `svix_list_endpoints` | read | List application endpoints |
| `svix_create_message` | write | Create a webhook message |
| `svix_list_event_types` | read | List event types |
| `svix_create_stream` | write | Create a stream |
| `svix_create_ingest_source` | write | Create an ingest source |
| `svix_list_operational_webhook_endpoints` | read | List operational webhook endpoints |

## Usage

```php
use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\Integrations\Svix\Tools\SvixListApplications;

$tool = new SvixListApplications(app(SvixService::class));
$result = $tool->execute(['limit' => 10]);
```

The service also supports direct operation execution:

```php
use OpenCompany\Integrations\Svix\SvixService;

$service = app(SvixService::class);

$apps = $service->call('svix_list_applications', ['limit' => 10]);

$message = $service->call('svix_create_message', [
    'app_id' => 'app_123',
    'payload' => [
        'eventType' => 'user.created',
        'payload' => ['id' => 'user_123'],
    ],
]);
```

## Tool Arguments

Path and query parameters are exposed as typed top-level tool parameters using
snake_case names. For example, `idempotency-key` is available as
`idempotency_key`.

Write operations accept a `payload` object for the documented JSON request body.
Tools also accept `query` for extra documented query parameters and `headers`
for optional extra HTTP headers.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Svix account or self-hosted Svix deployment with API access

## License

MIT. See [LICENSE](LICENSE).
