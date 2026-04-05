# Integration: BambooHR

> BambooHR integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage employees, departments, and time-off requests. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to human resources data. List and search employees, manage employee records, view departments, and track time-off requests — all through the [BambooHR](https://www.bamboohr.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This BambooHR tool lets AI agents query employee directories, manage personnel records, and check time-off requests — giving agents HR awareness for workplace coordination.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-bamboohr
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a BambooHR API key and your company subdomain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'bamboohr' => [
        'api_key'   => env('BAMBOOHR_API_KEY'),
        'subdomain' => env('BAMBOOHR_SUBDOMAIN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `bamboohr_list_employees` | read | List employees from the company directory |
| `bamboohr_get_employee` | read | Get detailed info for a specific employee |
| `bamboohr_create_employee` | write | Create a new employee record |
| `bamboohr_update_employee` | write | Update an existing employee record |
| `bamboohr_list_departments` | read | List all company departments |
| `bamboohr_list_time_off_requests` | read | List time-off requests with optional filters |
| `bamboohr_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListEmployees;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetEmployee;

// Create tools
$service = app(BambooHRService::class);
$tools = [
    new BambooHRListEmployees($service),
    new BambooHRGetEmployee($service),
];
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('bamboohr');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\BambooHR\Tools\BambooHRListEmployees::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\BambooHR\BambooHRService;

$service = app(BambooHRService::class);

// List all employees
$employees = $service->listEmployees();

// Get a specific employee
$employee = $service->getEmployee(42, ['firstName', 'lastName', 'jobTitle', 'workEmail']);

// Create an employee
$service->createEmployee([
    'firstName' => 'Jane',
    'lastName' => 'Doe',
    'workEmail' => 'jane.doe@example.com',
]);

// Update an employee
$service->updateEmployee(42, ['jobTitle' => 'Senior Engineer']);

// List departments
$departments = $service->listDepartments();

// List time-off requests
$requests = $service->listTimeOffRequests(['start' => '2026-04-01', 'end' => '2026-04-30']);

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

BambooHR uses HTTP Basic Authentication. The API key is the username, and the password is `x` (any value). Requests are made to:

```
https://api.bamboohr.com/api/gateway.php/{subdomain}/v1
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
- A [BambooHR](https://www.bamboohr.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
