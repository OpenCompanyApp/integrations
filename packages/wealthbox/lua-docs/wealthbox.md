# Wealthbox CRM — Lua API Reference

## list_contacts

List contacts from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of contacts per page (default: 25, max: 200) |
| `search` | string | no | Search term to filter contacts by name or email |

### Examples

```lua
-- List all contacts
local result = app.integrations.wealthbox.list_contacts({})

for _, contact in ipairs(result.contacts) do
  print(contact.first_name .. " " .. contact.last_name)
end
```

```lua
-- Search for a contact
local result = app.integrations.wealthbox.list_contacts({
  search = "John"
})
```

```lua
-- Paginate through contacts
local result = app.integrations.wealthbox.list_contacts({
  page = 2,
  per_page = 50
})
```

---

## get_contact

Get a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID in Wealthbox |

### Examples

```lua
local result = app.integrations.wealthbox.get_contact({
  id = 12345
})

print(result.first_name .. " " .. result.last_name)
print("Email: " .. (result.email or "N/A"))
```

---

## create_contact

Create a new contact in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no* | Contact's first name |
| `last_name` | string | no* | Contact's last name |
| `email` | string | no | Contact's email address |
| `phone` | string | no | Contact's phone number |
| `street` | string | no | Street address |
| `city` | string | no | City |
| `state` | string | no | State or province |
| `zip` | string | no | ZIP or postal code |
| `type` | string | no | Contact type (e.g., "Client", "Prospect", "Lead") |
| `tags` | array | no | Tags to assign to the contact |

*At least `first_name` or `last_name` is required.

### Examples

```lua
-- Create a basic contact
local result = app.integrations.wealthbox.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com"
})

print("Created contact ID: " .. result.id)
```

```lua
-- Create a contact with full details
local result = app.integrations.wealthbox.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  phone = "+1-555-0123",
  street = "123 Main St",
  city = "New York",
  state = "NY",
  zip = "10001",
  type = "Client",
  tags = {"VIP", "Referral"}
})
```

---

## list_tasks

List tasks from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of tasks per page (default: 25, max: 200) |
| `status` | string | no | Filter by task status (e.g., "open", "completed") |

### Examples

```lua
-- List open tasks
local result = app.integrations.wealthbox.list_tasks({
  status = "open"
})

for _, task in ipairs(result.tasks) do
  print(task.name .. " — Due: " .. (task.due_date or "No date"))
end
```

---

## create_task

Create a new task in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The task name or title |
| `due_date` | string | no | Due date (ISO 8601, e.g., "2026-04-15") |
| `description` | string | no | Task description or notes |
| `assignee_id` | integer | no | User ID of the assignee |
| `contact_id` | integer | no | Link the task to a contact by their ID |
| `priority` | string | no | Task priority (e.g., "high", "medium", "low") |

### Examples

```lua
-- Create a follow-up task
local result = app.integrations.wealthbox.create_task({
  name = "Follow up with Jane Smith",
  due_date = "2026-04-15",
  description = "Discuss portfolio rebalancing",
  contact_id = 12345,
  priority = "high"
})

print("Created task ID: " .. result.id)
```

---

## list_opportunities

List opportunities (sales pipeline) from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of opportunities per page (default: 25, max: 200) |
| `status` | string | no | Filter by opportunity status (e.g., "open", "won", "lost") |

### Examples

```lua
-- List open opportunities
local result = app.integrations.wealthbox.list_opportunities({
  status = "open"
})

for _, opp in ipairs(result.opportunities) do
  print(opp.name .. " — Value: $" .. (opp.value or "0"))
end
```

---

## list_workflows

List workflows from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of workflows per page (default: 25, max: 200) |

### Examples

```lua
local result = app.integrations.wealthbox.list_workflows({})

for _, workflow in ipairs(result.workflows) do
  print(workflow.name .. " — Status: " .. workflow.status)
end
```

---

## list_events

List calendar events from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of events per page (default: 25, max: 200) |
| `start_date` | string | no | Filter events starting from this date (ISO 8601) |
| `end_date` | string | no | Filter events up to this date (ISO 8601) |

### Examples

```lua
-- List upcoming events for April 2026
local result = app.integrations.wealthbox.list_events({
  start_date = "2026-04-01",
  end_date = "2026-04-30"
})

for _, event in ipairs(result.events) do
  print(event.title .. " — " .. event.starts_at)
end
```

---

## get_current_user

Get the currently authenticated Wealthbox user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.wealthbox.get_current_user({})

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Wealthbox accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wealthbox.function_name({...})

-- Explicit default (portable across setups)
app.integrations.wealthbox.default.function_name({...})

-- Named accounts
app.integrations.wealthbox.personal.function_name({...})
app.integrations.wealthbox.firm.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
