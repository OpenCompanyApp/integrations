# Integration: Cloudflare

> Cloudflare integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage zones, DNS records, page rules, and analytics. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Cloudflare's DNS, CDN, and security management platform. List and manage zones, create DNS records, review page rules, and pull analytics - all through the [Cloudflare API](https://developers.cloudflare.com/api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Cloudflare tool lets AI agents manage DNS records, review zone configuration, and monitor traffic analytics - giving agents infrastructure awareness and management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-cloudflare
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Cloudflare API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'cloudflare' => [
        'access_token' => env('CLOUDFLARE_API_TOKEN'),
        'url'          => env('CLOUDFLARE_API_URL', 'https://api.cloudflare.com/client/v4'),
    ],
];
```

### Creating an API Token

1. Go to the [Cloudflare dashboard](https://dash.cloudflare.com/profile/api-tokens)
2. Click **Create Token**
3. Use a template (e.g., "Edit zone DNS") or create a custom token with the permissions you need
4. Copy the token value

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cloudflare_list_zones` | read | List all Cloudflare zones (domains) |
| `cloudflare_get_zone` | read | Get details for a specific zone |
| `cloudflare_list_dns_records` | read | List DNS records for a zone |
| `cloudflare_create_dns_record` | write | Create a new DNS record |
| `cloudflare_list_page_rules` | read | List page rules for a zone |
| `cloudflare_get_analytics` | read | Get analytics dashboard data for a zone |
| `cloudflare_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListZones;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListDnsRecords;

// Create tools
$service = app(CloudflareService::class);
$tools = [
    new CloudflareListZones($service),
    new CloudflareListDnsRecords($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Cloudflare zones and their DNS records');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('cloudflare');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Cloudflare\Tools\CloudflareListZones::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Cloudflare\CloudflareService;

$service = app(CloudflareService::class);

// List zones
$zones = $service->listZones();

// Get zone details
$zone = $service->getZone('023e105f4ecef8ad9ca31a8372d0c353');

// List DNS records
$records = $service->listDnsRecords('023e105f4ecef8ad9ca31a8372d0c353', ['type' => 'A']);

// Create a DNS record
$record = $service->createDnsRecord('023e105f4ecef8ad9ca31a8372d0c353', [
    'type' => 'A',
    'name' => 'www.example.com',
    'content' => '192.0.2.1',
    'ttl' => 1,
    'proxied' => true,
]);

// Page rules
$rules = $service->listPageRules('023e105f4ecef8ad9ca31a8372d0c353');

// Analytics
$analytics = $service->getAnalytics('023e105f4ecef8ad9ca31a8372d0c353', '-7d', 'now');

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
- A [Cloudflare](https://www.cloudflare.com/) account with API access

## License

MIT - see [LICENSE](LICENSE)
