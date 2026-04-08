# Integration: Google Docs

> Google Docs integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage documents, permissions, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Docs. List and read documents, create new ones, apply batch updates, and manage sharing permissions — all through the [Google Docs API](https://developers.google.com/docs/api) and [Drive API](https://developers.google.com/drive/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Docs tool lets AI agents create documents, read and analyze document content, insert text and apply formatting, and manage sharing settings — enabling document-aware automation workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-docs
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth2 access token with appropriate scopes.

**Required scopes:**
- `https://www.googleapis.com/auth/documents` — read and write Google Docs
- `https://www.googleapis.com/auth/drive.readonly` — list documents and read permissions

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-docs' => [
        'access_token' => env('GOOGLE_DOCS_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_DOCS_URL', 'https://docs.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gdocs_list_documents` | read | List Google Docs documents with pagination and query filters |
| `gdocs_get_document` | read | Get full document content and metadata |
| `gdocs_create_document` | write | Create a new Google Docs document |
| `gdocs_batch_update` | write | Send batch update requests (insert text, styling, etc.) |
| `gdocs_list_permissions` | read | List sharing permissions for a document |
| `gdocs_get_permission` | read | Get details of a specific permission |
| `gdocs_get_current_user` | read | Get authenticated user's Google profile info |

## Quick Start

```php
use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsListDocuments;
use OpenCompany\Integrations\GoogleDocs\Tools\GdocsGetDocument;

// Create tools
$service = app(GoogleDocsService::class);
$tools = [
    new GdocsListDocuments($service),
    new GdocsGetDocument($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent Google Docs and summarize the first one.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-docs');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleDocs\Tools\GdocsListDocuments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;

$service = app(GoogleDocsService::class);

// List documents
$docs = $service->listDocuments(50);

// Get a document
$doc = $service->getDocument('1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms');

// Create a document
$newDoc = $service->createDocument('Meeting Notes');

// Batch update — insert text
$service->batchUpdate($newDoc['documentId'], [
    ['insertText' => ['location' => ['endIndex' => 1], 'text' => "Hello, world!\n"]],
]);

// List permissions
$perms = $service->listPermissions('1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms');

// Get current user info
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
- A Google account with OAuth2 access token

## License

MIT — see [LICENSE](LICENSE)
