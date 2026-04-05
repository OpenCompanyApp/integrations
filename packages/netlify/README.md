# Integration: Netlify

> Netlify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage sites, deploys, and forms via the Netlify API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Netlify's hosting platform. List and manage sites, trigger deployments, and inspect forms — all through the [Netlify API](https://open-api.netlify.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Netlify tool lets AI agents manage web hosting, trigger deployments, and monitor form submissions — giving agents full lifecycle management of web properties.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-netlify
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Netlify personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'netlify' => [
        'access_token' => env('NETLIFY_ACCESS_TOKEN'),
        'url'          => env('NETLIFY_API_URL', 'https://api.netlify.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `netlify_list_sites` | read | List all Netlify sites |
| `netlify_get_site` | read | Get details for a specific site |
| `netlify_create_site` | write | Create a new Netlify site |
| `netlify_delete_site` | write | Delete a site permanently |
| `netlify_list_deploys` | read | List deploys for a site |
| `netlify_create_deploy` | write | Trigger a new deploy |
| `netlify_list_forms` | read | List forms for a site |
| `netlify_get_form` | read | Get details for a specific form |
| `netlify_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListSites;
use OpenCompany\Integrations\Netlify\Tools\NetlifyCreateDeploy;

// Create tools
$service = app(NetlifyService::class);
$tools = [
    new NetlifyListSites($service),
    new NetlifyCreateDeploy($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Netlify sites and deploy the staging branch for example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('netlify');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Netlify\Tools\NetlifyListSites::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Netlify\NetlifyService;

$service = app(NetlifyService::class);

// List sites
$sites = $service->listSites();

// Get a specific site
$site = $service->getSite('abc123-def456');

// Create a site
$site = $service->createSite('my-site', [
    'custom_domain' => 'www.example.com',
]);

// Trigger a deploy
$deploy = $service->createDeploy('abc123-def456', [
    'branch' => 'main',
    'title' => 'Production deploy',
]);

// List forms
$forms = $service->listForms('abc123-def456');

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
- A [Netlify](https://netlify.com) account with a personal access token

## License

MIT — see [LICENSE](LICENSE)
