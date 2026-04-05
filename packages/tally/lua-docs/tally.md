# Tally — Lua API Reference

## list_forms

List all forms accessible in the Tally workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of forms to return (default: 100) |
| `after` | string | no | Cursor for pagination — pass the value from a previous response to get the next page |

### Examples

```lua
-- List all forms
local result = app.integrations.tally.list_forms({})

for _, form in ipairs(result.forms or {}) do
  print(form.name .. " (ID: " .. form.id .. ") — " .. form.numberOfSubmissions .. " submissions")
end
```

```lua
-- Paginate through forms
local result = app.integrations.tally.list_forms({ limit = 10 })

if result.nextCursor then
  local next = app.integrations.tally.list_forms({ limit = 10, after = result.nextCursor })
end
```

---

## get_form

Get full details for a specific Tally form, including all fields and settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The Tally form ID (e.g., `"mVlDK4"`) |

### Examples

```lua
local result = app.integrations.tally.get_form({ form_id = "mVlDK4" })

print("Form: " .. result.name)
print("Status: " .. result.status)
print("Fields:")

for _, block in ipairs(result.blocks or {}) do
  if block.type == "INPUT" then
    print("  - " .. (block.title or "Untitled") .. " (" .. block.type .. ")")
  end
end
```

---

## list_submissions

List submissions for a specific Tally form. Supports date filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The Tally form ID |
| `limit` | integer | no | Maximum number of submissions to return (default: 100) |
| `after` | string | no | Cursor for pagination |
| `submitted_after` | string | no | ISO 8601 date — only return submissions after this date |
| `submitted_before` | string | no | ISO 8601 date — only return submissions before this date |

### Examples

```lua
-- List recent submissions for a form
local result = app.integrations.tally.list_submissions({
  form_id = "mVlDK4",
  limit = 20
})

for _, sub in ipairs(result.submissions or {}) do
  print("Submitted: " .. sub.submittedAt)
end
```

```lua
-- Filter submissions by date range
local result = app.integrations.tally.list_submissions({
  form_id = "mVlDK4",
  submitted_after = "2026-01-01T00:00:00Z",
  submitted_before = "2026-01-31T23:59:59Z",
  limit = 100
})

for _, sub in ipairs(result.submissions or {}) do
  print("Submitted: " .. sub.submittedAt)
end
```

---

## get_submission

Get full details of a single Tally form submission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | string | yes | The Tally submission ID |

### Examples

```lua
local result = app.integrations.tally.get_submission({ submission_id = "sub_abc123" })

print("Submitted at: " .. result.submittedAt)

for key, value in pairs(result.data or {}) do
  print("  " .. key .. ": " .. tostring(value))
end
```

---

## list_workspaces

List all workspaces accessible to the authenticated Tally user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.tally.list_workspaces({})

for _, ws in ipairs(result.workspaces or {}) do
  print("Workspace: " .. ws.name .. " (ID: " .. ws.id .. ")")
end
```

---

## get_current_user

Get profile information for the currently authenticated Tally user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.tally.get_current_user({})

print("Name: " .. (result.firstName or "") .. " " .. (result.lastName or ""))
print("Email: " .. (result.email or ""))
```

---

## Multi-Account Usage

If you have multiple Tally accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.tally.function_name({...})

-- Explicit default (portable across setups)
app.integrations.tally.default.function_name({...})

-- Named accounts
app.integrations.tally.marketing.function_name({...})
app.integrations.tally.hr.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
