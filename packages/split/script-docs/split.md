# Split — JavaScript API Reference

## list_splits

List feature splits in a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |
| `limit` | integer | no | Max splits to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```js
// List splits in default workspace
var result = app.integrations.split.list_splits({})

for (const split of (result.splits)) {
  console.log(split.name + " (" + split.trafficTypeName + ")")
}

// Paginated listing
var result = app.integrations.split.list_splits({
  limit: 50,
  offset: 0,
})

// Specific workspace
var result = app.integrations.split.list_splits({
  workspace_id: "abc123",
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

```js
var result = app.integrations.split.get_split({
  split_name: "new-checkout-flow",
})

console.log("Split: " + result.name)
console.log("Traffic Type: " + result.trafficTypeName)
console.log("Killed: " + String(result.killed))
console.log("Treatments: " + result.treatments.length)
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

```js
// Create a basic split
var result = app.integrations.split.create_split({
  name: "new-checkout-flow",
  traffic_type_name: "user",
})
console.log(result.message)

// Create with description
var result = app.integrations.split.create_split({
  name: "new-pricing-page",
  traffic_type_name: "user",
  description: "Controls the new pricing page rollout",
})
console.log(result.message)
```
---

## list_environments

List all environments for a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```js
var result = app.integrations.split.list_environments({})

for (const env of (result.environments)) {
  console.log(env.id + ": " + env.name + " (" + env.type + ")")
}
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

```js
var result = app.integrations.split.get_environment({
  environment_id: "env-123",
})

console.log("Environment: " + result.name)
console.log("Type: " + result.type)
console.log("Status: " + result.status)
```
---

## list_workspaces

List all Split workspaces.

### Parameters

This tool takes no parameters.

### Examples

```js
var result = app.integrations.split.list_workspaces({})

for (const ws of (result.workspaces)) {
  console.log(ws.id + ": " + ws.name)
}
```
---

## get_current_user

Get the currently authenticated Split user.

### Parameters

This tool takes no parameters.

### Examples

```js
var result = app.integrations.split.get_current_user({})

console.log("User: " + result.name)
console.log("Email: " + result.email)
console.log("Type: " + result.type)
```
---

## Multi-Account Usage

If you have multiple Split accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.split.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.split.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.split.production.function_name({ /* parameters */ })
app.integrations.split.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
