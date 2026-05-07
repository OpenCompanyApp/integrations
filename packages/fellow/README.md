# Integration: Fellow

Fellow Developer API integration for OpenCompany agents. It wraps the official v1 API for authenticated workspace user data, notes, action items, recordings, webhooks, and controlled generic API calls.

## Configuration

Fellow uses a workspace subdomain and an API key sent in the `X-API-KEY` header.

```php
return [
    'fellow' => [
        'api_key' => env('FELLOW_API_KEY'),
        'subdomain' => env('FELLOW_SUBDOMAIN'),
        'url' => env('FELLOW_URL'), // optional override
    ],
];
```

If `url` is omitted, the integration builds `https://{subdomain}.fellow.app/api/v1`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `fellow_get_current_user` | read | Get the authenticated Fellow user and workspace. |
| `fellow_list_notes` | read | List notes with optional filters, includes, and pagination. |
| `fellow_get_note` | read | Retrieve a note by ID. |
| `fellow_delete_note` | write | Delete a note by ID. Requires privileged API access. |
| `fellow_list_action_items` | read | List action items with optional filters and pagination. |
| `fellow_get_action_item` | read | Retrieve an action item by ID. |
| `fellow_mark_action_item_complete` | write | Mark an action item complete or incomplete. |
| `fellow_archive_action_item` | write | Archive an action item as won't do. |
| `fellow_list_recordings` | read | List recordings with optional filters and pagination. |
| `fellow_get_recording` | read | Retrieve a recording by ID. |
| `fellow_delete_recording` | write | Delete a recording by ID. Requires privileged API access. |
| `fellow_list_webhooks` | read | List configured webhooks. |
| `fellow_create_webhook` | write | Create a webhook endpoint. |
| `fellow_get_webhook` | read | Retrieve a webhook by ID. |
| `fellow_update_webhook` | write | Update a webhook endpoint. |
| `fellow_delete_webhook` | write | Delete a webhook endpoint. |
| `fellow_api_get` | read | Call a documented relative GET path. |
| `fellow_api_post` | write | Call a documented relative POST path. |
| `fellow_api_patch` | write | Call a documented relative PATCH path. |
| `fellow_api_delete` | write | Call a documented relative DELETE path. |

## Notes

- The package targets the official `https://{subdomain}.fellow.app/api/v1` Developer API.
- Older meeting, goal, and create-note wrappers were removed from discovery because they are not documented in the current Developer API reference.
- Generic API tools accept only relative paths and reject absolute URLs.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Fellow workspace with Developer API access

## License

MIT. See [LICENSE](LICENSE).
