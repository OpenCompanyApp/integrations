# Integration: Samsara

> Samsara fleet and IoT management integration for [OpenCompany](https://github.com/OpenCompanyApp) — vehicles, drivers, sensors, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to fleet and IoT data. List and inspect vehicles, drivers, and sensors — all through the [Samsara](https://www.samsara.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Samsara tool lets AI agents query fleet vehicles, retrieve driver information, list IoT sensors, and verify API connectivity — giving agents real-time awareness of fleet operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-samsara
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Samsara API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'samsara' => [
        'access_token' => env('SAMSARA_ACCESS_TOKEN'),
        'url'          => env('SAMSARA_URL', 'https://api.samsara.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `samsara_list_vehicles` | read | List fleet vehicles with pagination |
| `samsara_get_vehicle` | read | Get details for a specific vehicle by ID |
| `samsara_list_drivers` | read | List fleet drivers with pagination |
| `samsara_get_driver` | read | Get details for a specific driver by ID |
| `samsara_list_sensors` | read | List IoT sensors with pagination |
| `samsara_get_current_user` | read | Get the currently authenticated Samsara user |

## Quick Start

```php
use OpenCompany\Integrations\Samsara\SamsaraService;
use OpenCompany\Integrations\Samsara\Tools\SamsaraListVehicles;
use OpenCompany\Integrations\Samsara\Tools\SamsaraGetCurrentUser;

// Create tools
$service = app(SamsaraService::class);
$tools = [
    new SamsaraListVehicles($service),
    new SamsaraGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many vehicles are in our fleet?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('samsara');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Samsara\Tools\SamsaraListVehicles::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Samsara\SamsaraService;

$service = app(SamsaraService::class);

// List vehicles (first page)
$vehicles = $service->listVehicles(50);

// Get a specific vehicle
$vehicle = $service->getVehicle('123456789012345');

// List drivers
$drivers = $service->listDrivers();

// Get a specific driver
$driver = $service->getDriver('987654321098765');

// List sensors
$sensors = $service->listSensors();

// Get current user
$user = $service->getCurrentUser();
```

## Multi-Account Support

The Samsara integration supports multiple credential sets per workspace. Agents can target specific accounts:

```php
// ToolProvider resolves credentials for the named account
$tool = $provider->createTool(
    SamsaraListVehicles::class,
    ['account' => 'europe-fleet']
);
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A [Samsara](https://www.samsara.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
