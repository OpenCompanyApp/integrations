# Kimai — Lua API Reference

## list_timesheets

List time-tracking entries with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `size` | integer | no | Number of results per page (default: 50) |
| `user` | string | no | Filter by user ID or username |
| `project` | integer | no | Filter by project ID |
| `begin` | string | no | Filter start date (ISO 8601, e.g., `"2025-01-01T00:00:00"`) |
| `end` | string | no | Filter end date (ISO 8601, e.g., `"2025-01-31T23:59:59"`) |
| `state` | string | no | Filter by state: `"running"` or `"stopped"` |

### Examples

```lua
-- List recent timesheets
local result = app.integrations.kimai.list_timesheets({
  size = 10
})

for _, entry in ipairs(result) do
  print(entry.id .. ": " .. entry.description)
end

-- Filter by project and date range
local result = app.integrations.kimai.list_timesheets({
  project = 5,
  begin = "2025-01-01T00:00:00",
  end = "2025-01-31T23:59:59"
})
```

---

## get_timesheet

Get details of a specific timesheet entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The timesheet entry ID |

### Example

```lua
local result = app.integrations.kimai.get_timesheet({ id = 42 })
print("Duration: " .. result.duration .. " seconds")
```

---

## create_timesheet

Create a new time-tracking entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `begin` | string | yes | Start time (ISO 8601, e.g., `"2025-01-15T09:00:00"`) |
| `end` | string | no | End time (ISO 8601). Omit to start a running timer. |
| `project` | integer | yes | Project ID to associate |
| `activity` | integer | no | Activity ID to categorize the entry |
| `description` | string | no | Description of the work performed |

### Examples

```lua
-- Create a completed time entry
local result = app.integrations.kimai.create_timesheet({
  begin = "2025-01-15T09:00:00",
  end = "2025-01-15T17:00:00",
  project = 3,
  activity = 7,
  description = "Implementing login feature"
})

-- Start a running timer
local result = app.integrations.kimai.create_timesheet({
  begin = "2025-01-15T09:00:00",
  project = 3
})
```

---

## list_projects

List projects with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `size` | integer | no | Results per page (default: 50) |
| `customer` | integer | no | Filter by customer ID |
| `visible` | integer | no | Visibility: 1 = visible, 2 = hidden, 3 = all |

### Example

```lua
local result = app.integrations.kimai.list_projects({
  customer = 2,
  visible = 1
})
```

---

## get_project

Get details of a specific project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```lua
local result = app.integrations.kimai.get_project({ id = 5 })
print("Project: " .. result.name .. " (Customer: " .. result.customer.name .. ")")
```

---

## list_customers

List customers with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `size` | integer | no | Results per page (default: 50) |
| `visible` | integer | no | Visibility: 1 = visible, 2 = hidden, 3 = all |

### Example

```lua
local result = app.integrations.kimai.list_customers({ visible = 1 })
for _, customer in ipairs(result) do
  print(customer.id .. ": " .. customer.name)
end
```

---

## get_current_user

Get the currently authenticated user profile. Takes no parameters.

### Example

```lua
local result = app.integrations.kimai.get_current_user({})
print("Logged in as: " .. result.displayName)
```

---

## Multi-Account Usage

If you have multiple Kimai accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.kimai.function_name({...})

-- Explicit default (portable across setups)
app.integrations.kimai.default.function_name({...})

-- Named accounts
app.integrations.kimai.work.function_name({...})
app.integrations.kimai.freelance.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
