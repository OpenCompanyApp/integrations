# Integration: PlanetScale

> PlanetScale serverless MySQL integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage databases, branches, and organizations. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to serverless MySQL management. List and create databases, inspect branches, and manage organizations through the [PlanetScale](https://planetscale.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This PlanetScale tool lets AI agents inspect database schemas, manage branches, and create new databases — giving agents database operations capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-planetscale
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a PlanetScale service token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'planetscale' => [
        'access_token' => env('PLANETSCALE_ACCESS_TOKEN'),
        'url'          => env('PLANETSCALE_URL', 'https://api.planetscale.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `planetscale_list_databases` | read | List databases in a PlanetScale organization |
| `planetscale_get_database` | read | Get details of a specific database |
| `planetscale_create_database` | write | Create a new database in an organization |
| `planetscale_list_branches` | read | List branches of a database |
| `planetscale_get_branch` | read | Get details of a specific branch |
| `planetscale_list_organizations` | read | List organizations the user belongs to |
| `planetscale_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleListDatabases;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleCreateDatabase;

// Create tools
$service = app(PlanetScaleService::class);
$tools = [
    new PlanetScaleListDatabases($service),
    new PlanetScaleCreateDatabase($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my PlanetScale databases in the my-org organization');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('planetscale');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleListDatabases::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\PlanetScale\PlanetScaleService;

$service = app(PlanetScaleService::class);

// List organizations
$orgs = $service->listOrganizations();

// List databases
$databases = $service->listDatabases('my-org');

// Get a specific database
$db = $service->getDatabase('my-org', 'my-database');

// Create a database
$newDb = $service->createDatabase('my-org', 'my-new-db', [
    'region' => 'us-east-1',
    'notes' => 'Production database',
]);

// List branches
$branches = $service->listBranches('my-org', 'my-database');

// Get a specific branch
$branch = $service->getBranch('my-org', 'my-database', 'main');

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
- A [PlanetScale](https://planetscale.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
