# Integration: Courier

> Courier API integration for OpenCompany and KosmoKrator agents.

This package exposes the official Courier API reference surface linked from Courier's machine-readable documentation index. Agents can send messages, run bulk jobs, manage profiles, tokens, lists, audiences, tenants, preferences, templates, routing strategies, automations, journeys, audit events, message logs, brands, translations, and JWTs.

## Installation

```console
composer require opencompanyapp/integration-courier
```

Laravel auto-discovers the service provider.

## Configuration

Courier uses API keys as bearer tokens. Test and production environments use different keys.

```php
return [
    'courier' => [
        'api_key' => env('COURIER_API_KEY'),
        'url' => env('COURIER_URL', 'https://api.courier.com'),
    ],
];
```

## Coverage

The tool catalog is generated from Courier API reference markdown linked by:

`https://www.courier.com/docs/llms.txt`

It currently exposes 89 verified Courier API operations. Tool names use the `courier_` prefix and snake_case forms of Courier operation IDs.

## Usage

```php
use OpenCompany\Integrations\Courier\CourierService;

$service = app(CourierService::class);

$sent = $service->call('courier_send', [
    'payload' => [
        'message' => [
            'to' => ['user_id' => 'user_123'],
            'template' => 'template_id',
            'data' => ['name' => 'Ada'],
        ],
    ],
]);

$profile = $service->call('courier_profiles_create', [
    'user_id' => 'user_123',
    'payload' => [
        'profile' => ['email' => 'ada@example.test'],
    ],
]);
```

## Tool Arguments

Path and query parameters are top-level snake_case arguments. JSON request bodies use `payload`.

Important Courier behavior:

- Use `courier_profiles_create` or `courier_profiles_merge_profile` for partial profile updates.
- Use `courier_profiles_replace` only when replacing the full profile.
- Bulk sending is a three-step flow: create job, add users, run job.
- Include Courier idempotency headers through the host HTTP layer when building high-risk transactional sends.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Courier account and API key

## License

MIT
