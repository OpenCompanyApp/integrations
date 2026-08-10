# Fly.io — JavaScript API Reference

## list_apps

List all Fly.io apps in the organization.

### Parameters

None.

### Example

```js
var result = app.integrations["fly-io"].list_apps({})

for (const app of (result)) {
  console.log(app.name + " - " + app.status + " (" + app.organization + ")")
}
```
---

## get_app

Get details for a specific Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```js
var result = app.integrations["fly-io"].get_app({ app_name: "my-app" })
console.log(result.name + " - " + result.status)
```
---

## create_app

Create a new Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The desired name for the new app |
| `org_slug` | string | no | The organization slug (uses default org if omitted) |

### Example

```js
var result = app.integrations["fly-io"].create_app({
  app_name: "my-new-app",
  org_slug: "personal",
})
console.log("Created app: " + result.name)
```
---

## list_machines

List all machines for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```js
var result = app.integrations["fly-io"].list_machines({ app_name: "my-app" })

for (const machine of (result)) {
  console.log(machine.id + " - " + machine.state + " - " + machine.region)
}
```
---

## get_machine

Get details for a specific Fly.io machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |
| `machine_id` | string | yes | The machine ID |

### Example

```js
var result = app.integrations["fly-io"].get_machine({
  app_name: "my-app",
  machine_id: "73d8d46dbee589",
})
console.log(result.id + " - state: " + result.state + " - region: " + result.region)
```
---

## list_volumes

List all persistent volumes for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```js
var result = app.integrations["fly-io"].list_volumes({ app_name: "my-app" })

for (const vol of (result)) {
  console.log(vol.id + " - " + vol.name + " - " + vol.size_gb + "GB - " + vol.region)
}
```
---

## Multi-Account Usage

If you have multiple Fly.io accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["fly-io"].list_apps({})

// Explicit default (portable across setups)
app.integrations["fly-io"].default.list_apps({})

// Named accounts
app.integrations["fly-io"].production.list_apps({})
app.integrations["fly-io"].staging.list_apps({})
```
All functions are identical across accounts — only the credentials differ.
