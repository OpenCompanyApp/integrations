# Integration: API Template IO

> API Template IO integration for the [Laravel AI SDK](https://github.com/laravel/ai) — generate PDFs and images from reusable templates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to generate professional PDFs and images from templates. Create invoices, certificates, social media images, and more — all through the [API Template IO](https://apitemplate.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This API Template IO tool lets AI agents generate documents and images on demand — from invoices and reports to social media graphics and certificates.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-apitemplateio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an API Template IO API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'apitemplateio' => [
        'api_key' => env('APITEMPLATEIO_API_KEY'),
        'url'     => env('APITEMPLATEIO_URL', 'https://api.apitemplate.io/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `apitemplateio_create_pdf` | write | Generate a PDF document from a template |
| `apitemplateio_create_image` | write | Generate an image (PNG or JPEG) from a template |
| `apitemplateio_list_templates` | read | List available templates with pagination |
| `apitemplateio_get_template` | read | Get details for a specific template |
| `apitemplateio_get_current_user` | read | Get the authenticated user's account information |

## Quick Start

```php
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdf;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreateImage;

// Create tools
$service = app(ApiTemplateIOService::class);
$tools = [
    new ApiTemplateIOCreatePdf($service),
    new ApiTemplateIOCreateImage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Generate a PDF invoice for $500 using template tpl_abc123');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('apitemplateio');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdf::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

$service = app(ApiTemplateIOService::class);

// Generate a PDF
$pdf = $service->createPdf('tpl_abc123', [
    'company_name' => 'Acme Corp',
    'amount' => '$500.00',
    'invoice_number' => 'INV-001',
]);

// Generate a PNG image
$image = $service->createImage('tpl_xyz789', [
    'title' => 'Summer Sale',
    'discount' => '30%',
], 'png');

// List templates
$templates = $service->listTemplates(50, 0);

// Get a specific template
$template = $service->getTemplate('tpl_abc123');

// Get account info
$account = $service->getCurrentUser();
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
- An [API Template IO](https://apitemplate.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
