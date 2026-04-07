# Fly.io — Lua API Reference

## list_apps

List all Fly.io apps in the organization.

### Parameters

None.

### Example

```lua
local result = app.integrations["fly-io"].list_apps({})

for _, app in ipairs(result) do
  print(app.name .. " - " .. app.status .. " (" .. app.organization .. ")")
end
```

---

## get_app

Get details for a specific Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```lua
local result = app.integrations["fly-io"].get_app({ app_name = "my-app" })
print(result.name .. " - " .. result.status)
```

---

## create_app

Create a new Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The desired name for the new app |
| `org_slug` | string | no | The organization slug (uses default org if omitted) |

### Example

```lua
local result = app.integrations["fly-io"].create_app({
  app_name = "my-new-app",
  org_slug = "personal"
})
print("Created app: " .. result.name)
```

---

## list_machines

List all machines for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```lua
local result = app.integrations["fly-io"].list_machines({ app_name = "my-app" })

for _, machine in ipairs(result) do
  print(machine.id .. " - " .. machine.state .. " - " .. machine.region)
end
```

---

## get_machine

Get details for a specific Fly.io machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |
| `machine_id` | string | yes | The machine ID |

### Example

```lua
local result = app.integrations["fly-io"].get_machine({
  app_name = "my-app",
  machine_id = "73d8d46dbee589"
})
print(result.id .. " - state: " .. result.state .. " - region: " .. result.region)
```

---

## list_volumes

List all persistent volumes for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```lua
local result = app.integrations["fly-io"].list_volumes({ app_name = "my-app" })

for _, vol in ipairs(result) do
  print(vol.id .. " - " .. vol.name .. " - " .. vol.size_gb .. "GB - " .. vol.region)
end
```

---

## get_current_user

Get the current authenticated Fly.io user information.

### Parameters

None.

### Example

```lua
local result = app.integrations["fly-io"].get_current_user({})
print("User: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Fly.io accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["fly-io"].list_apps({})

-- Explicit default (portable across setups)
app.integrations["fly-io"].default.list_apps({})

-- Named accounts
app.integrations["fly-io"].production.list_apps({})
app.integrations["fly-io"].staging.list_apps({})
```

All functions are identical across accounts — only the credentials differ.
