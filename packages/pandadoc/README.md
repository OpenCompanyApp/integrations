# Integration: PandaDoc

> PandaDoc integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage documents, templates, and e-signatures. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to document management and e-signatures. Create documents from templates, send them for signature, download PDFs, and generate sharing links — all through the [PandaDoc](https://pandadoc.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This PandaDoc tool lets AI agents create, send, and manage documents and e-signatures — enabling automated contract workflows, proposal generation, and document tracking.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pandadoc
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a PandaDoc OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pandadoc' => [
        'access_token' => env('PANDADOC_ACCESS_TOKEN'),
        'url'          => env('PANDADOC_URL', 'https://api.pandadoc.com/public/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pandadoc_list_documents` | read | List documents with pagination |
| `pandadoc_get_document` | read | Get document details by ID |
| `pandadoc_create_document` | write | Create a document from a template |
| `pandadoc_send_document` | write | Send a document for signature |
| `pandadoc_list_templates` | read | List available templates |
| `pandadoc_get_template` | read | Get template details by ID |
| `pandadoc_download_document` | read | Download a document as PDF (base64) |
| `pandadoc_create_link` | write | Create a signed sharing link for a document |
| `pandadoc_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocListDocuments;
use OpenCompany\Integrations\PandaDoc\Tools\PandaDocCreateDocument;

// Create tools
$service = app(PandaDocService::class);
$tools = [
    new PandaDocListDocuments($service),
    new PandaDocCreateDocument($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all PandaDoc documents created this week');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pandadoc');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\PandaDoc\Tools\PandaDocListDocuments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\PandaDoc\PandaDocService;

$service = app(PandaDocService::class);

// List documents
$documents = $service->listDocuments(page: 1, count: 20);

// Get a specific document
$document = $service->getDocument('doc-uuid-here');

// Create a document from a template
$doc = $service->createDocument('NDA - Acme Corp', 'template-uuid', [
    'recipients' => [
        ['email' => 'john@example.com', 'first_name' => 'John', 'role' => 'Signer'],
    ],
    'tokens' => [
        ['name' => 'Company Name', 'value' => 'Acme Corp'],
    ],
]);

// Send for signature
$service->sendDocument($doc['id'], ['message' => 'Please sign at your convenience.']);

// Create a sharing link
$link = $service->createLink($doc['id'], lifetime: 7200);

// Download as PDF
$pdf = $service->downloadDocument($doc['id']);

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
- A [PandaDoc](https://pandadoc.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
