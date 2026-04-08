# Integration: Mindee

> Mindee document OCR integration for the [Laravel AI SDK](https://github.com/laravel/ai) — parse invoices, receipts, passports, and custom documents. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to extract structured data from documents using OCR. Parse invoices, expense receipts, passports, and custom document types — all through the [Mindee](https://mindee.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mindee tool lets AI agents parse and extract structured data from uploaded documents — giving agents document intelligence capabilities for invoices, receipts, passports, and custom document types.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mindee
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Mindee API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mindee' => [
        'api_key' => env('MINDEE_API_KEY'),
        'url'     => env('MINDEE_URL', 'https://api.mindee.net/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mindee_parse_invoice` | write | Extract structured data from invoices — supplier, line items, totals, dates, tax |
| `mindee_parse_receipt` | write | Extract structured data from expense receipts — merchant, items, totals, category |
| `mindee_parse_passport` | write | Extract structured data from passports — name, DOB, nationality, number, expiry |
| `mindee_parse_custom` | write | Parse documents using a custom Mindee endpoint (your own trained model) |
| `mindee_get_current_user` | read | Get the current authenticated user's account information |

## Quick Start

```php
use OpenCompany\Integrations\Mindee\MindeeService;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseInvoice;

// Create tools
$service = app(MindeeService::class);
$tools = [
    new MindeeParseInvoice($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Parse this invoice and tell me the total amount');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mindee');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mindee\Tools\MindeeParseInvoice::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mindee\MindeeService;

$service = app(MindeeService::class);

// Parse an invoice (from file path)
$result = $service->parseInvoice('/path/to/invoice.pdf');

// Parse a receipt (from base64)
$result = $service->parseReceipt(base64_encode($fileContent), 'receipt.jpg');

// Parse a passport
$result = $service->parsePassport('/path/to/passport.jpg');

// Parse a custom document
$result = $service->parseCustom('username/endpoint_name/v1', '/path/to/document.pdf');

// Get current user
$user = $service->getCurrentUser();
```

## Document Input

All parsing tools accept either:

1. **File path** — a local file path that the server can read (e.g., `/tmp/uploaded_invoice.pdf`)
2. **Base64 string** — a base64-encoded representation of the file content

When using base64, you can optionally specify a `file_name` to help the API identify the file type.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Mindee](https://mindee.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
