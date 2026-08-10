# OVHcloud — JavaScript API Reference

## list_servers

List all dedicated servers in the OVH account.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.list_servers({})

for (const server of (result)) {
  console.log(server)
}
```
---

## get_server

Get details for a specific dedicated server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_name` | string | yes | The dedicated server service name (e.g., `"ns123456.ip-1-2-3.eu"`) |

### Example

```js
var result = app.integrations.ovh.get_server({ service_name: "ns123456.ip-1-2-3.eu" })
var s = result
console.log(s.name + " - " + s.os + " - " + s.datacenter)
```
---

## list_domains

List all domains in the OVH account.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.list_domains({})

for (const domain of (result)) {
  console.log(domain)
}
```
---

## list_vps

List all VPS instances in the OVH account.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.list_vps({})

for (const vps of (result)) {
  console.log(vps)
}
```
---

## list_ip

List all IP addresses in the OVH account.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.list_ip({})

for (const ip of (result)) {
  console.log(ip)
}
```
---

## list_projects

List all public cloud projects in the OVH account.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.list_projects({})

for (const project of (result)) {
  console.log(project)
}
```
---

## get_current_user

Get the current authenticated OVH account information.

### Parameters

None.

### Example

```js
var result = app.integrations.ovh.get_current_user({})
console.log("Account: " + result.nichandle + " (" + result.email + ")")
```
---

## Multi-Account Usage

If you have multiple OVH accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.ovh.list_servers({})

// Explicit default (portable across setups)
app.integrations.ovh.default.list_servers({})

// Named accounts
app.integrations.ovh.production.list_servers({})
app.integrations.ovh.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
