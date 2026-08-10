# Terraform Cloud — JavaScript API Reference

## list_workspaces

List workspaces in a Terraform Cloud organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name to list workspaces for |
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 100 (default: 20) |

### Examples

```js
// List workspaces for an organization
var result = app.integrations.terraform.list_workspaces({
  organization: "my-org",
})

for (const ws of (result.data)) {
  console.log(ws.attributes.name + " — " + ws.attributes["terraform-version"])
}

// Paginate through workspaces
var result = app.integrations.terraform.list_workspaces({
  organization: "my-org",
  pageNumber: 2,
  pageSize: 50,
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

```js
var result = app.integrations.terraform.get_workspace({
  workspaceId: "ws-abc123xyz456",
})

var ws = result.data.attributes
console.log("Workspace: " + ws.name)
console.log("Terraform version: " + ws["terraform-version"])
console.log("Locked: " + String(ws.locked))
console.log("Working directory: " + (ws["working-directory"] || "default"))
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

```js
var result = app.integrations.terraform.list_runs({
  workspaceId: "ws-abc123xyz456",
})

for (const run of (result.data)) {
  console.log(run.id + " — status: " + run.attributes.status)
}
```
---

## get_run

Get details of a specific Terraform Cloud run by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `runId` | string | yes | The run ID (starts with "run-") |

### Example

```js
var result = app.integrations.terraform.get_run({
  runId: "run-abc123xyz456",
})

var run = result.data.attributes
console.log("Status: " + run.status)
console.log("Trigger: " + run["trigger-reason"])
console.log("Created: " + run["created-at"])
```
---

## list_variables

List variables for a Terraform Cloud workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID to list variables for (starts with "ws-") |

### Example

```js
var result = app.integrations.terraform.list_variables({
  workspaceId: "ws-abc123xyz456",
})

for (const v of (result.data)) {
  var attrs = v.attributes
  console.log(attrs.key + " = " + (attrs.sensitive && "***" || String(attrs.value)))
  console.log("  category: " + attrs.category + ", sensitive: " + String(attrs.sensitive))
}
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

```js
// List organizations
var result = app.integrations.terraform.list_organizations({})

for (const org of (result.data)) {
  console.log(org.attributes.name + " — " + (org.attributes["external-id"] || ""))
}

// Paginate
var result = app.integrations.terraform.list_organizations({
  pageNumber: 2,
  pageSize: 10,
})
```
---

## get_current_user

Get the currently authenticated Terraform Cloud user. Useful for verifying authentication.

### Parameters

None.

### Example

```js
var result = app.integrations.terraform.get_current_user({})

console.log("Username: " + result.data.attributes.username)
console.log("Email: " + (result.data.attributes.email || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Terraform Cloud accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.terraform.list_organizations({})

// Explicit default (portable across setups)
app.integrations.terraform.default.list_organizations({})

// Named accounts
app.integrations.terraform.production.list_workspaces({
  organization: "prod-org",
})
app.integrations.terraform.staging.list_workspaces({
  organization: "staging-org",
})
```
All functions are identical across accounts — only the credentials differ.
