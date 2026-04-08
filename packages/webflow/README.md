# Integration: Webflow

> Webflow CMS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage sites, collections, and items. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Webflow CMS. List sites and collections, browse items, create new content — all through the [Webflow Data API](https://developers.webflow.com/data/docs).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Webflow tool lets AI agents manage CMS content — listing sites and collections, reading items, and creating new entries — giving agents the ability to manage web content programmatically.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-webflow
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Webflow access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'webflow' => [
        'access_token' => env('WEBFLOW_ACCESS_TOKEN'),
        'url'          => env('WEBFLOW_API_URL', 'https://api.webflow.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `webflow_list_sites` | read | List all sites the authenticated user has access to |
| `webflow_get_site` | read | Get details for a specific site |
| `webflow_list_collections` | read | List CMS collections for a site |
| `webflow_list_items` | read | List items in a CMS collection |
| `webflow_get_item` | read | Get a single CMS item |
| `webflow_create_item` | write | Create a new item in a CMS collection |
| `webflow_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\Integrations\Webflow\Tools\WebflowListSites;
use OpenCompany\Integrations\Webflow\Tools\WebflowCreateItem;

// Create tools
$service = app(WebflowService::class);
$tools = [
    new WebflowListSites($service),
    new WebflowCreateItem($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Webflow sites and create a new blog post draft');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('webflow');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Webflow\Tools\WebflowListSites::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Webflow\WebflowService;

$service = app(WebflowService::class);

// List sites
$sites = $service->listSites();

// Get a specific site
$site = $service->getSite('641d84b8f0bca14670785897');

// List collections for a site
$collections = $service->listCollections('641d84b8f0bca14670785897');

// List items in a collection
$items = $service->listItems('641d84b8f0bca14670785901');

// Get a single item
$item = $service->getItem('641d84b8f0bca14670785901', '641d84b8f0bca14670785905');

// Create a new item
$newItem = $service->createItem('641d84b8f0bca14670785901', [
    'name' => 'My New Post',
    'slug' => 'my-new-post',
    '_draft' => true,
]);

// Create and publish immediately
$newItem = $service->createItem('641d84b8f0bca14670785901', [
    'name' => 'Published Post',
    'slug' => 'published-post',
], live: true);

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
- A [Webflow](https://webflow.com) account with CMS access and an API token

## License

MIT — see [LICENSE](LICENSE)
