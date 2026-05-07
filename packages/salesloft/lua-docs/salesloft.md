# Salesloft Lua API Reference

Namespace: `app.integrations.salesloft`

Use this integration for Salesloft people, accounts, cadences, cadence
memberships, tasks, calls, emails, notes, users, current-user checks, and generic
relative API calls. Responses are parsed Salesloft JSON, usually with `data` and
`metadata` keys.

## People And Accounts

| Function | Purpose |
|----------|---------|
| `list_people({ page?, per_page?, email_address?, account_id? })` | List people. |
| `get_person({ id })` | Get one person. |
| `create_person({ payload })` | Create a person with an official payload. |
| `update_person({ id, payload })` | Update a person. |
| `delete_person({ id })` | Delete a person. |
| `list_accounts({ page?, per_page?, domain? })` | List accounts. |
| `get_account({ id })` | Get one account. |
| `create_account({ payload })` | Create an account. |
| `update_account({ id, payload })` | Update an account. |
| `delete_account({ id })` | Delete an account. |

Use `payload` for official Salesloft request bodies so the package does not hide
new fields added by the API.

## Cadences And Tasks

| Function | Purpose |
|----------|---------|
| `list_cadences({ page?, per_page?, owned_by_user_id? })` | List cadences. |
| `get_cadence({ id })` | Get one cadence. |
| `list_cadence_memberships({ page?, per_page?, cadence_id?, person_id? })` | List cadence memberships. |
| `create_cadence_membership({ payload })` | Add a person to a cadence. |
| `list_tasks({ page?, per_page?, user_id?, person_id?, due_on? })` | List tasks. |
| `get_task({ id })` | Get one task. |
| `update_task({ id, payload })` | Update a task. |

## Activities

| Function | Purpose |
|----------|---------|
| `list_calls({ page?, per_page?, person_id?, user_id? })` | List call activities. |
| `create_call({ payload })` | Create a call activity. |
| `list_emails({ page?, per_page?, person_id?, user_id? })` | List email activities. |
| `list_notes({ page?, per_page?, person_id?, account_id? })` | List notes. |
| `create_note({ payload })` | Create a note. |

## Users And Legacy Wrappers

| Function | Purpose |
|----------|---------|
| `list_users({ page?, per_page?, email? })` | List Salesloft users. |
| `get_user({ id })` | Get one Salesloft user. |
| `get_current_user({})` | Fetch `/v3/users/me` to identify the token owner. |
| `list_sequences({ limit?, page?, status? })` | Legacy compatibility wrapper for `/v3/call-sequences`. |
| `get_sequence({ id })` | Legacy compatibility wrapper for one call sequence. |
| `create_sequence({ name, steps?, owner_id?, status?, targets? })` | Legacy compatibility wrapper to create a call sequence. |
| `list_rules({ limit?, page? })` | Legacy compatibility wrapper for `/v3/rules`. |
| `get_rule({ id })` | Legacy compatibility wrapper for one rule. |

Prefer cadences and cadence memberships for current Salesloft workflow work.

## Generic API Helpers

| Function | Purpose |
|----------|---------|
| `api_get({ path, params? })` | Send GET to a relative Salesloft API path. |
| `api_post({ path, payload? })` | Send POST to a relative Salesloft API path. |
| `api_put({ path, payload? })` | Send PUT to a relative Salesloft API path. |
| `api_delete({ path, payload? })` | Send DELETE to a relative Salesloft API path. |

Generic helpers reject absolute URLs. Use paths such as `/v2/people`,
`/v2/tasks/123`, or `/v2/activities/calls` so the host controls the API base URL
and credentials.

## Multi-Account Usage

All functions work under account-specific namespaces:

```lua
app.integrations.salesloft.list_people({ per_page = 25 })
app.integrations.salesloft.default.list_people({})
app.integrations.salesloft.production.list_people({})
```
