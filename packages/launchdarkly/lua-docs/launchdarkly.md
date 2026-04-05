# LaunchDarkly — Lua API Reference

## list_flags

List feature flags in a LaunchDarkly project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_key` | string | no | Project key (defaults to configured project) |
| `limit` | integer | no | Max flags to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
-- List flags in default project
local result = app.integrations.launchdarkly.list_flags({})

for _, flag in ipairs(result.flags) do
  print(flag.key .. ": " .. flag.name)
  for env, state in pairs(flag.environments) do
    print("  " .. env .. ": " .. (state and "ON" or "OFF"))
  end
end

-- Paginated listing
local result = app.integrations.launchdarkly.list_flags({
  limit = 50,
  offset = 0
})

-- Specific project
local result = app.integrations.launchdarkly.list_flags({
  project_key = "my-backend-project"
})
```

---

## get_flag

Get detailed information about a specific feature flag.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `feature_flag_key` | string | yes | The flag key, e.g. `"enable-new-dashboard"` |
| `project_key` | string | no | Project key (defaults to configured project) |

### Examples

```lua
local result = app.integrations.launchdarkly.get_flag({
  feature_flag_key = "enable-new-dashboard"
})

print("Flag: " .. result.name)
print("Kind: " .. result.kind)
print("Temporary: " .. tostring(result.temporary))

for env_key, env in pairs(result.environments) do
  print(env_key .. ": " .. (env.on and "ON" or "OFF"))
  print("  Rules: " .. env.rules)
end
```

---

## toggle_flag

Turn a feature flag on or off in a specific environment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `feature_flag_key` | string | yes | The flag key |
| `enabled` | boolean | yes | `true` to turn on, `false` to turn off |
| `environment_key` | string | yes | Environment key, e.g. `"production"` |
| `project_key` | string | no | Project key (defaults to configured project) |

### Examples

```lua
-- Enable a flag in production
local result = app.integrations.launchdarkly.toggle_flag({
  feature_flag_key = "enable-new-dashboard",
  enabled = true,
  environment_key = "production"
})
print(result.message)

-- Disable a flag in staging
local result = app.integrations.launchdarkly.toggle_flag({
  feature_flag_key = "enable-new-dashboard",
  enabled = false,
  environment_key = "staging"
})
print(result.message)
```

---

## list_environments

List all environments for a LaunchDarkly project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_key` | string | no | Project key (defaults to configured project) |

### Examples

```lua
local result = app.integrations.launchdarkly.list_environments({})

for _, env in ipairs(result.environments) do
  print(env.key .. " (" .. env.name .. ")")
  print("  Color: " .. env.color)
  print("  Secure mode: " .. tostring(env.secureMode))
end
```

---

## list_projects

List all LaunchDarkly projects.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.launchdarkly.list_projects({})

for _, project in ipairs(result.projects) do
  print(project.key .. ": " .. project.name)
  print("  Environments: " .. project.environment_count)
  for _, env_key in ipairs(project.environment_keys) do
    print("  - " .. env_key)
  end
end
```

---

## get_current_user

Get the currently authenticated LaunchDarkly user.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.launchdarkly.get_current_user({})

print("User: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
print("Role: " .. result.role)
```

---

## Multi-Account Usage

If you have multiple LaunchDarkly accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.launchdarkly.function_name({...})

-- Explicit default (portable across setups)
app.integrations.launchdarkly.default.function_name({...})

-- Named accounts
app.integrations.launchdarkly.work.function_name({...})
app.integrations.launchdarkly.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
