# Tally Forms Integration

[Tally](https://tally.so) is an online form builder. This integration provides tools for listing forms, retrieving submissions, managing workspaces, and viewing user profile data.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `tally_list_forms` | read | List all Tally forms with pagination |
| `tally_get_form` | read | Get details of a specific form by ID |
| `tally_list_submissions` | read | List submissions for a form with pagination |
| `tally_get_submission` | read | Get a single submission by ID |
| `tally_list_workspaces` | read | List all accessible workspaces |
| `tally_get_current_user` | read | Get authenticated user profile |

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Tally API access token |
| `url` | url | no | API base URL (default: `https://api.tally.so`) |

### Getting Your Access Token

1. Log in to your Tally account
2. Go to **Settings → Integrations**
3. Generate a new access token
4. Paste it into the integration configuration

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
