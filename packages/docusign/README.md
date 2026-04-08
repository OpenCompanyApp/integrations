# Integration: DocuSign

> DocuSign integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage envelopes, templates, and documents. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to electronic signature workflows. List and create envelopes, browse templates, and download signed documents — all through the [DocuSign eSignature REST API](https://developers.docusign.com/docs/esign-rest-api/reference/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This DocuSign tool lets AI agents manage signing workflows — creating envelopes from templates, tracking signature status, and retrieving signed documents.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-docusign
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a DocuSign OAuth2 access token, account ID, and API base path.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'docusign' => [
        'access_token' => env('DOCUSIGN_ACCESS_TOKEN'),
        'account_id'   => env('DOCUSIGN_ACCOUNT_ID'),
        'base_path'    => env('DOCUSIGN_BASE_PATH', 'https://demo.docusign.net/restapi'),
    ],
];
```

### Obtaining Credentials

1. **Access Token** — Generate via OAuth2 in the [DocuSign Developer Console](https://admindemo.docusign.com/) (demo) or your production admin panel.
2. **Account ID** — Found in Admin → Plan and Billing, or by calling the `/oauth/userinfo` endpoint.
3. **Base Path** — Varies by region and environment:
   - Demo/Sandbox: `https://demo.docusign.net/restapi`
   - Production (NA3): `https://na3.docusign.net/restapi`
   - Production (EU1): `https://eu.docusign.net/restapi`
   - Check your account's base path in Admin → API and Keys.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `docusign_list_envelopes` | read | List envelopes with filtering by status, date range, and search text |
| `docusign_get_envelope` | read | Get envelope details, recipients, and signing status |
| `docusign_create_envelope` | write | Create and send (or draft) a new envelope |
| `docusign_list_templates` | read | List templates available in the account |
| `docusign_get_template` | read | Get template details including documents and recipient roles |
| `docusign_list_documents` | read | List documents in an envelope |
| `docusign_get_document` | read | Download a document from an envelope (base64-encoded) |
| `docusign_get_current_user` | read | Get authenticated user info and associated accounts |

## Quick Start

```php
use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\Integrations\DocuSign\Tools\DocuSignListEnvelopes;

// Create tools
$service = app(DocuSignService::class);
$tools = [
    new DocuSignListEnvelopes($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all completed envelopes from last month');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('docusign');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\DocuSign\Tools\DocuSignListEnvelopes::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\DocuSign\DocuSignService;

$service = app(DocuSignService::class);

// List recent envelopes
$envelopes = $service->listEnvelopes(['status' => 'completed', 'count' => 10]);

// Get envelope details
$envelope = $service->getEnvelope('envelope-id-here');

// Create from a template
$result = $service->createEnvelope([
    'templateId' => 'template-id',
    'emailSubject' => 'Please sign the NDA',
    'status' => 'sent',
    'templateRoles' => [
        ['roleName' => 'signer', 'name' => 'Jane Doe', 'email' => 'jane@example.com'],
    ],
]);

// List and download documents
$docs = $service->listDocuments('envelope-id');
$pdf = $service->getDocument('envelope-id', 'combined');
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
- A [DocuSign](https://www.docusign.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
