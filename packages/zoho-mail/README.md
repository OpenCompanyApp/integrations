# Zoho Mail Integration

Zoho Mail REST API integration for OpenCompany agents. It covers mailbox
accounts, folders, messages, attachments, labels, tasks, sending, replies,
message updates, and safe raw relative API calls.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Zoho OAuth access token with Mail scopes |
| `url` | url | no | Regional Zoho Mail API base URL, default `https://mail.zoho.com/api` |

Use the regional base URL that matches the OAuth account, for example
`https://mail.zoho.eu/api` for EU accounts.

## Tool Areas

| Area | Tools |
|------|-------|
| Accounts | `get_current_user`, `get_account` |
| Messages | `list_messages`, `search_messages`, `get_message`, `get_message_details`, `get_message_headers`, `get_original_message`, `send_message`, `reply_message`, `update_messages`, `delete_message` |
| Attachments | `get_attachment_info`, `get_attachment_content` |
| Folders | `list_folders`, `get_folder`, `create_folder`, `update_folder`, `delete_folder` |
| Labels | `list_labels`, `get_label`, `create_label`, `update_label`, `delete_label` |
| Tasks | `list_tasks` |
| Raw API | `api_get`, `api_post`, `api_put`, `api_delete` |

## Usage

```php
use OpenCompany\Integrations\ZohoMail\ZohoMailService;

$service = app(ZohoMailService::class);

$accounts = $service->listAccounts();
$messages = $service->listMessages('12345678', [
    'folderId' => '987654',
    'limit' => 25,
]);

$content = $service->getMessage('12345678', '987654', '555555');
$service->sendMessage('12345678', [
    'toAddress' => 'recipient@example.test',
    'subject' => 'Status update',
    'content' => '<p>All set.</p>',
]);
```

## Notes

The package sends Zoho OAuth tokens with the official
`Authorization: Zoho-oauthtoken ...` header. Raw helpers reject full URLs and
parent-directory path segments; pass paths relative to the configured `/api`
base URL.

## License

MIT, see [LICENSE](LICENSE).
