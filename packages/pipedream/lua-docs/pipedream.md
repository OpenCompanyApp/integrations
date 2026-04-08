# Pipedream — Lua API Reference

## list_workflows

List automation workflows in Pipedream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of workflows per page (default: 25, max: 100) |

### Examples

```lua
local result = app.integrations.pipedream.list_workflows({
  page = 1,
  limit = 10
})

for _, wf in ipairs(result.data) do
  print(wf.id .. ": " .. wf.name)
end
```

---

## get_workflow

Get details of a specific workflow by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID |

### Examples

```lua
local result = app.integrations.pipedream.get_workflow({
  id = "abc_123"
})

print(result.data.name)
print("Status: " .. result.data.status)
```

---

## list_components

List available Pipedream components (actions, triggers, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Component type filter: "action", "trigger" |
| `limit` | integer | no | Number of components per page (default: 25, max: 100) |

### Examples

```lua
-- List action components
local result = app.integrations.pipedream.list_components({
  type = "action",
  limit = 20
})

for _, comp in ipairs(result.data) do
  print(comp.key .. " (" .. comp.app .. ")")
end
```

---

## get_component

Get details of a specific component by app and key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | string | yes | App slug (e.g., "slack", "github") |
| `id` | string | yes | Component key or ID (e.g., "send-message") |

### Examples

```lua
local result = app.integrations.pipedream.get_component({
  app = "slack",
  id = "send-message"
})

print(result.data.name)
print("Version: " .. result.data.version)
```

---

## list_connected_accounts

List connected third-party accounts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of accounts per page (default: 25, max: 100) |

### Examples

```lua
local result = app.integrations.pipedream.list_connected_accounts({
  page = 1,
  limit = 10
})

for _, acct in ipairs(result.data) do
  print(acct.id .. ": " .. acct.name .. " (" .. acct.app .. ")")
end
```

---

## list_triggers

List event triggers for a specific workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workflow_id` | string | yes | The workflow ID to list triggers for |

### Examples

```lua
local result = app.integrations.pipedream.list_triggers({
  workflow_id = "abc_123"
})

for _, trigger in ipairs(result.data) do
  print(trigger.type .. ": " .. (trigger.name or "unnamed"))
end
```

---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.pipedream.get_current_user({})

print("User: " .. result.data.name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Pipedream accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pipedream.list_workflows({})

-- Explicit default (portable across setups)
app.integrations.pipedream.default.list_workflows({})

-- Named accounts
app.integrations.pipedream.production.list_workflows({})
app.integrations.pipedream.staging.list_workflows({})
```

All functions are identical across accounts — only the credentials differ.
