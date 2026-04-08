# Accelo — Lua API Reference

## list_tickets

List support tickets in Accelo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of tickets per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by status (e.g. "open", "closed", "resolved") |

### Examples

```lua
-- List open tickets
local result = app.integrations.accelo.list_tickets({
  status = "open",
  limit = 10
})

for _, ticket in ipairs(result) do
  print(ticket.id .. ": " .. ticket.title)
end
```

```lua
-- Paginate through all tickets
local page1 = app.integrations.accelo.list_tickets({ limit = 50, page = 1 })
local page2 = app.integrations.accelo.list_tickets({ limit = 50, page = 2 })
```

---

## get_ticket

Get details of a specific support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo ticket ID |

### Examples

```lua
local ticket = app.integrations.accelo.get_ticket({ id = 12345 })
print(ticket.title)
print(ticket.body)
print("Status: " .. ticket.status)
```

---

## create_ticket

Create a new support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Ticket title or subject |
| `body` | string | yes | Ticket description |
| `contract_id` | integer | no | Contract ID to associate |
| `priority` | integer | no | Priority level (1–5, where 1 is highest) |

### Examples

```lua
-- Create a basic ticket
local ticket = app.integrations.accelo.create_ticket({
  title = "Login issue",
  body = "User cannot log in to the portal after password reset."
})

print("Created ticket #" .. ticket.id)
```

```lua
-- Create a ticket with contract and priority
local ticket = app.integrations.accelo.create_ticket({
  title = "Feature request",
  body = "Customer requests SSO integration.",
  contract_id = 100,
  priority = 2
})
```

---

## list_tasks

List tasks in Accelo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of tasks per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by status (e.g. "open", "completed", "in_progress") |

### Examples

```lua
-- List in-progress tasks
local tasks = app.integrations.accelo.list_tasks({
  status = "in_progress",
  limit = 20
})

for _, task in ipairs(tasks) do
  print(task.id .. ": " .. task.title .. " [" .. task.status .. "]")
end
```

---

## get_task

Get details of a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Accelo task ID |

### Examples

```lua
local task = app.integrations.accelo.get_task({ id = 67890 })
print(task.title)
print("Status: " .. task.status)
print("Assignee: " .. (task.assignee or "unassigned"))
```

---

## list_projects

List projects in Accelo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of projects per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by status (e.g. "open", "completed", "in_progress") |

### Examples

```lua
-- List all open projects
local projects = app.integrations.accelo.list_projects({
  status = "open"
})

for _, project in ipairs(projects) do
  print(project.id .. ": " .. project.title)
end
```

---

## get_current_user

Get the currently authenticated Accelo user's profile.

### Parameters

None.

### Examples

```lua
local user = app.integrations.accelo.get_current_user({})
print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Accelo deployments configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.accelo.list_tickets({})

-- Explicit default (portable across setups)
app.integrations.accelo.default.list_tickets({})

-- Named accounts
app.integrations.accelo.production.list_tickets({})
app.integrations.accelo.staging.list_tickets({})
```

All functions are identical across accounts — only the credentials differ.
