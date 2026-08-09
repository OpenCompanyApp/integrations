# Modal — JavaScript API Reference

Modal is a serverless GPU platform for running AI and compute workloads in the cloud. This integration lets you list apps, get app details, browse functions and schedules, and manage volumes and secrets — all from JavaScript programs.

## Authentication

Uses a **Modal API Key** (Bearer token). Configure it in your integration settings. The key authenticates via the Modal REST API at `https://api.modal.com/v1`. API keys are scoped to the user or workspace that created them — the integration can only access resources within that scope.

---

## Overview

All tools are called via `app.integrations.modal.<tool_name>({ ... })`. Every function takes a single JavaScript object of named parameters and returns a result table.

```js
var result = app.integrations.modal.get_app({ app_id: "ap-abc123" })
```
Errors surface as `result.error` (string). Check for it before using the response.

```js
if (result.error) {
  console.log("Error: " + result.error)
  return
}
```
---

## list_apps

List all Modal apps in the workspace. Returns app IDs, names, and status details.

### Parameters

None.

### Example

```js
var result = app.integrations.modal.list_apps({})

if (result.error) {
  console.log("Error: " + result.error)
} else {
  for (const app of (result)) {
    console.log(app.name + " - " + app.status + " (" + app.app_id + ")")
  }
}
```
---

## get_app

Get details for a specific Modal app by ID, including status and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app. |

### Example

```js
var result = app.integrations.modal.get_app({ app_id: "ap-abc123" })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log(result.name + " - " + result.status)
}
```
---

## list_functions

List all functions for a Modal app. Returns function IDs, names, and runtime details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list functions for. |

### Example

```js
var result = app.integrations.modal.list_functions({ app_id: "ap-abc123" })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  for (const fn of (result)) {
    console.log(fn.name + " - " + (fn.runtime || "unknown"))
  }
}
```
---

## list_schedules

List all scheduled functions for a Modal app. Returns schedule IDs, cron expressions, and associated function details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list schedules for. |

### Example

```js
var result = app.integrations.modal.list_schedules({ app_id: "ap-abc123" })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  for (const sched of (result)) {
    console.log(sched.function_name + " - cron: " + (sched.cron || "N/A"))
  }
}
```
---

## list_volumes

List all Modal volumes. Returns volume IDs, names, and size details.

### Parameters

None.

### Example

```js
var result = app.integrations.modal.list_volumes({})

if (result.error) {
  console.log("Error: " + result.error)
} else {
  for (const vol of (result)) {
    console.log(vol.name + " - " + (vol.size_gb || "?") + " GB")
  }
}
```
---

## list_secrets

List all Modal secrets. Returns secret names and creation dates. Secret values are never exposed.

### Parameters

None.

### Example

```js
var result = app.integrations.modal.list_secrets({})

if (result.error) {
  console.log("Error: " + result.error)
} else {
  for (const secret of (result)) {
    console.log(secret.name + " - created: " + (secret.created_at || "unknown"))
  }
}
```
---

## get_current_user

Get the current authenticated Modal user information, including name, email, and account details.

### Parameters

None.

### Example

```js
var result = app.integrations.modal.get_current_user({})

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log("User: " + (result.name || result.email || "unknown"))
}
```
---

## Multi-Account Usage

If you have multiple Modal accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.modal.list_apps({})

// Explicit default (portable across setups)
app.integrations.modal.default.list_apps({})

// Named accounts
app.integrations.modal.production.list_apps({})
app.integrations.modal.staging.list_apps({})
```
All functions are identical across accounts — only the credentials differ.
