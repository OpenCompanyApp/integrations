# Cursor — Lua API Reference

## list_workspaces

List all Cursor workspaces accessible to the authenticated user.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.cursor.list_workspaces({})

for _, workspace in ipairs(result) do
  print(workspace.id .. ": " .. workspace.name)
end
```

---

## get_workspace

Get details for a specific Cursor workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace identifier |

### Examples

```lua
local result = app.integrations.cursor.get_workspace({
  workspace_id = "ws_abc123"
})

print("Workspace: " .. result.name)
print("ID: " .. result.id)
```

---

## list_team_members

List all team members in a Cursor workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace identifier |

### Examples

```lua
local result = app.integrations.cursor.list_team_members({
  workspace_id = "ws_abc123"
})

for _, member in ipairs(result) do
  print(member.name .. " (" .. member.email .. ") — " .. member.role)
end
```

---

## list_extensions

List all extensions installed in a Cursor workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace identifier |

### Examples

```lua
local result = app.integrations.cursor.list_extensions({
  workspace_id = "ws_abc123"
})

for _, ext in ipairs(result) do
  print(ext.identifier .. " v" .. ext.version)
end
```

---

## Multi-Account Usage

If you have multiple Cursor accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cursor.list_workspaces({})

-- Explicit default (portable across setups)
app.integrations.cursor.default.list_workspaces({})

-- Named accounts
app.integrations.cursor.work.list_workspaces({})
app.integrations.cursor.personal.list_workspaces({})
```

All functions are identical across accounts — only the credentials differ.
