# Integration: Vero

Vero email marketing integration for OpenCompany agents. It wraps the Vero Track REST API for user identity, events, tags, subscription state, deletion, and controlled generic API calls.

## Configuration

This integration requires a Vero Track API auth token.

```php
return [
    'vero' => [
        'auth_token' => env('VERO_AUTH_TOKEN'),
        'url' => env('VERO_URL', 'https://api.getvero.com/api/v2'),
    ],
];
```

Vero authenticates requests with an `auth_token` query parameter. The service adds it automatically; tools never require agents to pass credentials.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vero_get_current_user` | read | Return local configuration status. Vero Track API has no current-user endpoint. |
| `vero_identify_user` | write | Create or update a user with email, attributes, and optional channels via `/users/track`. |
| `vero_update_user` | write | Compatibility update tool backed by the identify endpoint. |
| `vero_alias_user` | write | Change a user identifier via `/users/reidentify`. |
| `vero_unsubscribe` | write | Globally unsubscribe a user. |
| `vero_resubscribe` | write | Globally resubscribe a user. |
| `vero_delete_user` | write | Permanently delete a user and activity. |
| `vero_edit_tags` | write | Add and remove tags on a user profile. |
| `vero_track_event` | write | Track an event with identity, data, and extras via `/events/track`. |
| `vero_api_get` | read | Call a documented relative GET path. |
| `vero_api_post` | write | Call a documented relative POST path. |
| `vero_api_put` | write | Call a documented relative PUT path. |
| `vero_api_delete` | write | Call a documented relative DELETE path. |

## Notes

- Identify and profile update both use Vero's official `POST /users/track` endpoint.
- Event tracking uses `POST /events/track` and accepts an identity object with `id` and/or `email`.
- Generic API tools accept only relative paths and reject absolute URLs.
- `testConnection()` validates credential presence only. Vero Track API access is verified when a write tool sends data.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Vero account with Track API access

## License

MIT. See [LICENSE](LICENSE).
