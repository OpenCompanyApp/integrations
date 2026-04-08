# Modal — Lua API Reference

Modal is a serverless GPU platform for running AI and compute workloads in the cloud. This integration lets you list apps, get app details, browse functions and schedules, and manage volumes and secrets — all from Lua scripts.

## Authentication

Uses a **Modal API Key** (Bearer token). Configure it in your integration settings. The key authenticates via the Modal REST API at `https://api.modal.com/v1`. API keys are scoped to the user or workspace that created them — the integration can only access resources within that scope.

---

## Overview

All tools are called via `app.integrations.modal.<tool_name>({ ... })`. Every function takes a single Lua table of named parameters and returns a result table.

```lua
local result = app.integrations.modal.get_app({ app_id = "ap-abc123" })
```

Errors surface as `result.error` (string). Check for it before using the response.

```lua
if result.error then
  print("Error: " .. result.error)
  return
end
```

---

## list_apps

List all Modal apps in the workspace. Returns app IDs, names, and status details.

### Parameters

None.

### Example

```lua
local result = app.integrations.modal.list_apps({})

if result.error then
  print("Error: " .. result.error)
else
  for _, app in ipairs(result) do
    print(app.name .. " - " .. app.status .. " (" .. app.app_id .. ")")
  end
end
```

---

## get_app

Get details for a specific Modal app by ID, including status and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app. |

### Example

```lua
local result = app.integrations.modal.get_app({ app_id = "ap-abc123" })

if result.error then
  print("Error: " .. result.error)
else
  print(result.name .. " - " .. result.status)
end
```

---

## list_functions

List all functions for a Modal app. Returns function IDs, names, and runtime details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list functions for. |

### Example

```lua
local result = app.integrations.modal.list_functions({ app_id = "ap-abc123" })

if result.error then
  print("Error: " .. result.error)
else
  for _, fn in ipairs(result) do
    print(fn.name .. " - " .. (fn.runtime or "unknown"))
  end
end
```

---

## list_schedules

List all scheduled functions for a Modal app. Returns schedule IDs, cron expressions, and associated function details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list schedules for. |

### Example

```lua
local result = app.integrations.modal.list_schedules({ app_id = "ap-abc123" })

if result.error then
  print("Error: " .. result.error)
else
  for _, sched in ipairs(result) do
    print(sched.function_name .. " - cron: " .. (sched.cron or "N/A"))
  end
end
```

---

## list_volumes

List all Modal volumes. Returns volume IDs, names, and size details.

### Parameters

None.

### Example

```lua
local result = app.integrations.modal.list_volumes({})

if result.error then
  print("Error: " .. result.error)
else
  for _, vol in ipairs(result) do
    print(vol.name .. " - " .. (vol.size_gb or "?") .. " GB")
  end
end
```

---

## list_secrets

List all Modal secrets. Returns secret names and creation dates. Secret values are never exposed.

### Parameters

None.

### Example

```lua
local result = app.integrations.modal.list_secrets({})

if result.error then
  print("Error: " .. result.error)
else
  for _, secret in ipairs(result) do
    print(secret.name .. " - created: " .. (secret.created_at or "unknown"))
  end
end
```

---

## get_current_user

Get the current authenticated Modal user information, including name, email, and account details.

### Parameters

None.

### Example

```lua
local result = app.integrations.modal.get_current_user({})

if result.error then
  print("Error: " .. result.error)
else
  print("User: " .. (result.name or result.email or "unknown"))
end
```

---

## Multi-Account Usage

If you have multiple Modal accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.modal.list_apps({})

-- Explicit default (portable across setups)
app.integrations.modal.default.list_apps({})

-- Named accounts
app.integrations.modal.production.list_apps({})
app.integrations.modal.staging.list_apps({})
```

All functions are identical across accounts — only the credentials differ.
