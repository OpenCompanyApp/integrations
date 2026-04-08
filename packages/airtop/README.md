# Integration: Airtop

> Airtop browser automation integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create sessions, manage windows, navigate pages, and extract content. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to browse the web. Create browser sessions, open windows, navigate to URLs, and extract page content — all through the [Airtop](https://airtop.ai) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Airtop tool lets AI agents browse websites, automate web interactions, and extract information from web pages — giving agents the ability to interact with the live web.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-airtop
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Airtop API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'airtop' => [
        'api_key' => env('AIRTOP_API_KEY'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `airtop_create_session` | write | Create a new browser session |
| `airtop_get_session` | read | Get details of a browser session |
| `airtop_create_window` | write | Open a new browser window in a session |
| `airtop_get_window` | read | Get details of a browser window |
| `airtop_navigate` | write | Navigate a window to a URL |
| `airtop_get_page_content` | read | Extract the content of a page |
| `airtop_list_sessions` | read | List all browser sessions |
| `airtop_get_current_user` | read | Get current user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\Integrations\Airtop\Tools\AirtopCreateSession;
use OpenCompany\Integrations\Airtop\Tools\AirtopNavigate;

// Create tools
$service = app(AirtopService::class);
$tools = [
    new AirtopCreateSession($service),
    new AirtopNavigate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Open a browser, go to example.com, and tell me what the page says.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('airtop');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Airtop\Tools\AirtopCreateSession::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Airtop\AirtopService;

$service = app(AirtopService::class);

// Create a session
$session = $service->createSession();

// Create a window
$window = $service->createWindow($session['id']);

// Navigate to a URL
$service->navigate($session['id'], $window['id'], 'https://example.com');

// Get page content
$content = $service->getPageContent($session['id'], $window['id']);

// List sessions
$sessions = $service->listSessions();

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
- An [Airtop](https://airtop.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
