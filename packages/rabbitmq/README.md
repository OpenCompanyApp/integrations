# Integration: RabbitMQ

> RabbitMQ Management HTTP API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — monitor and manage broker nodes, queues, exchanges, bindings, connections, channels, consumers, vhosts, users, permissions, policies, and definitions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents visibility and controlled operational access to RabbitMQ. Query queue depths, inspect exchanges and bindings, review connection/channel/consumer state, run health checks, manage vhosts and permissions, and export definitions through the [RabbitMQ Management HTTP API](https://www.rabbitmq.com/docs/4.2/http-api-reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This RabbitMQ tool lets AI agents monitor message broker health, inspect queue backlogs, report on connection status, and perform explicit broker administration tasks when the host grants credentials with those permissions.

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
| `rabbitmq_get_overview` | read | Cluster overview |
| `rabbitmq_list_nodes`, `rabbitmq_get_node` | read | Node inventory and node details |
| `rabbitmq_health_check`, `rabbitmq_aliveness_test` | read | Management API health and vhost aliveness checks |
| `rabbitmq_list_queues`, `rabbitmq_get_queue`, `rabbitmq_declare_queue`, `rabbitmq_delete_queue`, `rabbitmq_purge_queue`, `rabbitmq_get_queue_bindings`, `rabbitmq_get_messages` | read/write | Queue listing, details, declaration, deletion, purge, bindings, and message inspection |
| `rabbitmq_list_exchanges`, `rabbitmq_get_exchange`, `rabbitmq_declare_exchange`, `rabbitmq_delete_exchange`, `rabbitmq_publish_message` | read/write | Exchange listing, details, declaration, deletion, and manual publish |
| `rabbitmq_list_bindings`, `rabbitmq_create_binding`, `rabbitmq_delete_binding`, `rabbitmq_list_exchange_source_bindings`, `rabbitmq_list_exchange_destination_bindings` | read/write | Binding inventory and management |
| `rabbitmq_list_connections`, `rabbitmq_get_connection`, `rabbitmq_close_connection` | read/write | Connection inventory, details, and close |
| `rabbitmq_list_channels`, `rabbitmq_get_channel`, `rabbitmq_list_consumers` | read | Channel and consumer visibility |
| `rabbitmq_list_vhosts`, `rabbitmq_get_vhost`, `rabbitmq_create_vhost`, `rabbitmq_delete_vhost` | read/write | Virtual host inventory and management |
| `rabbitmq_list_users`, `rabbitmq_get_user`, `rabbitmq_list_permissions`, `rabbitmq_set_permissions`, `rabbitmq_delete_permissions`, `rabbitmq_list_vhost_permissions`, `rabbitmq_list_policies` | read/write | User, permission, and policy inspection/management |
| `rabbitmq_export_definitions`, `rabbitmq_import_definitions` | read/write | Broker definition export/import |

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

If you have `integration-core` installed, the tools auto-register with the `ToolProviderRegistry`:

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

// Run health checks
$health = $service->healthCheck('alarms');

// Declare queue and binding
$service->declareQueue('/', 'order.process', ['durable' => true, 'arguments' => []]);
$service->createBinding('/', 'orders.events', 'queue', 'order.process', 'order.created');
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
