# Tally Integration

[Tally](https://tally.so) is an online form and survey platform. This package wraps Tally's documented REST API for agents that need to manage forms, submissions, workspaces, organization invites, and webhooks.

## Coverage

The integration uses `https://api.tally.so` with bearer-token authentication and sends the `tally-version` header. Named tools cover:

- user profile: `tally_get_current_user`
- forms: list, create, get, update, delete
- form structure: list questions, update question title, list blocks, replace blocks
- submissions: list, get, delete using the current form-scoped submission endpoints
- workspaces: list, create, get, update, delete
- organizations: list/remove users, list/create/cancel invites
- webhooks: list, create, update, delete, list events, retry event
- generic documented endpoint helpers: `tally_api_get`, `tally_api_post`, `tally_api_patch`, `tally_api_delete`

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Tally API access token |
| `url` | url | no | API base URL, default `https://api.tally.so` |
| `api_version` | text | no | Tally API version header, default `2026-02-05` |

## Notes

- Tool parameters use `snake_case`; the service maps them to Tally's camelCase API fields where needed.
- Delete operations are exposed as write tools because they permanently remove or trash Tally resources.
- Use the generic API tools only for documented Tally endpoints that do not yet have a named tool.

## Installation

```json
{
    "require": {
        "opencompanyapp/integration-tally": "@dev"
    }
}
```

## License

MIT
