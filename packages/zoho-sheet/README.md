# Integration: Zoho Sheet

> Zoho Sheet integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage spreadsheets, worksheets, and rows. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to cloud spreadsheet management. List and browse spreadsheets, explore worksheets, read row data, and create new rows — all through the [Zoho Sheet](https://sheet.zoho.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Sheet tool lets AI agents read and write spreadsheet data, browse workbook structures, and manage row-level data — enabling agents to interact with spreadsheets as part of automated workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-sheet
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zoho OAuth access token with ZohoSheet scope permissions.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho_sheet' => [
        'access_token' => env('ZOHO_SHEET_ACCESS_TOKEN'),
        'url'          => env('ZOHO_SHEET_URL', 'https://sheet.zoho.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zoho_sheet_list_spreadsheets` | read | List all spreadsheets accessible to the authenticated user |
| `zoho_sheet_get_spreadsheet` | read | Get details of a specific spreadsheet |
| `zoho_sheet_list_worksheets` | read | List all worksheets within a spreadsheet |
| `zoho_sheet_get_worksheet` | read | Get details of a specific worksheet |
| `zoho_sheet_list_rows` | read | List rows in a worksheet with pagination |
| `zoho_sheet_create_row` | write | Add a new row of data to a worksheet |
| `zoho_sheet_get_current_user` | read | Get the authenticated user's profile information |

## Quick Start

```php
use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListSpreadsheets;
use OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListRows;

// Create tools
$service = app(ZohoSheetService::class);
$tools = [
    new ZohoSheetListSpreadsheets($service),
    new ZohoSheetListRows($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all spreadsheets and show the first 10 rows of the first worksheet.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zoho_sheet');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoSheet\Tools\ZohoSheetListRows::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;

$service = app(ZohoSheetService::class);

// List spreadsheets
$spreadsheets = $service->listSpreadsheets();

// Get a specific spreadsheet
$spreadsheet = $service->getSpreadsheet('spreadsheet_id');

// List worksheets
$worksheets = $service->listWorksheets('spreadsheet_id');

// Get a specific worksheet
$worksheet = $service->getWorksheet('spreadsheet_id', 'worksheet_id');

// List rows
$rows = $service->listRows('spreadsheet_id', 'worksheet_id', page: 1, perPage: 25);

// Create a row
$newRow = $service->createRow('spreadsheet_id', 'worksheet_id', [
    'Name' => 'John Doe',
    'Email' => 'john@example.com',
    'Status' => 'Active',
]);

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
- A [Zoho](https://www.zoho.com) account with Zoho Sheet access and OAuth credentials

## License

MIT — see [LICENSE](LICENSE)
