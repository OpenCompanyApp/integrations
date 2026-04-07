# Integration: Netlify

> Netlify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage sites, deploys, forms, and DNS zones. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Netlify's modern web deployment and hosting platform. List and inspect sites, review deploy history, check form submissions, and manage DNS zones — all through the [Netlify API](https://docs.netlify.com/api/get-started/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Netlify tool lets AI agents inspect site deployments, review build statuses, and monitor form submissions — giving agents deployment awareness and hosting management capabilities.

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

### Creating a Personal Access Token

1. Go to your [Netlify User Settings](https://app.netlify.com/user/applications#personal-access-tokens)
2. Click **New access token**
3. Give it a description and click **Generate token**
4. Copy the token value

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `netlify_list_sites` | read | List all Netlify sites |
| `netlify_get_site` | read | Get details for a specific site |
| `netlify_list_deploys` | read | List deploys for a site |
| `netlify_get_deploy` | read | Get details for a specific deploy |
| `netlify_list_forms` | read | List forms for a site |
| `netlify_list_dns_zones` | read | List all DNS zones |
| `netlify_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListSites;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetSite;

// Create tools
$service = app(NetlifyService::class);
$tools = [
    new NetlifyListSites($service),
    new NetlifyGetSite($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Netlify sites and their latest deploys');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

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

// Get site details
$site = $service->getSite('abc123-def456');

// List deploys
$deploys = $service->listDeploys('abc123-def456');

// Get deploy details
$deploy = $service->getDeploy('789xyz');

// List forms
$forms = $service->listForms('abc123-def456');

// List DNS zones
$zones = $service->listDnsZones();

// Current user
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
- A [Netlify](https://www.netlify.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
