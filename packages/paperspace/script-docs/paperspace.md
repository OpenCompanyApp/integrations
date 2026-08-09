# Paperspace — JavaScript API Reference

## list_machines

List all GPU machines in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.list_machines({})

for (const machine of (result)) {
  console.log(machine.name + " (" + machine.state + ") - " + machine.machineType)
}
```
---

## get_machine

Get details for a specific machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `machine_id` | string | yes | The machine ID |

### Example

```js
var result = app.integrations.paperspace.get_machine({ machine_id: "psabc123" })
var m = result
console.log(m.name + " - " + m.os + " - " + m.publicIp)
```
---

## list_notebooks

List all Gradient notebooks in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.list_notebooks({})

for (const notebook of (result)) {
  console.log(notebook.name + " (" + notebook.state + ")")
}
```
---

## list_datasets

List all datasets in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.list_datasets({})

for (const dataset of (result)) {
  console.log(dataset.name + " - " + (dataset.size || "unknown size"))
}
```
---

## list_projects

List all Gradient projects in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.list_projects({})

for (const project of (result)) {
  console.log(project.name + " - " + (project.description || "no description"))
}
```
---

## list_ssh_keys

List all SSH keys in the account.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.list_ssh_keys({})

for (const key of (result)) {
  console.log(key.name + " - " + key.fingerprint)
}
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```js
var result = app.integrations.paperspace.get_current_user({})
console.log("User: " + result.email + " (ID: " + result.id + ")")
```
---

## Multi-Account Usage

If you have multiple Paperspace accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.paperspace.list_machines({})

// Explicit default (portable across setups)
app.integrations.paperspace.default.list_machines({})

// Named accounts
app.integrations.paperspace.production.list_machines({})
app.integrations.paperspace.staging.list_machines({})
```
All functions are identical across accounts — only the credentials differ.
