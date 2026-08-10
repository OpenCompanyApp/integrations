# Kamatera — JavaScript API Reference

## list_servers

List all cloud servers in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.kamatera.list_servers({})

for (const server of (result.servers)) {
  console.log(server.name + " (" + server.status + ") - " + server.cpu + " CPU / " + server.ram + " MB RAM")
}
```
---

## get_server

Get details for a specific cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The server ID |

### Example

```js
var result = app.integrations.kamatera.get_server({ id: "server-abc123" })
var s = result.server
console.log(s.name + " - " + s.datacenter + " - " + s.image + " - " + s.status)
```
---

## create_server

Create a new cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The server name |
| `datacenter` | string | yes | The datacenter ID (e.g. "IL-JER") |
| `image` | string | yes | The image ID or OS name |
| `cpu` | integer | yes | Number of vCPUs |
| `ram` | integer | yes | RAM in MB |
| `disk` | integer | yes | Disk size in GB |
| `password` | string | no | Root password (auto-generated if omitted) |
| `network` | string | no | Network ID to attach the server to |
| `quantity` | integer | no | Number of servers to create |

### Example

```js
var result = app.integrations.kamatera.create_server({
  name: "web-server-01",
  datacenter: "IL-JER",
  image: "ubuntu_22.04",
  cpu: 2,
  ram: 4096,
  disk: 50,
})

console.log("Server created: " + result.id)
```
---

## list_networks

List all networks in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.kamatera.list_networks({})

for (const network of (result.networks)) {
  console.log(network.id + " - " + network.name + " - " + network.cidr + " (" + network.datacenter + ")")
}
```
---

## list_images

List all available images for server creation.

### Parameters

None.

### Example

```js
var result = app.integrations.kamatera.list_images({})

for (const image of (result.images)) {
  console.log(image.id + " - " + image.name + " - " + image.os)
}
```
---

## list_datacenters

List all available datacenter locations.

### Parameters

None.

### Example

```js
var result = app.integrations.kamatera.list_datacenters({})

for (const dc of (result.datacenters)) {
  console.log(dc.id + " - " + dc.name + ", " + dc.country)
}
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```js
var result = app.integrations.kamatera.get_current_user({})
console.log("Account: " + (result.account.email || result.user.email))
```
---

## Multi-Account Usage

If you have multiple Kamatera accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.kamatera.list_servers({})

// Explicit default (portable across setups)
app.integrations.kamatera.default.list_servers({})

// Named accounts
app.integrations.kamatera.production.list_servers({})
app.integrations.kamatera.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
