# Integration: Dub.co

> Dub.co link management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage short links, domains, and tags. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Dub.co](https://dub.co) link management. Create short links, list and search existing links, manage domains and tags — all through the Dub.co REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Dub.co tool lets AI agents manage short links, check link performance, and organize links with tags — enabling automated marketing workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-dub
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Dub.co API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'dub' => [
        'access_token' => env('DUB_ACCESS_TOKEN'),
        'base_url'     => env('DUB_BASE_URL', 'https://api.dub.co'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `dub_list_links` | read | List short links with pagination, search, and filtering |
| `dub_get_link` | read | Get details of a specific short link |
| `dub_create_link` | write | Create a new short link |
| `dub_list_domains` | read | List configured domains |
| `dub_get_domain` | read | Get details of a specific domain |
| `dub_list_tags` | read | List link tags |
| `dub_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\Integrations\Dub\Tools\DubListLinks;
use OpenCompany\Integrations\Dub\Tools\DubCreateLink;

// Create tools
$service = app(DubService::class);
$tools = [
    new DubListLinks($service),
    new DubCreateLink($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a short link for https://example.com/my-long-page with the key "my-page"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('dub');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Dub\Tools\DubListLinks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Dub\DubService;

$service = app(DubService::class);

// List links
$links = $service->listLinks(page: 1, pageSize: 10, search: 'campaign');

// Get a link
$link = $service->getLink('clx_abc123');

// Create a link
$link = $service->createLink(
    url: 'https://example.com/long-url',
    domain: 'dub.sh',
    key: 'my-link',
    title: 'My Campaign Link',
    tags: ['campaign', 'social'],
);

// List domains
$domains = $service->listDomains();

// List tags
$tags = $service->listTags(search: 'campaign');

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
- A [Dub.co](https://dub.co) account with API access

## License

MIT — see [LICENSE](LICENSE)
