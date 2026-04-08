# Integration: Weave

> Weave healthcare integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage patients, appointments, and messages. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Weave](https://getweave.com) healthcare communication platform. Search patient records, look up appointments, and review messages — all through the Weave API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Weave tool lets AI agents access patient information, manage appointment schedules, and review communications — giving agents context-aware access to healthcare workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-weave
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Weave API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'weave' => [
        'access_token' => env('WEAVE_ACCESS_TOKEN'),
        'url'          => env('WEAVE_URL', 'https://api.getweave.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `weave_list_patients` | read | Search and list patients with pagination and filtering |
| `weave_get_patient` | read | Retrieve a single patient by ID |
| `weave_list_appointments` | read | List appointments with optional date range filtering |
| `weave_get_appointment` | read | Retrieve a single appointment by ID |
| `weave_list_messages` | read | List messages with optional type filtering |
| `weave_get_message` | read | Retrieve a single message by ID |
| `weave_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\Integrations\Weave\Tools\WeaveListPatients;
use OpenCompany\Integrations\Weave\Tools\WeaveGetPatient;

// Create tools
$service = app(WeaveService::class);
$tools = [
    new WeaveListPatients($service),
    new WeaveGetPatient($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find all patients named Smith');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('weave');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Weave\Tools\WeaveListPatients::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Weave\WeaveService;

$service = app(WeaveService::class);

// Search patients
$patients = $service->listPatients(query: 'Smith');

// Get a specific patient
$patient = $service->getPatient('patient-123');

// List today's appointments
$appointments = $service->listAppointments(
    startDate: '2025-01-15',
    endDate: '2025-01-15'
);

// List SMS messages
$messages = $service->listMessages(type: 'sms');

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
- A [Weave](https://getweave.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
