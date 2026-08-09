# Railway — JavaScript API Reference

Railway tools use the public GraphQL API with a stored account or workspace bearer token. The integration returns normalized project, service, deployment, and user fields instead of raw GraphQL envelopes.

## list_projects

List all Railway projects the authenticated user has access to.

### Parameters

This tool takes no parameters.

### Examples

```js
var result = app.integrations.railway.list_projects({})

for (const project of (result.projects)) {
  console.log(project.id + ": " + project.name)
  if (project.description) {
    console.log("  Description: " + project.description)
  }
  if (project.team) {
    console.log("  Team: " + project.team)
  }
  console.log("  Public: " + String(project.is_public))
}
```
---

## get_project

Get detailed information about a specific Railway project, including environments and plugins.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Railway project ID |

### Examples

```js
var result = app.integrations.railway.get_project({
  project_id: "clx123abc456",
})

console.log("Project: " + result.name)
console.log("Description: " + (result.description || "N/A"))
console.log("Environments: " + result.environment_count)

for (const env of (result.environments)) {
  console.log("  " + env.name + " (ephemeral: " + String(env.is_ephemeral) + ")")
}

console.log("Plugins: " + result.plugin_count)
for (const plugin of (result.plugins)) {
  console.log("  " + plugin.name)
}
```
---

## create_project

Create a new Railway project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new project |
| `description` | string | no | An optional description for the project |

### Examples

```js
// Create a project with a name only
var result = app.integrations.railway.create_project({
  name: "My New App",
})
console.log(result.message)
console.log("Project ID: " + result.id)

// Create a project with a description
var result = app.integrations.railway.create_project({
  name: "My Backend Service",
  description: "Production backend API deployed on Railway",
})
console.log(result.message)
```
---

## list_services

List all services in a Railway project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Railway project ID |

### Examples

```js
var result = app.integrations.railway.list_services({
  project_id: "clx123abc456",
})

console.log("Services: " + result.count)
for (const service of (result.services)) {
  console.log("  " + service.id + ": " + service.name)
  if (service.repo_name) {
    console.log("    Repo: " + service.repo_name)
  }
}
```
---

## get_service

Get detailed information about a specific Railway service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The Railway service ID |

### Examples

```js
var result = app.integrations.railway.get_service({
  service_id: "clx789xyz012",
})

console.log("Service: " + result.name)
console.log("Forked: " + String(result.is_forked))

if (result.repo.full_name) {
  console.log("Repo: " + result.repo.full_name)
  console.log("Branch: " + (result.repo.branch || "default"))
}
```
---

## list_deployments

List deployments for a Railway service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The Railway service ID |
| `environment_id` | string | no | Filter deployments by environment ID |
| `limit` | integer | no | Max deployments to return (default: 20) |

### Examples

```js
// List recent deployments for a service
var result = app.integrations.railway.list_deployments({
  service_id: "clx789xyz012",
})

for (const dep of (result.deployments)) {
  console.log(dep.id + " [" + dep.status + "]")
  console.log("  Environment: " + (dep.environment || "N/A"))
  console.log("  Created: " + dep.created_at)
  if (dep.creator) {
    console.log("  By: " + dep.creator)
  }
}

// Filter by environment
var result = app.integrations.railway.list_deployments({
  service_id: "clx789xyz012",
  environment_id: "clxenv123",
  limit: 5,
})
```
---

## get_current_user

Get the currently authenticated Railway user.

### Parameters

This tool takes no parameters.

### Examples

```js
var result = app.integrations.railway.get_current_user({})

console.log("User: " + result.name)
console.log("Email: " + result.email)
console.log("Verified: " + String(result.is_verified))
```
---

## Multi-Account Usage

If you have multiple Railway accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.railway.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.railway.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.railway.work.function_name({ /* parameters */ })
app.integrations.railway.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
