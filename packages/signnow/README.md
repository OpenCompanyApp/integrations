# Integration: SignNow

> SignNow integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage documents, templates, and signing invites. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to electronic signature workflows. Upload documents, list templates, and send signing invitations — all through the [SignNow](https://www.signnow.com) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This SignNow tool lets AI agents manage document signing workflows — uploading contracts, sending invites, and tracking document status — enabling fully automated e-signature processes.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-signnow
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a SignNow OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'signnow' => [
        'access_token' => env('SIGNNOW_ACCESS_TOKEN'),
        'url'          => env('SIGNNOW_URL', 'https://api.signnow.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `signnow_list_documents` | read | List documents accessible to the authenticated user |
| `signnow_get_document` | read | Get full details for a specific document |
| `signnow_create_document` | write | Upload a PDF file to create a new document |
| `signnow_list_templates` | read | List available document templates |
| `signnow_send_invite` | write | Send a signing invitation for a document |
| `signnow_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\Integrations\SignNow\Tools\SignNowListDocuments;
use OpenCompany\Integrations\SignNow\Tools\SignNowSendInvite;

// Create tools
$service = app(SignNowService::class);
$tools = [
    new SignNowListDocuments($service),
    new SignNowSendInvite($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent documents and send the NDA to john@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('signnow');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\SignNow\Tools\SignNowSendInvite::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\SignNow\SignNowService;

$service = app(SignNowService::class);

// List documents
$documents = $service->listDocuments(page: 1, perPage: 20);

// Get a specific document
$document = $service->getDocument('document-id-here');

// Upload a new document
$newDoc = $service->createDocument('/path/to/contract.pdf', 'Contract.pdf');

// List templates
$templates = $service->listTemplates();

// Send a signing invite
$invite = $service->sendInvite(
    documentId: 'document-id-here',
    to: 'client@example.com',
    from: 'me@company.com',
    subject: 'Please sign the contract',
);

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
- A [SignNow](https://www.signnow.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
