# Cursor - Lua API Reference

Namespace: `app.integrations.cursor`

This integration covers the documented Cursor Admin API at `https://api.cursor.com`. Cursor Admin API keys use Basic authentication with the API key as the username and an empty password.

## list_team_members

List all Cursor team members.

```lua
local result = app.integrations.cursor.list_team_members({})

for _, member in ipairs(result.teamMembers or {}) do
  print(member.name .. " (" .. member.email .. ") - " .. member.role)
end
```

## get_daily_usage_data

Get daily usage data. Dates are epoch milliseconds.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | integer | no | Start date as epoch milliseconds. |
| `end_date` | integer | no | End date as epoch milliseconds. |

```lua
local usage = app.integrations.cursor.get_daily_usage_data({
  start_date = 1748411762359,
  end_date = 1751003762359
})
```

## get_spend

Get current calendar month spending data with search, sorting, and pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search_term` | string | no | Search user names and emails. |
| `sort_by` | string | no | `amount`, `date`, or `user`. |
| `sort_direction` | string | no | `asc` or `desc`. |
| `page` | integer | no | 1-indexed page number. |
| `page_size` | integer | no | Results per page. |

```lua
local spend = app.integrations.cursor.get_spend({
  search_term = "developer@example.test",
  page = 1,
  page_size = 25
})
```

## get_usage_events

Get detailed usage events with filters.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | integer | no | Start date as epoch milliseconds. |
| `end_date` | integer | no | End date as epoch milliseconds. |
| `user_id` | integer | no | Cursor user ID. |
| `email` | string | no | Team member email address. |
| `page` | integer | no | 1-indexed page number. |
| `page_size` | integer | no | Results per page. |

## set_user_spend_limit

Set a team member's spend limit in whole dollars.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_email` | string | yes | Team member email address. |
| `spend_limit_dollars` | integer | yes | Whole-dollar spend limit. Use `0` for a zero-dollar limit. |

## list_repo_blocklists

List repository blocklists configured for the team.

```lua
local blocklists = app.integrations.cursor.list_repo_blocklists({})
```

## upsert_repo_blocklists

Replace blocklist patterns for one or more repositories. Only the provided repositories are overwritten.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `repos` | array | yes | Repository objects with `url` and `patterns`. |

```lua
local result = app.integrations.cursor.upsert_repo_blocklists({
  repos = {
    {
      url = "https://github.com/example/sensitive-repo",
      patterns = {"*.env", "config/*", "secrets/**"}
    }
  }
})
```

## delete_repo_blocklist

Delete a repository blocklist entry.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `repo_id` | string | yes | Repository blocklist ID. |

## Multi-Account Usage

If you have multiple Cursor accounts configured, use account-specific namespaces:

```lua
app.integrations.cursor.list_team_members({})
app.integrations.cursor.default.list_team_members({})
app.integrations.cursor.work.list_team_members({})
```

All functions are identical across accounts; only credentials differ.
