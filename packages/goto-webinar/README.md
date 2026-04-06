# Integration: GoTo Webinar

> GoTo Webinar integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list webinars, manage sessions and panelists. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to webinar management. List and search webinars, view session details, manage panelists, and schedule new webinars — all through the [GoTo Webinar API](https://developer.goto.com/GoToWebinarV2).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This GoTo Webinar tool lets AI agents manage webinars, check session attendance, and look up panelist information — giving agents awareness of upcoming and past webinar events.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-goto-webinar
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a GoTo Webinar access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'goto-webinar' => [
        'access_token' => env('GOTO_WEBINAR_ACCESS_TOKEN'),
        'url'          => env('GOTO_WEBINAR_URL', 'https://api.getgo.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gotowebinar_list_webinars` | read | List webinars with optional status filtering and pagination |
| `gotowebinar_get_webinar` | read | Get details of a specific webinar |
| `gotowebinar_create_webinar` | write | Schedule a new webinar with subject, time slots, and description |
| `gotowebinar_list_sessions` | read | List sessions for a specific webinar |
| `gotowebinar_get_session` | read | Get details of a specific webinar session |
| `gotowebinar_list_panelists` | read | List panelists for a specific webinar |
| `gotowebinar_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarListWebinars;
use OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarGetWebinar;

// Create tools
$service = app(GoToWebinarService::class);
$tools = [
    new GoToWebinarListWebinars($service),
    new GoToWebinarGetWebinar($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my upcoming webinars');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('goto-webinar');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoToWebinar\Tools\GoToWebinarListWebinars::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;

$service = app(GoToWebinarService::class);

// List upcoming webinars
$webinars = $service->listWebinars(0, 20, 'ACTIVE');

// Get webinar details
$webinar = $service->getWebinar('1234567890');

// Create a webinar
$webinar = $service->createWebinar(
    subject: 'Q2 Product Demo',
    times: [
        ['startTime' => '2026-04-15T14:00:00Z', 'endTime' => '2026-04-15T15:00:00Z'],
    ],
    description: 'Join us for a live demo of our latest features.',
);

// List sessions
$sessions = $service->listSessions('1234567890');

// Get session details
$session = $service->getSession('1234567890', '9876543210');

// List panelists
$panelists = $service->listPanelists('1234567890');

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
- A [GoTo Webinar](https://www.gotomeeting.com/webinar) account with API access

## License

MIT — see [LICENSE](LICENSE)
