# Contabo — JavaScript API Reference

## list_instances

List all compute instances (VPS) in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```js
var result = app.integrations.contabo.list_instances({
  per_page: 50,
})

for (const instance of (result.data)) {
  console.log(instance.name + " (" + instance.status + ") - " + instance.ipConfig.v4.ip)
}
```
---

## get_instance

Get details for a specific compute instance (VPS).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The instance ID |

### Example

```js
var result = app.integrations.contabo.get_instance({ id: 12345 })
var inst = result.data
console.log(inst.name + " - " + inst.region + " - " + inst.ipConfig.v4.ip)
```
---

## list_snapshots

List all snapshots in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```js
var result = app.integrations.contabo.list_snapshots({})

for (const snap of (result.data)) {
  console.log(snap.name + " - instance: " + snap.instanceId + " - " + snap.createdDate)
}
```
---

## list_images

List all custom images in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```js
var result = app.integrations.contabo.list_images({})

for (const image of (result.data)) {
  console.log(image.name + " - " + image.osType + " (" + image.sizeMb + " MB)")
}
```
---

## list_networks

List all private networks in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```js
var result = app.integrations.contabo.list_networks({})

for (const network of (result.data)) {
  console.log(network.name + " - " + network.region + " - " + network.cidr)
}
```
---

## list_ssh_keys

List all registered SSH keys in the Contabo account.

### Parameters

None.

### Example

```js
var result = app.integrations.contabo.list_ssh_keys({})

for (const key of (result.data)) {
  console.log(key.name + " - " + key.fingerPrint)
}
```
---

## get_current_user

Get the current authenticated Contabo account information.

### Parameters

None.

### Example

```js
var result = app.integrations.contabo.get_current_user({})
var user = result.data
console.log("Account: " + user.email + " (tenant: " + user.tenantId + ")")
```
---

## Multi-Account Usage

If you have multiple Contabo accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.contabo.list_instances({})

// Explicit default (portable across setups)
app.integrations.contabo.default.list_instances({})

// Named accounts
app.integrations.contabo.production.list_instances({})
app.integrations.contabo.staging.list_instances({})
```
All functions are identical across accounts — only the credentials differ.
