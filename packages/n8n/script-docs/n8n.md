# n8n — Ruby API Reference

## Overview

The n8n integration provides access to workflows, executions, credentials, and user management. All 7 tools are available under the `app.integrations.n8n` namespace.

Every tool call accepts a single Ruby object with named parameters and returns a Ruby object with the API response data.

## Authentication

The n8n integration authenticates via an **API Key** (Bearer token). The key is sent as an Authorization header on every request.

To create an API key: **n8n → Settings → API → Create API Key**

```ruby
# All calls use the same namespace — no per-call auth needed
workflows = app.integrations.n8n.list_workflows()
```
## Workflows

### `app.integrations.n8n.list_workflows({})`

List n8n workflows.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of workflows to return (default: 100) |

```ruby
workflows = app.integrations.n8n.list_workflows(limit: 50)
workflows.data.each do |wf|
  puts((wf.id).to_s + ": " + (wf.name).to_s + " [" + (((wf.active && "active") || "inactive")).to_s + "]")
end
```
### `app.integrations.n8n.get_workflow({ workflow_id })`

Get details for a specific n8n workflow, including its nodes, connections, and settings.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workflow_id` | string | yes | The ID of the workflow to retrieve |

```ruby
wf = app.integrations.n8n.get_workflow(workflow_id: "1234")
puts("Name: " + (wf.name).to_s)
puts("Active: " + ((wf.active).to_s).to_s)
puts("Nodes: " + (wf.nodes.length).to_s)
wf.nodes.each do |node|
  puts("  - " + (node.name).to_s + " (" + (node.type).to_s + ")")
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

```ruby
wf = app.integrations.n8n.create_workflow(name: "My New Workflow", nodes: [{name: "Start", type: "n8n-nodes-base.manualTrigger", position: [250, 300]}, {name: "HTTP Request", type: "n8n-nodes-base.httpRequest", position: [450, 300], parameters: {url: "https://api.example.com/data", method: "GET"}}], connections: {Start: {main: [[{node: "HTTP Request", type: "main", index: 0}]]}})
puts("Created workflow: " + (wf.id).to_s)
puts("Name: " + (wf.name).to_s)
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

```ruby
executions = app.integrations.n8n.list_executions(status: "success", limit: 20)
executions.data.each do |exec|
  puts("Execution " + (exec.id).to_s + ": " + (exec.status).to_s + " at " + (exec.stoppedAt).to_s)
end
```
Filter executions for a specific workflow:

```ruby
executions = app.integrations.n8n.list_executions(workflow_id: "1234", status: "error")
puts("Failed executions: " + (executions.data.length).to_s)
```
### `app.integrations.n8n.get_execution({ execution_id })`

Get detailed information about a specific n8n workflow execution, including status, data, and node results.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `execution_id` | string | yes | The ID of the execution to retrieve |

```ruby
exec = app.integrations.n8n.get_execution(execution_id: "5678")
puts("Status: " + (exec.status).to_s)
puts("Workflow ID: " + (exec.workflowId).to_s)
puts("Started: " + (exec.startedAt).to_s)
puts("Stopped: " + ((exec.stoppedAt || "running")).to_s)
```
## Credentials

### `app.integrations.n8n.list_credentials({})`

List n8n credentials.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of credentials to return (default: 100) |

```ruby
creds = app.integrations.n8n.list_credentials(limit: 50)
creds.data.each do |cred|
  puts((cred.id).to_s + ": " + (cred.name).to_s + " (" + (cred.type).to_s + ")")
end
```
## User

### `app.integrations.n8n.get_current_user({})`

Get the authenticated n8n user's profile. Useful to verify credentials and discover user info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
user = app.integrations.n8n.get_current_user()
puts("Name: " + ((user.firstName || "")).to_s + " " + ((user.lastName || "")).to_s)
puts("Email: " + (user.email).to_s)
puts("Global ID: " + (user.globalId).to_s)
```
## Common Workflows

### Create and inspect a workflow

```ruby
# 1. Create a simple workflow
wf = app.integrations.n8n.create_workflow(name: "Daily Report Generator", nodes: [{name: "Schedule Trigger", type: "n8n-nodes-base.scheduleTrigger", position: [250, 300], parameters: {rule: {interval: [{field: "hours", hoursInterval: 24}]}}}, {name: "HTTP Request", type: "n8n-nodes-base.httpRequest", position: [450, 300], parameters: {url: "https://api.example.com/report", method: "GET"}}], connections: {"Schedule Trigger" => {main: [[{node: "HTTP Request", type: "main", index: 0}]]}})
puts("Created workflow ID: " + (wf.id).to_s)
# 2. Retrieve the workflow to verify
fetched = app.integrations.n8n.get_workflow(workflow_id: (wf.id).to_s)
puts("Workflow has " + (fetched.nodes.length).to_s + " nodes")
```
### Monitor execution history

```ruby
executions = app.integrations.n8n.list_executions(workflow_id: "1234", limit: 10)
success_count = 0
error_count = 0
executions.data.each do |exec|
  if (exec.status == "success")
    success_count = (success_count + 1)
  else
    if (exec.status == "error")
      error_count = (error_count + 1)
    end
  end
end
puts("Recent executions: " + (success_count).to_s + " succeeded, " + (error_count).to_s + " failed")
```
### Inspect a failed execution

```ruby
executions = app.integrations.n8n.list_executions(status: "error", limit: 1)
if (executions.data.length > 0)
  latest_error = executions.data[0]
  exec = app.integrations.n8n.get_execution(execution_id: (latest_error.id).to_s)
  puts("Execution " + (exec.id).to_s + " failed")
  puts("Workflow: " + (exec.workflowId).to_s)
  puts("Started at: " + (exec.startedAt).to_s)
end
```
### List all credentials and their types

```ruby
creds = app.integrations.n8n.list_credentials()
types = {}
creds.data.each do |cred|
  t = cred.type
  types[t] = ((types[t] || 0) + 1)
end
types.to_a.each do |type_name, count|
  puts((type_name).to_s + ": " + (count).to_s + " credential(s)")
end
```
## Pagination

List endpoints use cursor-based pagination. When more results are available, the response includes a `nextCursor` field. Pass this as the `cursor` parameter in the next call to fetch the next page.

```ruby
all_workflows = []
cursor = nil
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  params = {limit: 100}
  if cursor
    params.cursor = cursor
  end
  result = app.integrations.n8n.list_workflows(params)
  result.data.each do |wf|
    all_workflows.push(wf)
  end
  cursor = result.nextCursor
  break unless (!(cursor == nil))
end
puts("Total workflows fetched: " + (all_workflows.length).to_s)
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

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
