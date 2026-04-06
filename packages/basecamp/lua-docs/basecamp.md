# Basecamp 3 — Lua API Reference

## list_projects

List all Basecamp projects visible to the authenticated user.

### Parameters

*None required.*

### Example

```lua
local result = app.integrations.basecamp.list_projects({})

for _, project in ipairs(result) do
  print(project.id .. ": " .. project.name)
end
```

---

## get_project

Get details for a single Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```lua
local result = app.integrations.basecamp.get_project({
  project_id = 12345
})

print("Project: " .. result.name)
print("Description: " .. (result.description or "none"))
```

---

## list_todos

List to-dos in a specific Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |

### Example

```lua
local result = app.integrations.basecamp.list_todos({
  project_id = 12345,
  todoset_id = 67890,
  todolist_id = 11111
})

for _, todo in ipairs(result) do
  print(todo.content .. (todo.completed and " ✓" or " ○"))
end
```

---

## create_todo

Create a new to-do in a Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |
| `content` | string | yes | The to-do text |
| `description` | string | no | Extended description (HTML supported) |
| `due_on` | string | no | Due date in ISO 8601 format (e.g., "2026-04-30") |
| `assignee_ids` | array | no | List of person IDs to assign (e.g., {1234, 5678}) |

### Example

```lua
local result = app.integrations.basecamp.create_todo({
  project_id = 12345,
  todoset_id = 67890,
  todolist_id = 11111,
  content = "Review the latest pull request",
  description = "Check PR #42 for the auth module changes",
  due_on = "2026-04-30"
})

print("Created to-do: " .. result.content)
```

---

## list_messages

List messages (message board posts) for a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```lua
local result = app.integrations.basecamp.list_messages({
  project_id = 12345
})

for _, msg in ipairs(result) do
  print(msg.subject .. " by " .. (msg.creator.name or "unknown"))
end
```

---

## get_message

Get a single message from a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `message_id` | integer | yes | The message (board post) ID |

### Example

```lua
local result = app.integrations.basecamp.get_message({
  project_id = 12345,
  message_id = 99999
})

print("Subject: " .. result.subject)
print("By: " .. result.creator.name)
```

---

## get_current_user

Get the profile of the currently authenticated Basecamp user.

### Parameters

*None required.*

### Example

```lua
local result = app.integrations.basecamp.get_current_user({})

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email_address)
```

---

## Multi-Account Usage

If you have multiple Basecamp accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.basecamp.function_name({...})

-- Explicit default (portable across setups)
app.integrations.basecamp.default.function_name({...})

-- Named accounts
app.integrations.basecamp.work.function_name({...})
app.integrations.basecamp.client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
