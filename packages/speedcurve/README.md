# Integration: SpeedCurve

> SpeedCurve performance monitoring integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage sites, tests, and deployments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to front-end performance data. Monitor Core Web Vitals, track synthetic test results, and register deployments to measure performance impact — all through the [SpeedCurve](https://speedcurve.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This SpeedCurve tool lets AI agents query performance metrics, review synthetic test results, and track deployment impact — giving agents visibility into front-end performance.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-speedcurve
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a SpeedCurve API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'speedcurve' => [
        'api_key' => env('SPEEDCURVE_API_KEY'),
        'url'     => env('SPEEDCURVE_URL', 'https://api.speedcurve.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `speedcurve_list_sites` | read | List all monitored sites |
| `speedcurve_get_site` | read | Get details for a specific site |
| `speedcurve_list_tests` | read | List recent synthetic test results |
| `speedcurve_get_test` | read | Get detailed results for a test run |
| `speedcurve_list_deployments` | read | List recent deployments and performance impact |
| `speedcurve_create_deployment` | write | Register a deployment to trigger tests |
| `speedcurve_get_current_user` | read | Get authenticated user details |

## Quick Start

```php
use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveListSites;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveGetTest;

// Create tools
$service = app(SpeedcurveService::class);
$tools = [
    new SpeedcurveListSites($service),
    new SpeedcurveGetTest($service),
];
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('speedcurve');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveListSites::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Speedcurve\SpeedcurveService;

$service = app(SpeedcurveService::class);

// List sites
$sites = $service->listSites();

// Get site details
$site = $service->getSite(12345);

// List recent tests
$tests = $service->listTests(['site_id' => 12345, 'days' => 7]);

// Get test details
$test = $service->getTest(67890);

// List deployments
$deployments = $service->listDeployments(['site_id' => 12345]);

// Create deployment
$deployment = $service->createDeployment([
    'site_id' => 12345,
    'note' => 'Deploy v2.3.1',
]);

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

SpeedCurve uses HTTP Basic Authentication. The API key is passed as the username with a blank password. This is handled automatically by the service.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [SpeedCurve](https://speedcurve.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
