# Client for the IFTTT REST API — JavaScript API Reference

## ifttt_list_services

List services in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of services to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```js
var result = app.integrations.ifttt.ifttt_list_services({
  limit: 50,
  page: 1,
})
```
## ifttt_get_service

Get detailed information about an IFTTT service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The service ID. |

### Example

```js
var result = app.integrations.ifttt.ifttt_get_service({
  id: "",
})
```
## ifttt_list_applets

List applets in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of applets to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```js
var result = app.integrations.ifttt.ifttt_list_applets({
  limit: 50,
  page: 1,
})
```
## ifttt_get_applet

Get detailed information about an IFTTT applet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The applet ID. |

### Example

```js
var result = app.integrations.ifttt.ifttt_get_applet({
  id: "",
})
```
## ifttt_list_connections

List connections in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of connections to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```js
var result = app.integrations.ifttt.ifttt_list_connections({
  limit: 50,
  page: 1,
})
```
## ifttt_get_connection

Get detailed information about an IFTTT connection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The connection ID. |

### Example

```js
var result = app.integrations.ifttt.ifttt_get_connection({
  id: "",
})
```
## ifttt_get_current_user

Get the currently authenticated IFTTT user.

### Example

```js
var result = app.integrations.ifttt.ifttt_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple ifttt accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.ifttt.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.ifttt.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.ifttt.work.function_name({ /* parameters */ })
app.integrations.ifttt.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
