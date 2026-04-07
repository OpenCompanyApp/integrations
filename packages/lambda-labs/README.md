# Integration: Lambda Labs

> Lambda Labs GPU cloud integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage GPU instances, SSH keys, instance types, and machine images. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents control over Lambda Labs GPU cloud infrastructure. Launch and manage GPU instances, query available instance types and images, manage SSH keys, and monitor instance status — all through the [Lambda Labs Cloud API](https://cloud.lambdalabs.com/api/v1/docs).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lambda Labs tool lets AI agents manage GPU cloud infrastructure — provisioning GPU instances for training, managing SSH access, and monitoring instance health — giving agents operational capability over your GPU resources.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-lambda-labs
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Lambda Labs API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'lambda-labs' => [
        'api_key' => env('LAMBDA_LABS_API_KEY'),
        'url'     => env('LAMBDA_LABS_URL', 'https://cloud.lambdalabs.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lambda_labs_list_instances` | read | List all GPU instances |
| `lambda_labs_get_instance` | read | Get details for a specific instance |
| `lambda_labs_launch_instance` | write | Launch a new GPU instance |
| `lambda_labs_list_ssh_keys` | read | List all SSH keys |
| `lambda_labs_list_instance_types` | read | List available GPU instance types |
| `lambda_labs_list_images` | read | List available machine images |
| `lambda_labs_get_current_user` | read | Get current user information |

## Quick Start

```php
use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListInstances;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsLaunchInstance;

// Create tools
$service = app(LambdaLabsService::class);
$tools = [
    new LambdaLabsListInstances($service),
    new LambdaLabsLaunchInstance($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my GPU instances and show their status');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('lambda-labs');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListInstances::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;

$service = app(LambdaLabsService::class);

// List instances
$instances = $service->listInstances();

// Get a specific instance
$instance = $service->getInstance('12345');

// Launch an instance
$newInstance = $service->launchInstance([
    'name'          => 'gpu-training-01',
    'region_name'   => 'us-east-1',
    'instance_type' => 'gpu_1x_a100',
    'ssh_key_ids'   => ['ssh_key_id'],
]);

// List SSH keys
$sshKeys = $service->listSshKeys();

// List instance types
$types = $service->listInstanceTypes();

// List images
$images = $service->listImages();

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
- A [Lambda Labs](https://lambdalabs.com/) cloud account with API access

## License

MIT — see [LICENSE](LICENSE)
