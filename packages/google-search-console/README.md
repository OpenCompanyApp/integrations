# Integration: Google Search Console

> Google Search Console integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list sites, sitemaps, search analytics, and URL inspection. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Search Console data. Query search performance, inspect sitemaps, check indexing status, and monitor site health — all through the [Google Search Console API](https://developers.google.com/webmaster-tools/search-console-api-original/v3/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Search Console tool lets AI agents query search performance data, inspect sitemap status, and check URL indexing — giving agents SEO and search visibility awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-search-console
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth 2.0 access token with the `https://www.googleapis.com/auth/webmasters.readonly` scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-search-console' => [
        'access_token' => env('GOOGLE_SEARCH_CONSOLE_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_SEARCH_CONSOLE_URL', 'https://searchconsole.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gsc_list_sites` | read | List sites the user has access to |
| `gsc_get_site` | read | Get details for a specific site |
| `gsc_list_sitemaps` | read | List sitemaps submitted for a site |
| `gsc_get_sitemap` | read | Get details for a specific sitemap |
| `gsc_list_search_analytics` | read | Query search performance data (clicks, impressions, CTR, position) |
| `gsc_list_url_inspection` | read | Inspect URL indexing status and issues |
| `gsc_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSearchAnalytics;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSites;

// Create tools
$service = app(GoogleSearchConsoleService::class);
$tools = [
    new GscListSites($service),
    new GscListSearchAnalytics($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top search queries for example.com this month?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-search-console');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleSearchConsole\Tools\GscListSearchAnalytics::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;

$service = app(GoogleSearchConsoleService::class);

// List sites
$sites = $service->listSites();

// Get site details
$site = $service->getSite('https://example.com/');

// List sitemaps
$sitemaps = $service->listSitemaps('https://example.com/');

// Query search analytics
$analytics = $service->listSearchAnalytics(
    siteUrl: 'https://example.com/',
    startDate: '2025-01-01',
    endDate: '2025-01-31',
    dimensions: ['query', 'page'],
);

// Inspect URLs
$inspection = $service->listUrlInspection('https://example.com/');

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
- A Google account with Search Console access and an OAuth 2.0 access token

## License

MIT — see [LICENSE](LICENSE)
