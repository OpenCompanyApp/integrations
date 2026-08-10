# IONOS Cloud — JavaScript API Reference

## list_servers

List all servers in the IONOS Cloud account.

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.list_servers({})

for (const server of (result.servers)) {
  console.log(server.properties.name + " (" + server.properties.vmState + ") - " + server.properties.cores + " cores")
}
```
---

## get_server

Get details for a specific server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | string | yes | The server ID |

### Example

```js
var result = app.integrations.ionos.get_server({ server_id: "abc123-def456" })
var s = result.properties
console.log(s.name + " - " + s.cores + " cores, " + s.ram + " MB RAM, state: " + s.vmState)
```
---

## list_volumes

List all block storage volumes.

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.list_volumes({})

for (const vol of (result.volumes)) {
  console.log(vol.properties.name + " - " + vol.properties.size + " GB (" + vol.properties.type + ")")
}
```
---

## list_lans

List all local area networks (LANs).

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.list_lans({})

for (const lan of (result.lans)) {
  console.log(lan.properties.name + " - public: " + String(lan.properties.public))
}
```
---

## list_nics

List all network interface cards (NICs).

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.list_nics({})

for (const nic of (result.nics)) {
  console.log(nic.properties.name + " - MAC: " + nic.properties.mac + ", IPs: " + nic.properties.ips.join(", "))
}
```
---

## list_images

List all available images.

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.list_images({})

for (const img of (result.images)) {
  console.log(img.properties.name + " - " + (img.properties.osType || "unknown") + " (" + img.properties.location + ")")
}
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```js
var result = app.integrations.ionos.get_current_user({})
var user = result.properties
console.log("User: " + (user.firstname || "") + " " + (user.lastname || "") + " <" + (user.email || "") + ">")
```
---

## Multi-Account Usage

If you have multiple IONOS Cloud accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.ionos.list_servers({})

// Explicit default (portable across setups)
app.integrations.ionos.default.list_servers({})

// Named accounts
app.integrations.ionos.production.list_servers({})
app.integrations.ionos.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
