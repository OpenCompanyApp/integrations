# Cloudways — JavaScript API Reference

## list_servers

List all servers in the Cloudways account.

### Parameters

None.

### Example

```js
var result = app.integrations.cloudways.list_servers({})

for (const server of (result.servers)) {
  console.log(server.label + " (" + server.status + ") - " + server.server_ips[0])
}
```
---

## get_server

Get details for a specific Cloudways server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID to look up |

### Example

```js
var result = app.integrations.cloudways.get_server({ server_id: 12345 })
var s = result.server
console.log(s.label + " - " + s.server_ips[0] + " - " + s.os)
```
---

## list_apps

List all applications across all servers in the Cloudways account.

### Parameters

None.

### Example

```js
var result = app.integrations.cloudways.list_apps({})

for (const app of (result.apps)) {
  console.log(app.label + " (" + app.application + ") on server " + app.server_id)
}
```
---

## get_app

Get details for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to look up |

### Example

```js
var result = app.integrations.cloudways.get_app({ server_id: 12345, app_id: 67890 })
var a = result.app
console.log(a.label + " - " + a.application + " - " + a.app_fqdn)
```
---

## list_domains

List domains for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to list domains for |

### Example

```js
var result = app.integrations.cloudways.list_domains({ server_id: 12345, app_id: 67890 })

for (const domain of (result.domains)) {
  console.log(domain.fqdn + " - primary: " + String(domain.is_primary))
}
```
---

## list_projects

List all projects in the Cloudways account.

### Parameters

None.

### Example

```js
var result = app.integrations.cloudways.list_projects({})

for (const project of (result.projects)) {
  console.log(project.name + " (ID: " + project.id + ")")
}
```
---

## get_current_user

Get the current authenticated Cloudways account information.

### Parameters

None.

### Example

```js
var result = app.integrations.cloudways.get_current_user({})
console.log("Account: " + result.me.email + " (" + result.me.name + ")")
```
---

## Multi-Account Usage

If you have multiple Cloudways accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.cloudways.list_servers({})

// Explicit default (portable across setups)
app.integrations.cloudways.default.list_servers({})

// Named accounts
app.integrations.cloudways.production.list_servers({})
app.integrations.cloudways.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
