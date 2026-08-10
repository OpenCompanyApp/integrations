# PlanetScale — JavaScript API Reference

## list_databases

List databases in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```js
var result = app.integrations.planetscale.list_databases({
  organization: "my-org",
  page: 1,
  limit: 10,
})

for (const db of (result.data)) {
  console.log(db.name + ": " + db.state)
}
```
---

## get_database

Get details of a specific PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |

### Example

```js
var result = app.integrations.planetscale.get_database({
  organization: "my-org",
  database: "my-database",
})

console.log("State: " + result.state)
console.log("Region: " + result.region.slug)
console.log("Branches: " + result.branches)
```
---

## create_database

Create a new database in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `name` | string | yes | The database name (lowercase, hyphens allowed) |
| `region` | string | no | The region slug (e.g., "us-east-1") |
| `notes` | string | no | Optional notes about the database |

### Example

```js
var result = app.integrations.planetscale.create_database({
  organization: "my-org",
  name: "my-new-database",
  region: "us-east-1",
  notes: "Production database for project X",
})

console.log("Created: " + result.name)
console.log("State: " + result.state)
```
---

## list_branches

List branches of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```js
var result = app.integrations.planetscale.list_branches({
  organization: "my-org",
  database: "my-database",
})

for (const branch of (result.data)) {
  console.log(branch.name + " (" + branch.role + ")")
}
```
---

## get_branch

Get details of a specific branch of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `branch` | string | yes | The branch name |

### Example

```js
var result = app.integrations.planetscale.get_branch({
  organization: "my-org",
  database: "my-database",
  branch: "main",
})

console.log("Role: " + result.role)
console.log("Ready: " + String(result.ready))
console.log("Region: " + result.region.slug)
```
---

## list_organizations

List organizations the authenticated user belongs to.

### Parameters

None.

### Example

```js
var result = app.integrations.planetscale.list_organizations({})

for (const org of (result.data)) {
  console.log(org.name + " (" + org.slug + ")")
}
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```js
var result = app.integrations.planetscale.get_current_user({})
console.log("User: " + (result.first_name || "") + " " + (result.last_name || ""))
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple PlanetScale accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.planetscale.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.planetscale.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.planetscale.production.function_name({ /* parameters */ })
app.integrations.planetscale.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
