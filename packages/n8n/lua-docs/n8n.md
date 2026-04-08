# n8n — Lua API Reference

## Overview

The n8n integration provides access to workflows, executions, credentials, and user management. All 7 tools are available under the `app.integrations.n8n` namespace.

Every tool call accepts a single Lua table with named parameters and returns a Lua table with the API response data.

## Authentication

The n8n integration authenticates via an **API Key** (Bearer token). The key is sent as an Authorization header on every request.

To create an API key: **n8n → Settings → API → Create API Key**

```lua
-- All calls use the same namespace — no per-call auth needed
local workflows = app.integrations.n8n.list_workflows({})
```

## Workflows

### `app.integrations.n8n.list_workflows({})`

List n8n workflows.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of workflows to return (default: 100) |

```lua
local workflows = app.integrations.n8n.list_workflows({
  limit = 50,
})

for _, wf in ipairs(workflows.data) do
  print(wf.id .. ": " .. wf.name .. " [" .. (wf.active and "active" or "inactive") .. "]")
end
```

### `app.integrations.n8n.get_workflow({ workflow_id })`

Get details for a specific n8n workflow, including its nodes, connections, and settings.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workflow_id` | string | yes | The ID of the workflow to retrieve |

```lua
local wf = app.integrations.n8n.get_workflow({
  workflow_id = "1234",
})

