# n8n — JavaScript API Reference

## Overview

The n8n integration provides access to workflows, executions, credentials, and user management. All 7 tools are available under the `app.integrations.n8n` namespace.

Every tool call accepts a single JavaScript object with named parameters and returns a JavaScript object with the API response data.

## Authentication

The n8n integration authenticates via an **API Key** (Bearer token). The key is sent as an Authorization header on every request.

To create an API key: **n8n → Settings → API → Create API Key**

```js
// All calls use the same namespace — no per-call auth needed
var workflows = app.integrations.n8n.list_workflows({})
```
## Workflows

### `app.integrations.n8n.list_workflows({})`

List n8n workflows.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of workflows to return (default: 100) |

```js
var workflows = app.integrations.n8n.list_workflows({
  limit: 50,
})

for (const wf of (workflows.data)) {
  console.log(wf.id + ": " + wf.name + " [" + (wf.active && "active" || "inactive") + "]")
}
```
### `app.integrations.n8n.get_workflow({ workflow_id })`

Get details for a specific n8n workflow, including its nodes, connections, and settings.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workflow_id` | string | yes | The ID of the workflow to retrieve |

```js
var wf = app.integrations.n8n.get_workflow({
  workflow_id: "1234",
})

console.log("Name: " + wf.name)
console.log("Active: " + String(wf.active))
console.log("Nodes: " + wf.nodes.length)
for (const node of (wf.nodes)) {
  console.log("  - " + node.name + " (" + node.type + ")")
}
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

```js
var wf = app.integrations.n8n.create_workflow({
  name: "My New Workflow",
  nodes: [
    {
      name: "Start",
      type: "n8n-nodes-base.manualTrigger",
      position: [ 250, 300 ],
    },
    {
      name: "HTTP Request",
      type: "n8n-nodes-base.httpRequest",
      position: [ 450, 300 ],
      parameters: {
        url: "https://api.example.com/data",
        method: "GET",
      },
    },
  ],
  connections: {
    Start: {
      main: [
        [ { node: "HTTP Request", type: "main", index: 0 } ],
      ],
    },
  },
})

console.log("Created workflow: " + wf.id)
console.log("Name: " + wf.name)
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

```js
var executions = app.integrations.n8n.list_executions({
  status: "success",
  limit: 20,
})

for (const exec of (executions.data)) {
  console.log("Execution " + exec.id + ": " + exec.status + " at " + exec.stoppedAt)
}
```
Filter executions for a specific workflow:

```js
var executions = app.integrations.n8n.list_executions({
  workflow_id: "1234",
  status: "error",
})

console.log("Failed executions: " + executions.data.length)
```
### `app.integrations.n8n.get_execution({ execution_id })`

Get detailed information about a specific n8n workflow execution, including status, data, and node results.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `execution_id` | string | yes | The ID of the execution to retrieve |

```js
var exec = app.integrations.n8n.get_execution({
  execution_id: "5678",
})

console.log("Status: " + exec.status)
console.log("Workflow ID: " + exec.workflowId)
console.log("Started: " + exec.startedAt)
console.log("Stopped: " + (exec.stoppedAt || "running"))
```
## Credentials

### `app.integrations.n8n.list_credentials({})`

List n8n credentials.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of credentials to return (default: 100) |

```js
var creds = app.integrations.n8n.list_credentials({
  limit: 50,
})

for (const cred of (creds.data)) {
  console.log(cred.id + ": " + cred.name + " (" + cred.type + ")")
}
```
## User

### `app.integrations.n8n.get_current_user({})`

Get the authenticated n8n user's profile. Useful to verify credentials and discover user info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var user = app.integrations.n8n.get_current_user({})

console.log("Name: " + (user.firstName || "") + " " + (user.lastName || ""))
console.log("Email: " + user.email)
console.log("Global ID: " + user.globalId)
```
## Common Workflows

### Create and inspect a workflow

```js
// 1. Create a simple workflow
var wf = app.integrations.n8n.create_workflow({
  name: "Daily Report Generator",
  nodes: [
    {
      name: "Schedule Trigger",
      type: "n8n-nodes-base.scheduleTrigger",
      position: [ 250, 300 ],
      parameters: {
        rule: { interval: [{ field: "hours", hoursInterval: 24 }] },
      },
    },
    {
      name: "HTTP Request",
      type: "n8n-nodes-base.httpRequest",
      position: [ 450, 300 ],
      parameters: {
        url: "https://api.example.com/report",
        method: "GET",
      },
    },
  ],
  connections: {
    ["Schedule Trigger"]: {
      main: [
        [ { node: "HTTP Request", type: "main", index: 0 } ],
      ],
    },
  },
})

console.log("Created workflow ID: " + wf.id)

// 2. Retrieve the workflow to verify
var fetched = app.integrations.n8n.get_workflow({
  workflow_id: String(wf.id),
})

console.log("Workflow has " + fetched.nodes.length + " nodes")
```
### Monitor execution history

```js
var executions = app.integrations.n8n.list_executions({
  workflow_id: "1234",
  limit: 10,
})

var success_count = 0
var error_count = 0

for (const exec of (executions.data)) {
  if (exec.status === "success") {
    success_count = success_count + 1
  } else if (exec.status === "error") {
    error_count = error_count + 1
  }
}

console.log("Recent executions: " + success_count + " succeeded, " + error_count + " failed")
```
### Inspect a failed execution

```js
var executions = app.integrations.n8n.list_executions({
  status: "error",
  limit: 1,
})

if (executions.data.length > 0) {
  var latest_error = executions.data[0]

  var exec = app.integrations.n8n.get_execution({
    execution_id: String(latest_error.id),
  })

  console.log("Execution " + exec.id + " failed")
  console.log("Workflow: " + exec.workflowId)
  console.log("Started at: " + exec.startedAt)
}
```
### List all credentials and their types

```js
var creds = app.integrations.n8n.list_credentials({})

var types = {}
for (const cred of (creds.data)) {
  var t = cred.type
  types[t] = (types[t] || 0) + 1
}

for (const [type_name, count] of Object.entries(types)) {
  console.log(type_name + ": " + count + " credential(s)")
}
```
## Pagination

List endpoints use cursor-based pagination. When more results are available, the response includes a `nextCursor` field. Pass this as the `cursor` parameter in the next call to fetch the next page.

```js
var all_workflows = []
var cursor = null

do {
  var params = { limit: 100 }
  if (cursor) {
    params.cursor = cursor
  }

  var result = app.integrations.n8n.list_workflows(params)

  for (const wf of (result.data)) {
    all_workflows.push(wf)
  }

  cursor = result.nextCursor
} while (!(cursor === null));

console.log("Total workflows fetched: " + all_workflows.length)
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

```js
// Default account (always works)
app.integrations.n8n.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.n8n.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.n8n.production.function_name({ /* parameters */ })
app.integrations.n8n.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
