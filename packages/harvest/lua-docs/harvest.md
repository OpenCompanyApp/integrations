# Client for the Harvest REST API v2 — Lua API Reference

## harvest_create_time_entry

Create a new Harvest time entry for a project and task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | Project ID to log time against. |
| `task_id` | integer | yes | Task ID to associate with the entry. |
| `spent_date` | string | yes | Date the time was spent (YYYY-MM-DD). |
| `hours` | number | no | Number of hours logged (e.g. 1.5). |
| `notes` | string | no | Notes describing the time entry. |
| `timer_started_at` | string | no | ISO 8601 timestamp when the timer was started. |

### Example

```lua
local result = app.integrations.harvest.harvest_create_time_entry({
  project_id = 0
  task_id = 0
  spent_date = ""
})
```

## harvest_delete_time_entry

Delete a Harvest time entry by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID to delete. |

### Example

```lua
local result = app.integrations.harvest.harvest_delete_time_entry({
  id = 0
})
```

## harvest_get_current_user

Get the currently authenticated Harvest user profile..

### Example

```lua
local result = app.integrations.harvest.harvest_get_current_user({
})
```

## harvest_get_project

Get a single Harvest project by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID. |

### Example

```lua
local result = app.integrations.harvest.harvest_get_project({
  id = 0
})
```

## harvest_get_time_entry

Get a single Harvest time entry by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID. |

### Example

```lua
local result = app.integrations.harvest.harvest_get_time_entry({
  id = 0
})
```

## harvest_get_user

Get a single Harvest user by their ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The user ID. |

### Example

```lua
local result = app.integrations.harvest.harvest_get_user({
  id = 0
})
```

## harvest_list_clients

List Harvest clients with optional active status filter..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `is_active` | boolean | no | Filter to active clients only. |
| `page` | integer | no | Page number (default: 1). |

### Example

```lua
local result = app.integrations.harvest.harvest_list_clients({
  is_active = true
  page = 0
})
```

## harvest_list_projects

List Harvest projects with optional filters for client and active status..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | integer | no | Filter by client ID. |
| `is_active` | boolean | no | Filter to active projects only. |
| `page` | integer | no | Page number (default: 1). |
| `per_page` | integer | no | Results per page (default: 100). |

### Example

```lua
local result = app.integrations.harvest.harvest_list_projects({
  client_id = 0
  is_active = true
  page = 0
})
```

## harvest_list_tasks

List Harvest tasks with optional active status filter..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `is_active` | boolean | no | Filter to active tasks only. |
| `page` | integer | no | Page number (default: 1). |

### Example

```lua
local result = app.integrations.harvest.harvest_list_tasks({
  is_active = true
  page = 0
})
```

## harvest_list_time_entries

List Harvest time entries with optional filters for user, client, project, and date range..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | integer | no | Filter by user ID. |
| `client_id` | integer | no | Filter by client ID. |
| `project_id` | integer | no | Filter by project ID. |
| `is_billed` | boolean | no | Filter by billed status (true/false). |
| `is_running` | boolean | no | Filter to only running timers. |
| `from` | string | no | Start date filter (YYYY-MM-DD). |
| `to` | string | no | End date filter (YYYY-MM-DD). |
| `page` | integer | no | Page number (default: 1). |
| `per_page` | integer | no | Results per page (default: 100, max: 2000). |

### Example

```lua
local result = app.integrations.harvest.harvest_list_time_entries({
  user_id = 0
  client_id = 0
  project_id = 0
})
```

## harvest_list_users

List Harvest users with optional active status filter..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `is_active` | boolean | no | Filter to active users only. |
| `page` | integer | no | Page number (default: 1). |
| `per_page` | integer | no | Results per page (default: 100). |

### Example

```lua
local result = app.integrations.harvest.harvest_list_users({
  is_active = true
  page = 0
  per_page = 0
})
```

## harvest_update_time_entry

Update an existing Harvest time entry (hours, notes, or spent_date)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID to update. |
| `hours` | number | no | Updated number of hours (e.g. 2.5). |
| `notes` | string | no | Updated notes for the time entry. |
| `spent_date` | string | no | Updated spent date (YYYY-MM-DD). |

### Example

```lua
local result = app.integrations.harvest.harvest_update_time_entry({
  id = 0
  hours = 0
  notes = ""
})
```
