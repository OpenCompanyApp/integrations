# Scaleway — JavaScript API Reference

## list_servers

List all servers in the Scaleway zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```js
var result = app.integrations.scaleway.list_servers({
  per_page: 50,
})

for (const server of (result.servers)) {
  console.log(server.name + " (" + server.state + ") - " + server.commercial_type)
}
```
---

## get_server

Get details for a specific server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | string | yes | The server ID (UUID) |

### Example

```js
var result = app.integrations.scaleway.get_server({ server_id: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" })
var s = result.server
console.log(s.name + " - " + s.state + " - " + (s.public_ip && s.public_ip.address || "no public IP"))
```
---

## list_volumes

List all block storage volumes in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.scaleway.list_volumes({})

for (const volume of (result.volumes)) {
  console.log(volume.name + " - " + volume.size + " bytes - " + volume.volume_type)
}
```
---

## list_snapshots

List all volume snapshots in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.scaleway.list_snapshots({})

for (const snapshot of (result.snapshots)) {
  console.log(snapshot.name + " - " + snapshot.size + " bytes - " + snapshot.state)
}
```
---

## list_security_groups

List all security groups (firewall rule sets) in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.scaleway.list_security_groups({})

for (const sg of (result.security_groups)) {
  console.log(sg.name + " - " + (sg.description || "no description"))
}
```
---

## list_ips

List all flexible IPs in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.scaleway.list_ips({})

for (const ip of (result.ips)) {
  console.log(ip.address + " - " + (ip.server && ip.server.name || "unassigned"))
}
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```js
var result = app.integrations.scaleway.get_current_user({})
console.log("Account: " + result.email + " (" + result.id + ")")
```
---

## Multi-Account Usage

If you have multiple Scaleway accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.scaleway.list_servers({})

// Explicit default (portable across setups)
app.integrations.scaleway.default.list_servers({})

// Named accounts
app.integrations.scaleway.production.list_servers({})
app.integrations.scaleway.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
