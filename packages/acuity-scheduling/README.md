# Integration: Acuity Scheduling

> Acuity Scheduling integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage appointments, clients, calendars, and availability. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to online appointment scheduling. List and manage appointments, search clients, check calendar availability, and cancel bookings — all through the [Acuity Scheduling](https://acuityscheduling.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Acuity Scheduling tool lets AI agents view appointments, check availability, manage clients, and handle cancellations — giving agents full scheduling awareness and control.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-acuity-scheduling
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Acuity Scheduling access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'acuity-scheduling' => [
        'access_token' => env('ACUITY_ACCESS_TOKEN'),
        'url'          => env('ACUITY_URL', 'https://acuityscheduling.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `acuity_list_appointments` | read | List upcoming and past appointments with filters |
| `acuity_get_appointment` | read | Get full details of a specific appointment |
| `acuity_list_clients` | read | List and search clients |
| `acuity_list_calendars` | read | List all calendars |
| `acuity_list_appointment_types` | read | List all appointment types / services |
| `acuity_cancel_appointment` | write | Cancel an existing appointment |
| `acuity_get_availability` | read | Get available time slots for booking |
| `acuity_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointments;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityGetAvailability;

// Create tools
$service = app(AcuitySchedulingService::class);
$tools = [
    new AcuityListAppointments($service),
    new AcuityGetAvailability($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What appointments do I have this week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('acuity-scheduling');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\AcuityScheduling\Tools\AcuityListAppointments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;

$service = app(AcuitySchedulingService::class);

// List appointments
$appointments = $service->listAppointments([
    'minDate' => '2026-04-01',
    'maxDate' => '2026-04-30',
]);

// Get a specific appointment
$appointment = $service->getAppointment(12345);

// List clients
$clients = $service->listClients(['search' => 'john']);

// List calendars
$calendars = $service->listCalendars();

// List appointment types
$types = $service->listAppointmentTypes();

// Check availability
$slots = $service->getAvailability([
    'appointmentTypeID' => 1,
    'date' => '2026-04-10',
]);

// Cancel an appointment
$service->cancelAppointment(12345);

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
- An [Acuity Scheduling](https://acuityscheduling.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
