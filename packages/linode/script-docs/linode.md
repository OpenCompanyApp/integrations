# Linode — JavaScript API Reference

## list_instances

List all Linode instances (virtual machines) in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 100, max: 500) |

### Example

```js
var result = app.integrations.linode.list_instances({
  per_page: 50,
})

for (const instance of (result.data)) {
  console.log(instance.label + " (" + instance.status + ") - " + instance.type)
}
```
---

## get_instance

Get details for a specific Linode instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Linode instance ID |

### Example

```js
var result = app.integrations.linode.get_instance({ id: 12345678 })
var i = result
console.log(i.label + " - " + i.region + " - " + i.specs.vcpus + " vCPUs, " + i.specs.memory + " MB RAM")
```
---

## list_volumes

List all block storage volumes in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.linode.list_volumes({})

for (const volume of (result.data)) {
  console.log(volume.label + " (" + volume.size + " GB) - " + volume.status)
}
```
---

## list_domains

List all DNS domains in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.linode.list_domains({})

for (const domain of (result.data)) {
  console.log(domain.domain + " (status: " + domain.status + ")")
}
```
---

## get_domain

Get details for a specific DNS domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The domain ID |

### Example

```js
var result = app.integrations.linode.get_domain({ id: 12345 })
console.log(result.domain + " - SOA email: " + result.soa_email)
```
---

## list_stackscripts

List all StackScripts (reusable deployment scripts).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```js
var result = app.integrations.linode.list_stackscripts({})

for (const script of (result.data)) {
  console.log(script.label + " (deployments: " + script.deployments_total + ")")
}
```
---

## get_current_user

Get the current authenticated user profile information.

### Parameters

None.

### Example

```js
var result = app.integrations.linode.get_current_user({})
console.log("User: " + result.username + " (" + result.email + ")")
```
---

## Multi-Account Usage

If you have multiple Linode accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.linode.list_instances({})

// Explicit default (portable across setups)
app.integrations.linode.default.list_instances({})

// Named accounts
app.integrations.linode.production.list_instances({})
app.integrations.linode.staging.list_instances({})
```
All functions are identical across accounts — only the credentials differ.
