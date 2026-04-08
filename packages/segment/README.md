# Integration: Segment

> Segment integration for the [Laravel AI SDK](https://github.com/laravel/ai) — identify users, track events, record page views, manage groups, and query workspace/source data. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Segment](https://segment.com) customer data platform. Identify users, track events, record page views, manage group associations, and query workspace metadata — all through the Segment Tracking and Public APIs.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Segment tool lets AI agents interact with your customer data pipeline — identifying users, tracking events, and managing Segment configuration — giving agents real-time access to customer analytics.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-segment
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Segment write key (for the Tracking API) and optionally an API token (for the Public API — workspace/source management).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'segment' => [
        'write_key' => env('SEGMENT_WRITE_KEY'),
        'api_token' => env('SEGMENT_API_TOKEN'),
        'url'       => env('SEGMENT_URL', 'https://api.segment.io/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `segment_identify` | write | Identify a user with traits (name, email, plan, etc.) |
| `segment_track` | write | Track a custom event for a user |
| `segment_page` | write | Record a page view event |
| `segment_group` | write | Associate a user with a group (company, org) |
| `segment_get_workspace` | read | Get details of a Segment workspace |
| `segment_list_sources` | read | List sources in a workspace |
| `segment_get_source` | read | Get details of a specific source |
| `segment_get_current_user` | read | Get the authenticated Segment user |

## Authentication

### Tracking API (identify, track, page, group)

The Tracking API uses **HTTP Basic Auth** with your Segment write key as the username and an empty password. This is handled automatically by the service.

### Public API (workspace, sources, current user)

The Public API uses a **Bearer token** (Personal Access Token). Generate one in your Segment account settings.

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\Integrations\Segment\Tools\SegmentTrack;
use OpenCompany\Integrations\Segment\Tools\SegmentIdentify;

// Create tools
$service = app(SegmentService::class);
$tools = [
    new SegmentIdentify($service),
    new SegmentTrack($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Track a "Signup Completed" event for user 42');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('segment');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Segment\Tools\SegmentTrack::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Segment\SegmentService;

$service = app(SegmentService::class);

// Identify a user
$service->identify('user-42', [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
    'plan' => 'pro',
]);

// Track an event
$service->track('Order Completed', 'user-42', [
    'revenue' => 99.99,
    'currency' => 'USD',
]);

// Record a page view
$service->page('Product Page', 'user-42', [
    'url' => '/products/widget',
    'category' => 'Widgets',
]);

// Associate user with a group
$service->group('org-123', 'user-42', [
    'name' => 'Acme Corp',
    'plan' => 'enterprise',
]);

// Get workspace info (requires API token)
$workspace = $service->getWorkspace('my-workspace');

// List sources
$sources = $service->listSources('my-workspace');

// Get specific source
$source = $service->getSource('my-workspace', 'source-abc');

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
- A [Segment](https://segment.com) account with a source write key

## License

MIT — see [LICENSE](LICENSE)
