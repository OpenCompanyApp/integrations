# Bubble - JavaScript API Reference

Namespace: `app.integrations.bubble`

This integration wraps Bubble's built-in API. The normal production API root is `/api/1.1`; use `/version-test/api/1.1` for development mode. Bubble exposes two API surfaces: the Data API for database records and the Workflow API for exposed backend workflows. Privacy rules and API settings still apply.

## Discovery

Use the Swagger specification to discover the exact Data API data types and Workflow API paths enabled for the app:

```js
var swagger = app.integrations.bubble.get_swagger({})
```
## Data API

List records with Bubble constraints, pagination, and sorting:

```js
var result = app.integrations.bubble.list_records({
  type: "User",
  constraints: [
    { key: "email", constraint_type: "contains", value: "@example.test" }
  ],
  limit: 50,
  cursor: 0,
  sort_field: "Created Date",
  descending: true,
})
```
Record operations:

```js
var record = app.integrations.bubble.get_record({
  type: "Product",
  id: "1704982345123x456789",
})

var created = app.integrations.bubble.create_record({
  type: "Product",
  fields: { name: "Example", price: 100 },
})

var patched = app.integrations.bubble.update_record({
  type: "Product",
  id: "1704982345123x456789",
  fields: { price: 120 },
})

var replaced = app.integrations.bubble.replace_record({
  type: "Product",
  id: "1704982345123x456789",
  fields: { name: "Example", price: 120 },
})

app.integrations.bubble.delete_record({
  type: "Product",
  id: "1704982345123x456789",
})
```
`update_record` uses PATCH and changes only supplied fields. `replace_record` uses PUT and should be treated as a full replacement payload.

## Workflow API

Trigger a Bubble backend API workflow with POST:

```js
var response = app.integrations.bubble.trigger_workflow({
  workflow: "sync_order",
  payload: {
    order_id: "ord_123",
    status: "paid",
  }
})
```
Initialize a POST workflow while Bubble's Detect data popup is open:

```js
app.integrations.bubble.trigger_workflow({
  workflow: "sync_order",
  initialize: true,
  payload: {
    order_id: "ord_123",
    status: "paid",
  }
})
```
Trigger a workflow configured for GET/querystring parameters:

```js
var response = app.integrations.bubble.trigger_workflow_get({
  workflow: "status_check",
  params: {
    order_id: "ord_123",
  }
})
```
Workflow API endpoint names and parameters are app-specific. Use `get_swagger` or the Bubble editor's backend workflow settings to confirm the endpoint name before calling it.

## Multi-Account Usage

```js
app.integrations.bubble.list_records({ type: "User" })
app.integrations.bubble.default.list_records({ type: "User" })
app.integrations.bubble.production.trigger_workflow({ workflow: "sync_order", payload: {} })
```
Named account namespaces use the same tools with different stored credentials.
