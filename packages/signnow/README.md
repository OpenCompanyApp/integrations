# Integration: SignNow

SignNow integration for OpenCompany agent tooling. It exposes SignNow REST API
coverage for documents, document updates, downloads, history, templates,
signing invites, invite cancellation, current-user checks, and generic relative
API helpers.

## Configuration

This package uses a stored SignNow OAuth access token. In OpenCompany and
KosmoKrator, configure credentials through the integration settings UI. For
standalone usage, bind a `CredentialResolver` value for:

```php
[
    'signnow' => [
        'access_token' => env('SIGNNOW_ACCESS_TOKEN'),
        'url' => env('SIGNNOW_API_URL', 'https://api.signnow.com'),
    ],
]
```

Use `https://api.signnow.com` for production and the appropriate SignNow eval
base URL for sandbox accounts.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `signnow_list_documents` | read | List documents |
| `signnow_get_document` | read | Get one document |
| `signnow_create_document` | write | Upload a document |
| `signnow_update_document` | write | Update document fields or metadata |
| `signnow_delete_document` | write | Delete a document |
| `signnow_download_document` | read | Download a document |
| `signnow_get_document_download_link` | read | Get a document download link |
| `signnow_get_document_history` | read | Get document event history |
| `signnow_merge_documents` | write | Merge documents |
| `signnow_list_templates` | read | List templates |
| `signnow_create_template` | write | Create a template from a document |
| `signnow_duplicate_template` | write | Duplicate a template |
| `signnow_delete_template` | write | Delete a template |
| `signnow_send_invite` | write | Send a simple signing invite |
| `signnow_send_freeform_invite` | write | Send a full invite payload |
| `signnow_cancel_field_invite` | write | Cancel field invites for a document |
| `signnow_cancel_freeform_invite` | write | Cancel a free-form invite |
| `signnow_get_current_user` | read | Get authenticated user profile |
| `signnow_api_get` | read | Call a relative API GET endpoint |
| `signnow_api_post` | write | Call a relative API POST endpoint |
| `signnow_api_put` | write | Call a relative API PUT endpoint |
| `signnow_api_delete` | write | Call a relative API DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\SignNow\SignNowService;

$service = app(SignNowService::class);

$documents = $service->listDocuments(page: 1, perPage: 20);
$document = $service->getDocument('doc_123');
$link = $service->getDocumentDownloadLink('doc_123');
$service->sendInvite(
    documentId: 'doc_123',
    to: 'signer@example.test',
    from: 'sender@example.test',
    subject: 'Please sign'
);
$template = $service->duplicateTemplate('template_123', 'Client Contract');
```

## Notes For Agents

Use first-class tools for common document, template, and invite workflows. Use
generic API helpers only for less common SignNow endpoints, passing relative
paths such as `/document`, `/document/{id}/invite`, or `/template/{id}/copy`.
Absolute URLs are rejected so hosts control credentials and base URLs.

## Requirements

- PHP 8.2+
- `opencompanyapp/integration-core`
- A SignNow account with API access

## License

MIT
