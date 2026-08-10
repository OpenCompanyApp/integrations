# Integration: APITemplate.io

APITemplate.io integration for OpenCompany and KosmoKrator agents. It exposes the REST API v2 surface for generating PDFs and images, managing generated objects, querying account information, and working with templates.

## Installation

```console
composer require opencompanyapp/integration-apitemplateio
```

Laravel auto-discovers the service provider.

## Configuration

Credentials are normally configured through the host integration settings UI.

```php
return [
    'apitemplateio' => [
        'api_key' => env('APITEMPLATEIO_API_KEY'),
        'url' => env('APITEMPLATEIO_URL', 'https://rest.apitemplate.io'),
    ],
];
```

Use a regional base URL when needed, for example `https://rest-us.apitemplate.io`, `https://rest-de.apitemplate.io`, or `https://rest-au.apitemplate.io`.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `apitemplateio_create_pdf` | write | Generate a PDF from a saved template |
| `apitemplateio_create_image` | write | Generate images from a visual template |
| `apitemplateio_create_pdf_from_html` | write | Generate a PDF directly from HTML |
| `apitemplateio_create_pdf_from_url` | write | Generate a PDF by rendering a URL |
| `apitemplateio_create_pdf_from_markdown` | write | Generate a PDF from Markdown |
| `apitemplateio_merge_pdfs` | write | Merge multiple PDF URLs into one PDF |
| `apitemplateio_list_objects` | read | List generated PDFs and images |
| `apitemplateio_delete_object` | write | Delete a generated object by transaction reference |
| `apitemplateio_get_current_user` | read | Get account information for the configured API key |
| `apitemplateio_list_templates` | read | List templates with documented filters |
| `apitemplateio_get_template` | read | Get a PDF template by ID |
| `apitemplateio_update_template` | write | Update a PDF template |

## Service Usage

```php
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

$service = app(ApiTemplateIOService::class);

$pdf = $service->createPdf('tpl_invoice', [
    'invoice_number' => 'INV-001',
    'amount' => '$500.00',
], [
    'filename' => 'invoice-INV-001.pdf',
]);

$image = $service->createImage('tpl_social', [
    'overrides' => [
        ['name' => 'title', 'text' => 'Launch Week'],
    ],
], [
    'output_image_type' => 'pngOnly',
]);

$htmlPdf = $service->createPdfFromHtml(
    '<h1>Hello {{name}}</h1>',
    '<style>h1 { color: #2563eb; }</style>',
    ['name' => 'World'],
);

$merged = $service->mergePdfs([
    'https://example.test/a.pdf',
    'https://example.test/b.pdf',
]);
```

## Notes

- `get_current_user` keeps the historical tool slug but uses APITemplate.io's current `/v2/account-information` endpoint.
- `get_template` and `update_template` are marked experimental by APITemplate.io.
- JavaScript docs live in `script-docs/apitemplateio.md` and describe normalized agent usage.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- APITemplate.io API key
