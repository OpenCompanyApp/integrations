# Integration: Canva

> Canva Connect API integration for OpenCompany and KosmoKrator agents.

This package exposes the official Canva Connect API surface from Canva's public OpenAPI description. Agents can work with assets, upload jobs, design autofill, brand templates, comments, designs, imports, exports, folders, OAuth token utilities, OIDC keys, resize jobs, and user profile endpoints.

## Installation

```console
composer require opencompanyapp/integration-canva
```

Laravel auto-discovers the service provider.

## Configuration

Most Canva operations require a user-scoped OAuth access token. OAuth token endpoints can use optional client credentials.

```php
return [
    'canva' => [
        'access_token' => env('CANVA_ACCESS_TOKEN'),
        'client_id' => env('CANVA_CLIENT_ID'),
        'client_secret' => env('CANVA_CLIENT_SECRET'),
        'url' => env('CANVA_URL', 'https://api.canva.com/rest'),
    ],
];
```

## Coverage

The tool catalog is generated from:

`https://www.canva.dev/sources/connect/api/latest/api.yml`

It currently exposes 48 Canva Connect operations. Tool names use the `canva_` prefix and snake_case forms of the OpenAPI operation IDs, with `canva_get_current_user` retained for the current-user endpoint.

## Usage

```php
use OpenCompany\Integrations\Canva\CanvaService;

$service = app(CanvaService::class);

$designs = $service->call('canva_list_designs', [
    'limit' => 10,
    'query' => 'quarterly report',
]);

$export = $service->call('canva_create_design_export_job', [
    'payload' => [
        'design_id' => 'DAFexample',
        'format' => ['type' => 'pdf'],
    ],
]);
```

## Tool Arguments

Path, query, and required header parameters are top-level snake_case arguments. JSON and form bodies use `payload`. Binary upload operations use `body` plus the documented metadata header argument.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Canva Connect integration and OAuth token for user-scoped operations

## License

MIT
