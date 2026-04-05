# ServiceNow — Lua API Reference

## list_incidents

List incidents from the ServiceNow incident table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | ServiceNow encoded query string (e.g. `"priority=1^state=2"`) |
| `limit` | integer | no | Maximum number of incidents to return (default: 20) |

### Query Syntax

Use `^` to separate conditions. Common operators:

- `=` equals
- `!=` not equals
- `LIKE` contains
- `STARTSWITH` starts with
- `^OR` or-condition
- `^NQ` new query (AND group)

### Examples

```lua
-- List all open incidents
local result = app.integrations.servicenow.list_incidents({
  query = "active=true"
})

-- High-priority incidents
local result = app.integrations.servicenow.list_incidents({
  query = "priority=1^ORpriority=2",
  limit = 50
})
```

---

## get_incident

Retrieve a single ServiceNow incident by its sys_id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The sys_id of the incident |

### Example

```lua
local result = app.integrations.servicenow.get_incident({
  id = "a9e4e1e14f3c41200bae4b8d0210c7d3"
})
```

---

## create_incident

Create a new ServiceNow incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `short_description` | string | yes | Brief summary of the incident |
| `description` | string | no | Detailed description |
| `priority` | string | no | `"1"` (critical), `"2"` (high), `"3"` (moderate), `"4"` (low), `"5"` (planning) |

### Example

```lua
local result = app.integrations.servicenow.create_incident({
  short_description = "Email server not responding",
  description = "The mail server at mail.example.com has been unreachable since 09:00 UTC.",
  priority = "1"
})
print("Created incident: " .. result.result.number)
```

---

## update_incident

Update an existing ServiceNow incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The sys_id of the incident |
| `fields` | object | yes | Field names and their new values |

### Common Fields

| Field | Description |
|-------|-------------|
| `state` | Incident state: `1` (new), `2` (in progress), `3` (on hold), `6` (resolved), `7` (closed) |
| `priority` | Priority 1–5 |
| `short_description` | Updated summary |
| `description` | Updated description |
| `work_notes` | Internal work notes |
| `comments` | Additional comments |
| `assigned_to` | sys_id of the assignee |

### Example

```lua
local result = app.integrations.servicenow.update_incident({
  id = "a9e4e1e14f3c41200bae4b8d0210c7d3",
  fields = {
    state = "6",
    work_notes = "Root cause identified: DNS misconfiguration. Fix applied."
  }
})
```

---

## list_tasks

List tasks from the ServiceNow task table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | ServiceNow encoded query string |
| `limit` | integer | no | Maximum number of tasks to return (default: 20) |

### Example

```lua
local result = app.integrations.servicenow.list_tasks({
  query = "active=true^assigned_to=javascript:gs.getUserID()",
  limit = 10
})
```

---

## get_task

Retrieve a single ServiceNow task by its sys_id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The sys_id of the task |

### Example

```lua
local result = app.integrations.servicenow.get_task({
  id = "b5e2f1e14f3c41200bae4b8d0210c8e4"
})
```

---

## create_task

Create a new ServiceNow task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `short_description` | string | yes | Brief summary of the task |
| `description` | string | no | Detailed description |
| `assigned_to` | string | no | sys_id of the user to assign |
| `priority` | string | no | Priority `"1"` through `"5"` |

### Example

```lua
local result = app.integrations.servicenow.create_task({
  short_description = "Provision new laptop for onboarding employee",
  description = "Order and configure a MacBook Pro for Jane Smith, starting March 1.",
  priority = "3"
})
```

---

## list_users

List users from the ServiceNow sys_user table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | ServiceNow encoded query string |
| `limit` | integer | no | Maximum number of users to return (default: 20) |

### Example

```lua
-- Find active users in the IT department
local result = app.integrations.servicenow.list_users({
  query = "active=true^department=IT",
  limit = 50
})

for _, user in ipairs(result.result) do
  print(user.name .. " - " .. user.email)
end
```

---

## get_user

Retrieve a single ServiceNow user by their sys_id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The sys_id of the user |

### Example

```lua
local result = app.integrations.servicenow.get_user({
  id = "6816f79cc0a8016401c5a33be04be441"
})
print(result.result.name)
```

---

## get_current_user

Get the profile of the currently authenticated ServiceNow user. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.servicenow.get_current_user()
print("Logged in as: " .. result.result.name)
```

---

## Multi-Account Usage

If you have multiple ServiceNow instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.servicenow.list_incidents({})

-- Explicit default (portable across setups)
app.integrations.servicenow.default.list_incidents({})

-- Named accounts (e.g. production vs. development)
app.integrations.servicenow.production.list_incidents({})
app.integrations.servicenow.development.list_incidents({})
```

All functions are identical across accounts — only the credentials and instance differ.
