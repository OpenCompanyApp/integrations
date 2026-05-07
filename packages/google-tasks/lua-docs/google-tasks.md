# Google Tasks

Google Tasks tools are exposed under `app.integrations.google_tasks`. This package is generated from Google's official Tasks API v1 Discovery document and exposes 14 REST methods.

## Coverage

- Source: `https://www.googleapis.com/discovery/v1/apis/tasks/v1/rest`
- Read tools: 4
- Write tools: 10
- Base URL: `https://tasks.googleapis.com`

## Usage Notes

Pass `tasklist` and `task` path parameters as top-level arguments. Query parameters can be passed as top-level shortcuts or inside `query`. Insert, update, and patch methods accept the official Task or TaskList object inside `body`.

Google Tasks dates are date-only RFC 3339 timestamps in the API; the upstream API does not preserve arbitrary time-of-day values for due dates.

## Tools

- `google_tasks_tasks_update` - PUT /tasks/v1/lists/{tasklist}/tasks/{task}
- `google_tasks_tasks_move` - POST /tasks/v1/lists/{tasklist}/tasks/{task}/move
- `google_tasks_tasks_delete` - DELETE /tasks/v1/lists/{tasklist}/tasks/{task}
- `google_tasks_tasks_clear` - POST /tasks/v1/lists/{tasklist}/clear
- `google_tasks_tasks_get` - GET /tasks/v1/lists/{tasklist}/tasks/{task}
- `google_tasks_tasks_insert` - POST /tasks/v1/lists/{tasklist}/tasks
- `google_tasks_tasks_list` - GET /tasks/v1/lists/{tasklist}/tasks
- `google_tasks_tasks_patch` - PATCH /tasks/v1/lists/{tasklist}/tasks/{task}
- `google_tasks_tasklists_delete` - DELETE /tasks/v1/users/@me/lists/{tasklist}
- `google_tasks_tasklists_get` - GET /tasks/v1/users/@me/lists/{tasklist}
- `google_tasks_tasklists_insert` - POST /tasks/v1/users/@me/lists
- `google_tasks_tasklists_list` - GET /tasks/v1/users/@me/lists
- `google_tasks_tasklists_patch` - PATCH /tasks/v1/users/@me/lists/{tasklist}
- `google_tasks_tasklists_update` - PUT /tasks/v1/users/@me/lists/{tasklist}

## Examples

```lua
local lists = app.integrations.google_tasks.google_tasks_tasklists_list({ maxResults = 10 })

local task = app.integrations.google_tasks.google_tasks_tasks_insert({
  tasklist = "MDM4NzA1...",
  body = { title = "Follow up", notes = "Send recap email" }
})
```

Responses are decoded Google Tasks JSON responses, or `{ success = true, status = ... }` for successful empty responses such as deletes and clears.