print("Name: " .. wf.name)
print("Active: " .. tostring(wf.active))
print("Nodes: " .. #wf.nodes)
for _, node in ipairs(wf.nodes) do
  print("  - " .. node.name .. " (" .. node.type .. ")")
end
```

### `app.integrations.n8n.create_workflow({ name, nodes, connections, settings })`

Create a new n8n workflow. Requires a name. Optionally define nodes, connections, and settings.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the workflow |
| `nodes` | array | no | Array of node objects defining the workflow steps |
| `connections` | array | no | Connection mappings between nodes |
| `settings` | array | no | Workflow settings (e.g. executionOrder, saveManualExecutions) |
| `tags` | array | no | Array of tag objects to associate with the workflow |

```lua
local wf = app.integrations.n8n.create_workflow({
  name = "My New Workflow",
  nodes = {
    {
      name = "Start",
      type = "n8n-nodes-base.manualTrigger",
      position = { 250, 300 },
    },
    {
      name = "HTTP Request",
      type = "n8n-nodes-base.httpRequest",
      position = { 450, 300 },
      parameters = {
        url = "https://api.example.com/data",
        method = "GET",
      },
    },
  },
  connections = {
    Start = {
      main = {
        { { node = "HTTP Request", type = "main", index = 0 } },
      },
    },
  },
})

print("Created workflow: " .. wf.id)
print("Name: " .. wf.name)
```

## Executions

### `app.integrations.n8n.list_executions({})`

List n8n workflow executions. Supports filtering by status and workflow ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of executions to return (default: 100) |
| `status` | string | no | Filter by status: `error`, `success`, `waiting` |
| `workflow_id` | string | no | Filter executions by workflow ID |

```lua
local executions = app.integrations.n8n.list_executions({
  status = "success",
  limit = 20,
})

for _, exec in ipairs(executions.data) do
  print("Execution " .. exec.id .. ": " .. exec.status .. " at " .. exec.stoppedAt)
end
```

Filter executions for a specific workflow:

```lua
local executions = app.integrations.n8n.list_executions({
  workflow_id = "1234",
  status = "error",
})

print("Failed executions: " .. #executions.data)
```

### `app.integrations.n8n.get_execution({ execution_id })`

Get detailed information about a specific n8n workflow execution, including status, data, and node results.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `execution_id` | string | yes | The ID of the execution to retrieve |

```lua
local exec = app.integrations.n8n.get_execution({
  execution_id = "5678",
})

print("Status: " .. exec.status)
print("Workflow ID: " .. exec.workflowId)
print("Started: " .. exec.startedAt)
print("Stopped: " .. (exec.stoppedAt or "running"))
```

## Credentials

### `app.integrations.n8n.list_credentials({})`

List n8n credentials.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of credentials to return (default: 100) |

```lua
local creds = app.integrations.n8n.list_credentials({
  limit = 50,
})

for _, cred in ipairs(creds.data) do
  print(cred.id .. ": " .. cred.name .. " (" .. cred.type .. ")")
end
```

## User

### `app.integrations.n8n.get_current_user({})`

Get the authenticated n8n user's profile. Useful to verify credentials and discover user info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local user = app.integrations.n8n.get_current_user({})

print("Name: " .. (user.firstName or "") .. " " .. (user.lastName or ""))
print("Email: " .. user.email)
print("Global ID: " .. user.globalId)
```

## Common Workflows

### Create and inspect a workflow

```lua
-- 1. Create a simple workflow
local wf = app.integrations.n8n.create_workflow({
  name = "Daily Report Generator",
  nodes = {
    {
      name = "Schedule Trigger",
      type = "n8n-nodes-base.scheduleTrigger",
      position = { 250, 300 },
      parameters = {
        rule = { interval = [{ field = "hours", hoursInterval = 24 }] },
      },
    },
    {
      name = "HTTP Request",
      type = "n8n-nodes-base.httpRequest",
      position = { 450, 300 },
      parameters = {
        url = "https://api.example.com/report",
        method = "GET",
      },
    },
  },
  connections = {
    ["Schedule Trigger"] = {
      main = {
        { { node = "HTTP Request", type = "main", index = 0 } },
      },
    },
  },
})

print("Created workflow ID: " .. wf.id)

-- 2. Retrieve the workflow to verify
local fetched = app.integrations.n8n.get_workflow({
  workflow_id = tostring(wf.id),
})

print("Workflow has " .. #fetched.nodes .. " nodes")
```

### Monitor execution history

```lua
local executions = app.integrations.n8n.list_executions({
  workflow_id = "1234",
  limit = 10,
})

local success_count = 0
local error_count = 0

for _, exec in ipairs(executions.data) do
  if exec.status == "success" then
    success_count = success_count + 1
  elseif exec.status == "error" then
    error_count = error_count + 1
  end
end

print("Recent executions: " .. success_count .. " succeeded, " .. error_count .. " failed")
```

### Inspect a failed execution

```lua
local executions = app.integrations.n8n.list_executions({
  status = "error",
  limit = 1,
})

if #executions.data > 0 then
  local latest_error = executions.data[1]

  local exec = app.integrations.n8n.get_execution({
    execution_id = tostring(latest_error.id),
  })

  print("Execution " .. exec.id .. " failed")
  print("Workflow: " .. exec.workflowId)
  print("Started at: " .. exec.startedAt)
end
```

### List all credentials and their types

```lua
local creds = app.integrations.n8n.list_credentials({})

local types = {}
for _, cred in ipairs(creds.data) do
  local t = cred.type
  types[t] = (types[t] or 0) + 1
end

for type_name, count in pairs(types) do
  print(type_name .. ": " .. count .. " credential(s)")
end
```

## Pagination

List endpoints use cursor-based pagination. When more results are available, the response includes a `nextCursor` field. Pass this as the `cursor` parameter in the next call to fetch the next page.

```lua
local all_workflows = {}
local cursor = nil

repeat
  local params = { limit = 100 }
  if cursor then
    params.cursor = cursor
  end

  local result = app.integrations.n8n.list_workflows(params)

  for _, wf in ipairs(result.data) do
    table.insert(all_workflows, wf)
  end

  cursor = result.nextCursor
until cursor == nil

print("Total workflows fetched: " .. #all_workflows)
```

## Notes

- **Workflow nodes**: Nodes are defined with a `type` (e.g. `n8n-nodes-base.httpRequest`), a `name` (unique within the workflow), and `parameters` specific to that node type.
- **Connections**: Connections define the flow of data between nodes. The structure maps source node names to target node names with main/input/output indices.
- **Execution data**: The `get_execution` response may include full execution data with input/output for each node, depending on your n8n instance settings.
- **Credential types**: Credential `type` values correspond to n8n node types (e.g. `httpHeaderAuth`, `oAuth2Api`, `smtpAccount`).
- **API version**: This integration uses the n8n REST API v1 at `https://api.n8n.io/v1`.

---

## Multi-Account Usage

If you have multiple n8n accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.n8n.function_name({...})

-- Explicit default (portable across setups)
app.integrations.n8n.default.function_name({...})

-- Named accounts
app.integrations.n8n.production.function_name({...})
app.integrations.n8n.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
