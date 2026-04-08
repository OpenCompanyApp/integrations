# Terraform Cloud — Lua API Reference

## list_workspaces

List workspaces in a Terraform Cloud organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name to list workspaces for |
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 100 (default: 20) |

### Examples

```lua
-- List workspaces for an organization
local result = app.integrations.terraform.list_workspaces({
  organization = "my-org"
})

for _, ws in ipairs(result.data) do
  print(ws.attributes.name .. " — " .. ws.attributes["terraform-version"])
end

-- Paginate through workspaces
local result = app.integrations.terraform.list_workspaces({
  organization = "my-org",
  pageNumber = 2,
  pageSize = 50
})
```

---

## get_workspace

Get details of a specific Terraform Cloud workspace by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID (starts with "ws-") |

### Example

```lua
local result = app.integrations.terraform.get_workspace({
  workspaceId = "ws-abc123xyz456"
})

local ws = result.data.attributes
print("Workspace: " .. ws.name)
print("Terraform version: " .. ws["terraform-version"])
print("Locked: " .. tostring(ws.locked))
print("Working directory: " .. (ws["working-directory"] or "default"))
```

---

## list_runs

List runs for a Terraform Cloud workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID to list runs for (starts with "ws-") |
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 100 (default: 20) |

### Example

```lua
local result = app.integrations.terraform.list_runs({
  workspaceId = "ws-abc123xyz456"
})

for _, run in ipairs(result.data) do
  print(run.id .. " — status: " .. run.attributes.status)
end
```

---

## get_run

Get details of a specific Terraform Cloud run by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `runId` | string | yes | The run ID (starts with "run-") |

### Example

```lua
local result = app.integrations.terraform.get_run({
  runId = "run-abc123xyz456"
})

local run = result.data.attributes
print("Status: " .. run.status)
print("Trigger: " .. run["trigger-reason"])
print("Created: " .. run["created-at"])
```

---

## list_variables

List variables for a Terraform Cloud workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID to list variables for (starts with "ws-") |

### Example

```lua
local result = app.integrations.terraform.list_variables({
  workspaceId = "ws-abc123xyz456"
})

for _, v in ipairs(result.data) do
  local attrs = v.attributes
  print(attrs.key .. " = " .. (attrs.sensitive and "***" or tostring(attrs.value)))
  print("  category: " .. attrs.category .. ", sensitive: " .. tostring(attrs.sensitive))
end
```

---

## list_organizations

List Terraform Cloud organizations the authenticated user has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 50 (default: 20) |

### Examples

```lua
-- List organizations
local result = app.integrations.terraform.list_organizations({})

for _, org in ipairs(result.data) do
  print(org.attributes.name .. " — " .. (org.attributes["external-id"] or ""))
end

-- Paginate
local result = app.integrations.terraform.list_organizations({
  pageNumber = 2,
  pageSize = 10
})
```

---

## get_current_user

Get the currently authenticated Terraform Cloud user. Useful for verifying authentication.

### Parameters

None.

### Example

```lua
local result = app.integrations.terraform.get_current_user({})

print("Username: " .. result.data.attributes.username)
print("Email: " .. (result.data.attributes.email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Terraform Cloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.terraform.list_organizations({})

-- Explicit default (portable across setups)
app.integrations.terraform.default.list_organizations({})

-- Named accounts
app.integrations.terraform.production.list_workspaces({
  organization = "prod-org"
})
app.integrations.terraform.staging.list_workspaces({
  organization = "staging-org"
})
```

All functions are identical across accounts — only the credentials differ.
