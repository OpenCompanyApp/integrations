# Metabase — JavaScript API Reference

## list_dashboards

List all dashboards available in Metabase.

### Parameters

None.

### Returns

```js
const example = {
  dashboards: [
    { id: 1, name: "Sales Overview"},
    { id: 2, name: "Marketing KPIs"},
  ],
  count: 2,
}
```
### Example

```js
var result = app.integrations.metabase.list_dashboards()

for (const db of (result.dashboards)) {
  console.log(db.id + ": " + db.name)
}
```
---

## get_dashboard

Get a single Metabase dashboard by ID, including all cards, layout, and parameters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The dashboard ID |

### Example

```js
var result = app.integrations.metabase.get_dashboard({ id: 1 })

console.log("Dashboard: " + result.name)
console.log("Cards: " + result.ordered_cards.length)

for (const item of (result.ordered_cards)) {
  var card = item.card
  if (card) {
    console.log("  Card " + card.id + ": " + card.name)
  }
}
```
---

## list_cards

List all cards (saved questions) in Metabase.

### Parameters

None.

### Returns

```js
const example = {
  cards: [
    { id: 10, name: "Revenue by Month", display: "bar"},
    { id: 11, name: "Active Users", display: "scalar"},
  ],
  count: 2,
}
```
### Example

```js
var result = app.integrations.metabase.list_cards()

for (const card of (result.cards)) {
  console.log(card.id + ": " + card.name + " (" + (card.display || "?") + ")")
}
```
---

## get_card

Get the full definition of a card (question) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The card (question) ID |

### Example

```js
var result = app.integrations.metabase.get_card({ id: 10 })

console.log("Name: " + result.name)
console.log("Display: " + result.display)
console.log("Database: " + (result.database_id || "unknown"))
```
---

## query_card

Execute a saved card (question) and return the query results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The card (question) ID to execute |

### Returns

```js
const example = {
  rows: [
    { month: "2026-01", revenue: 42000 },
    { month: "2026-02", revenue: 51000 },
  ],
  rowCount: 2,
  columns: [ "month", "revenue" ],
}
```
### Example

```js
var result = app.integrations.metabase.query_card({ id: 10 })

console.log("Columns: " + result.columns.join(", "))
console.log("Rows: " + result.rowCount)

for (const row of (result.rows)) {
  console.log(row.month + ": $" + row.revenue)
}
```
---

## list_databases

List all databases connected to Metabase.

### Parameters

None.

### Returns

```js
const example = {
  databases: [
    { id: 1, name: "Production DB", engine: "postgres"},
    { id: 2, name: "Analytics Warehouse", engine: "bigquery"},
  ],
  count: 2,
}
```
### Example

```js
var result = app.integrations.metabase.list_databases()

for (const db of (result.databases)) {
  console.log(db.id + ": " + db.name + " (" + db.engine + ")")
}
```
---

## get_database

Get detailed metadata for a database, including tables and fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The database ID |

### Example

```js
var result = app.integrations.metabase.get_database({ id: 1 })

console.log("Database: " + result.name)
console.log("Engine: " + result.engine)

for (const table of (result.tables || [])) {
  console.log("  Table: " + table.name + " (" + table.fields.length + " fields)")
  for (const field of (table.fields || [])) {
    console.log("    - " + field.name + " (" + field.base_type + ")")
  }
}
```
---

## get_current_user

Get the currently authenticated Metabase user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.metabase.get_current_user()

console.log("User: " + result.common_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Metabase instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.metabase.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.metabase.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.metabase.production.function_name({ /* parameters */ })
app.integrations.metabase.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
