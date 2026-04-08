# Integration: Ahrefs

> Ahrefs SEO integration for the [Laravel AI SDK](https://github.com/laravel/ai) — backlinks, referring domains, organic keywords, pages, paid keywords, and anchors. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful SEO data. Analyze backlink profiles, research organic and paid keywords, discover top-performing pages, and audit anchor text distributions — all through the [Ahrefs](https://ahrefs.com) API v3.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Ahrefs tool lets AI agents query backlink data, analyze keyword rankings, and perform competitive SEO research — giving agents data-driven insights into search performance.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ahrefs
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Ahrefs API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'ahrefs' => [
        'api_key' => env('AHREFS_API_KEY'),
        'url'     => env('AHREFS_URL', 'https://api.ahrefs.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `ahrefs_list_backlinks` | read | List backlinks pointing to a target website or URL |
| `ahrefs_list_referring_domains` | read | List domains that link to a target |
| `ahrefs_list_organic_keywords` | read | List organic keywords a target ranks for |
| `ahrefs_list_pages` | read | List top pages for a target |
| `ahrefs_list_paid_keywords` | read | List paid (PPC) keywords a target bids on |
| `ahrefs_list_anchors` | read | List anchor texts used in backlinks |
| `ahrefs_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListBacklinks;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListOrganicKeywords;

// Create tools
$service = app(AhrefsService::class);
$tools = [
    new AhrefsListBacklinks($service),
    new AhrefsListOrganicKeywords($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top backlinks to example.com?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('ahrefs');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Ahrefs\Tools\AhrefsListBacklinks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Ahrefs\AhrefsService;

$service = app(AhrefsService::class);

// List backlinks
$backlinks = $service->listBacklinks('example.com', limit: 50);

// List referring domains
$domains = $service->listReferringDomains('example.com');

// List organic keywords
$keywords = $service->listOrganicKeywords('example.com', mode: 'domain');

// List top pages
$pages = $service->listPages('example.com');

// List paid keywords
$paid = $service->listPaidKeywords('example.com');

// List anchors
$anchors = $service->listAnchors('example.com');

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
- An [Ahrefs](https://ahrefs.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
