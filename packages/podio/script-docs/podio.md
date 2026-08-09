# Podio — JavaScript API Reference

## list_spaces

List all workspaces (spaces) in a Podio organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | The Podio organization ID |

### Example

```js
var result = app.integrations.podio.list_spaces({
  org_id: 12345,
})

for (const space of (result.spaces)) {
  console.log(space.name + " (ID: " + space.space_id + ")")
}
```
---

## get_space

Get detailed information about a specific Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```js
var space = app.integrations.podio.get_space({
  space_id: 67890,
})

console.log("Space: " + space.name)
console.log("URL: " + space.url)
```
---

## list_apps

List all apps in a Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```js
var result = app.integrations.podio.list_apps({
  space_id: 67890,
})

for (const app of (result.apps)) {
  console.log(app.name + " (" + app.item_count + " items)")
}
```
---

## get_app

Get detailed information about a specific Podio app, including field definitions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |

### Example

```js
var app = app.integrations.podio.get_app({
  app_id: 11111,
})

console.log("App: " + app.name)
for (const field of (app.fields)) {
  console.log("  Field: " + field.external_id + " (" + field.type + ")")
}
```
---

## list_items

List and filter items in a Podio app with sorting and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |
| `limit` | integer | no | Max items to return (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `sort_by` | string | no | Field to sort by (e.g., `"created_on"`, `"title"`, or a field external ID) |
| `sort_desc` | boolean | no | Sort descending (default: true) |
| `filters` | string | no | JSON-encoded filter object (keys are field external IDs) |

### Example

```js
// List recent items
var result = app.integrations.podio.list_items({
  app_id: 11111,
  limit: 10,
  sort_by: "created_on",
  sort_desc: true,
})

for (const item of (result.items)) {
  console.log(item.title + " (ID: " + item.item_id + ")")
}

// Filter items by field value
var result = app.integrations.podio.list_items({
  app_id: 11111,
  filters: '{"status":"active"}',
  limit: 50,
})
```
---

## get_item

Get detailed information about a specific Podio item, including all field values.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The Podio item ID |

### Example

```js
var item = app.integrations.podio.get_item({
  item_id: 22222,
})

console.log("Item: " + item.title)
for (const field of (item.fields)) {
  console.log("  " + field.external_id + ": " + vim.inspect(field.values))
}
```
---

## get_current_user

Get the status of the currently authenticated Podio user.

### Parameters

None.

### Example

```js
var status = app.integrations.podio.get_current_user({})
console.log("Logged in as: " + status.profile.name)
```
---

## Multi-Account Usage

If you have multiple Podio accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.podio.list_spaces({ org_id: 12345 })

// Explicit default (portable across setups)
app.integrations.podio.default.list_spaces({ org_id: 12345 })

// Named accounts
app.integrations.podio.work.list_spaces({ org_id: 12345 })
app.integrations.podio.personal.list_spaces({ org_id: 67890 })
```
All functions are identical across accounts — only the credentials differ.
