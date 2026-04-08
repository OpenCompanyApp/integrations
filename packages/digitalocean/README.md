# Integration: DigitalOcean

> DigitalOcean integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage droplets, domains, Spaces storage, and Kubernetes clusters. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents control over DigitalOcean cloud infrastructure. Create and manage droplets, query DNS domains, inspect Spaces object storage, and monitor Kubernetes clusters — all through the [DigitalOcean API v2](https://docs.digitalocean.com/reference/api/api-reference/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This DigitalOcean tool lets AI agents manage cloud infrastructure — provisioning servers, managing DNS, and monitoring cluster health — giving agents operational capability over your cloud resources.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-digitalocean
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a DigitalOcean personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'digitalocean' => [
        'access_token' => env('DIGITALOCEAN_TOKEN'),
        'url'          => env('DIGITALOCEAN_URL', 'https://api.digitalocean.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `digitalocean_list_droplets` | read | List all droplets (virtual machines) |
| `digitalocean_get_droplet` | read | Get details for a specific droplet |
| `digitalocean_create_droplet` | write | Create a new droplet |
| `digitalocean_delete_droplet` | write | Permanently delete a droplet |
| `digitalocean_reboot_droplet` | write | Reboot a droplet |
| `digitalocean_list_domains` | read | List all DNS domains |
| `digitalocean_get_domain` | read | Get details for a specific domain |
| `digitalocean_list_spaces` | read | List Spaces (object storage) |
| `digitalocean_list_kubernetes` | read | List Kubernetes clusters |
| `digitalocean_get_current_user` | read | Get current account information |

## Quick Start

```php
use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListDroplets;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanCreateDroplet;

// Create tools
$service = app(DigitalOceanService::class);
$tools = [
    new DigitalOceanListDroplets($service),
    new DigitalOceanCreateDroplet($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my droplets and show their status');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('digitalocean');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListDroplets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;

$service = app(DigitalOceanService::class);

// List droplets
$droplets = $service->listDroplets();

// Get a specific droplet
$droplet = $service->getDroplet(12345678);

// Create a droplet
$newDroplet = $service->createDroplet([
    'name'   => 'web-01',
    'region' => 'ams3',
    'size'   => 's-1vcpu-1gb',
    'image'  => 'ubuntu-24-04-x64',
]);

// Reboot a droplet
$service->rebootDroplet(12345678);

// List domains
$domains = $service->listDomains();

// List Spaces
$spaces = $service->listSpaces();

// List Kubernetes clusters
$clusters = $service->listKubernetesClusters();
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
- A [DigitalOcean](https://www.digitalocean.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
