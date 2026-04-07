# Paperspace — Lua API Reference

## list_machines

List all GPU machines in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.list_machines({})

for _, machine in ipairs(result) do
  print(machine.name .. " (" .. machine.state .. ") - " .. machine.machineType)
end
```

---

## get_machine

Get details for a specific machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `machine_id` | string | yes | The machine ID |

### Example

```lua
local result = app.integrations.paperspace.get_machine({ machine_id = "psabc123" })
local m = result
print(m.name .. " - " .. m.os .. " - " .. m.publicIp)
```

---

## list_notebooks

List all Gradient notebooks in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.list_notebooks({})

for _, notebook in ipairs(result) do
  print(notebook.name .. " (" .. notebook.state .. ")")
end
```

---

## list_datasets

List all datasets in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.list_datasets({})

for _, dataset in ipairs(result) do
  print(dataset.name .. " - " .. (dataset.size or "unknown size"))
end
```

---

## list_projects

List all Gradient projects in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.list_projects({})

for _, project in ipairs(result) do
  print(project.name .. " - " .. (project.description or "no description"))
end
```

---

## list_ssh_keys

List all SSH keys in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.list_ssh_keys({})

for _, key in ipairs(result) do
  print(key.name .. " - " .. key.fingerprint)
end
```

---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.paperspace.get_current_user({})
print("User: " .. result.email .. " (ID: " .. result.id .. ")")
```

---

## Multi-Account Usage

If you have multiple Paperspace accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.paperspace.list_machines({})

-- Explicit default (portable across setups)
app.integrations.paperspace.default.list_machines({})

-- Named accounts
app.integrations.paperspace.production.list_machines({})
app.integrations.paperspace.staging.list_machines({})
```

All functions are identical across accounts — only the credentials differ.
