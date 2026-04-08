# Split — Lua API Reference

## list_splits

List feature splits in a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |
| `limit` | integer | no | Max splits to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
-- List splits in default workspace
local result = app.integrations.split.list_splits({})

for _, split in ipairs(result.splits) do
  print(split.name .. " (" .. split.trafficTypeName .. ")")
end

-- Paginated listing
local result = app.integrations.split.list_splits({
  limit = 50,
  offset = 0
})

-- Specific workspace
local result = app.integrations.split.list_splits({
  workspace_id = "abc123"
})
```

---

## get_split

Get detailed information about a specific feature split.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `split_name` | string | yes | The split name, e.g. `"new-checkout-flow"` |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```lua
local result = app.integrations.split.get_split({
  split_name = "new-checkout-flow"
})

print("Split: " .. result.name)
print("Traffic Type: " .. result.trafficTypeName)
print("Killed: " .. tostring(result.killed))
print("Treatments: " .. #result.treatments)
```

---

## create_split

Create a new feature split in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The split name |
| `traffic_type_name` | string | yes | Traffic type name, e.g. `"user"` |
| `description` | string | no | Optional description |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```lua
-- Create a basic split
local result = app.integrations.split.create_split({
  name = "new-checkout-flow",
  traffic_type_name = "user"
})
print(result.message)

-- Create with description
local result = app.integrations.split.create_split({
  name = "new-pricing-page",
  traffic_type_name = "user",
  description = "Controls the new pricing page rollout"
})
print(result.message)
```

---

## list_environments

List all environments for a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```lua
local result = app.integrations.split.list_environments({})

for _, env in ipairs(result.environments) do
  print(env.id .. ": " .. env.name .. " (" .. env.type .. ")")
end
```

---

## get_environment

Get detailed information about a specific Split environment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `environment_id` | string | yes | The environment ID |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```lua
local result = app.integrations.split.get_environment({
  environment_id = "env-123"
})

print("Environment: " .. result.name)
print("Type: " .. result.type)
print("Status: " .. result.status)
```

---

## list_workspaces

List all Split workspaces.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.split.list_workspaces({})

for _, ws in ipairs(result.workspaces) do
  print(ws.id .. ": " .. ws.name)
end
```

---

## get_current_user

Get the currently authenticated Split user.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.split.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
print("Type: " .. result.type)
```

---

## Multi-Account Usage

If you have multiple Split accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.split.function_name({...})

-- Explicit default (portable across setups)
app.integrations.split.default.function_name({...})

-- Named accounts
app.integrations.split.production.function_name({...})
app.integrations.split.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
