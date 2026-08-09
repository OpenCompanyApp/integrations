# Rollbar — JavaScript API Reference

## list_projects

List all projects in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of projects to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```js
var result = app.integrations.rollbar.list_projects({
  limit: 50,
  offset: 0,
})

for (const project of (result.result.projects)) {
  console.log(project.id + ": " + project.name + " (status: " + project.status + ")")
}
```
---

## get_project

Get details for a specific Rollbar project by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```js
var result = app.integrations.rollbar.get_project({
  id: 12345,
})

var project = result.result
console.log("Project: " + project.name)
console.log("Status: " + project.status)
```
---

## list_items

List error items (occurrences) in Rollbar with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by project ID |
| `limit` | integer | no | Maximum number of items to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `level` | string | no | Filter by level: `debug`, `info`, `warning`, `error`, `critical` |
| `status` | string | no | Filter by status: `active`, `resolved`, `muted` |
| `environment` | string | no | Filter by environment name (e.g., `production`, `staging`) |

### Example

```js
// List active errors in production
var result = app.integrations.rollbar.list_items({
  status: "active",
  environment: "production",
  level: "error",
  limit: 10,
})

for (const item of (result.result.items)) {
  console.log(item.counter + ": " + item.title + " (level: " + item.level + ")")
}
```
---

## get_item

Get details for a specific Rollbar error item by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The item (counter) ID |

### Example

```js
var result = app.integrations.rollbar.get_item({
  id: 47,
})

var item = result.result
console.log("Title: " + item.title)
console.log("Level: " + item.level)
console.log("Status: " + item.status)
console.log("Occurrences: " + item.total_occurrences)
```
---

## list_deploys

List recent deploys across your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `environment` | string | no | Filter by environment name (e.g., `production`) |
| `limit` | integer | no | Maximum number of deploys to return (default: 20) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.rollbar.list_deploys({
  environment: "production",
  limit: 10,
  page: 1,
})

for (const deploy of (result.result.deploys)) {
  console.log(deploy.project_id + ": " + deploy.revision + " by " + deploy.username)
}
```
---

## list_teams

List all teams in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of teams to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```js
var result = app.integrations.rollbar.list_teams({
  limit: 50,
})

for (const team of (result.result.teams)) {
  console.log(team.id + ": " + team.name + " (access: " + team.access_level + ")")
}
```
---

## get_current_user

Get details about the currently authenticated Rollbar user. No parameters required.

### Example

```js
var result = app.integrations.rollbar.get_current_user({})

var user = result.result
console.log("User: " + user.username + " (" + user.email + ")")
```
---

## Multi-Account Usage

If you have multiple Rollbar accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.rollbar.list_projects({})

// Explicit default (portable across setups)
app.integrations.rollbar.default.list_projects({})

// Named accounts
app.integrations.rollbar.work.list_projects({})
app.integrations.rollbar.personal.list_projects({})
```
All functions are identical across accounts — only the credentials differ.
