# Integration: RabbitMQ

> RabbitMQ Management API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — monitor queues, exchanges, connections, vhosts, and cluster health. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents visibility into your RabbitMQ message broker. Query queue depths, inspect exchanges, monitor active connections, and review cluster health — all through the [RabbitMQ Management HTTP API](https://www.rabbitmq.com/docs/management).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This RabbitMQ tool lets AI agents monitor message broker health, inspect queue backlogs, and report on connection status — giving agents operational awareness of messaging infrastructure.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-rabbitmq
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration uses HTTP Basic authentication against the RabbitMQ Management API.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'rabbitmq' => [
        'username'  => env('RABBITMQ_USERNAME', 'guest'),
        'password'  => env('RABBITMQ_PASSWORD', 'guest'),
        'hostname'  => env('RABBITMQ_MANAGEMENT_URL', 'http://localhost:15672'),
    ],
];
```

> **Note:** The Management plugin must be enabled on your RabbitMQ node. Run `rabbitmq-plugins enable rabbitmq_management` if it is not already enabled. The default guest account only works from localhost.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `rabbitmq_list_queues` | read | List all queues across all virtual hosts |
| `rabbitmq_get_queue` | read | Get detailed information about a specific queue |
| `rabbitmq_list_exchanges` | read | List all exchanges across all virtual hosts |
| `rabbitmq_list_connections` | read | List all active AMQP connections |
| `rabbitmq_list_vhosts` | read | List all virtual hosts |
| `rabbitmq_get_overview` | read | Cluster overview — node info, message rates, queue totals |

## Quick Start

```php
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListQueues;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetOverview;

// Create tools
$service = app(RabbitMQService::class);
$tools = [
    new RabbitMQListQueues($service),
    new RabbitMQGetOverview($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many messages are waiting in the order queue?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('rabbitmq');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQListQueues::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

$service = app(RabbitMQService::class);

// List queues
$queues = $service->listQueues();

// Get a specific queue
$queue = $service->getQueue('/', 'order.process');

// List exchanges
$exchanges = $service->listExchanges();

// List connections
$connections = $service->listConnections();

// List vhosts
$vhosts = $service->listVhosts();

// Cluster overview
$overview = $service->getOverview();
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
- RabbitMQ with the [Management plugin](https://www.rabbitmq.com/docs/management) enabled

## License

MIT — see [LICENSE](LICENSE)
