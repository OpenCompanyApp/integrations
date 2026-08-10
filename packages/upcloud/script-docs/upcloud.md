# UpCloud — JavaScript API Reference

## list_servers

List all cloud servers on the UpCloud account.

### Parameters

None.

### Examples

```js
// List all servers
var result = app.integrations.upcloud.list_servers({})

for (const server of (result.servers)) {
  console.log(server.uuid + ": " + server.title + " (" + server.state + ")")
}
```
---

## get_server

Get details for a specific UpCloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | The server UUID |

### Examples

```js
var result = app.integrations.upcloud.get_server({ uuid: "abc123-def456" })
console.log(result.server.title)
console.log(result.server.state)
console.log(result.server.vcpu)
console.log(result.server.memory_amount)
```
---

## list_storages

List storage devices on the UpCloud account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Storage type filter: "disk", "backup", or "cdrom" |

### Examples

```js
// List all storages
var result = app.integrations.upcloud.list_storages({})

// List only disk storages
var result = app.integrations.upcloud.list_storages({ type: "disk" })

for (const storage of (result.storages)) {
  console.log(storage.uuid + ": " + storage.title + " (" + storage.size + " GB)")
}
```
---

## list_networks

List private networks on the UpCloud account.

### Parameters

None.

### Examples

```js
var result = app.integrations.upcloud.list_networks({})

for (const network of (result.networks)) {
  console.log(network.uuid + ": " + network.name + " (" + network.zone + ")")
}
```
---

## list_ips

List IP addresses on the UpCloud account.

### Parameters

None.

### Examples

```js
var result = app.integrations.upcloud.list_ips({})

for (const ip of (result.ip_addresses)) {
  console.log(ip.address + " (" + ip.family + ") -> " + (ip.server || "unassigned"))
}
```
---

## list_zones

List available UpCloud zones (data centers).

### Parameters

None.

### Examples

```js
var result = app.integrations.upcloud.list_zones({})

for (const zone of (result.zones)) {
  console.log(zone.id + ": " + zone.description)
}
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```js
var result = app.integrations.upcloud.get_current_user({})
console.log("Logged in as: " + result.account.username)
```
---

## Multi-Account Usage

If you have multiple UpCloud accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.upcloud.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.upcloud.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.upcloud.production.function_name({ /* parameters */ })
app.integrations.upcloud.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
