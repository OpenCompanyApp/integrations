# Mixpanel Analytics — JavaScript API Reference

## list_events

List events from Mixpanel, optionally filtered by type, unit, or date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Event type: `"general"` or `"unique"` (default: `"general"`) |
| `unit` | string | no | Time unit: `"hour"`, `"day"`, `"week"`, `"month"` (default: `"day"`) |
| `from` | string | no | Start date in YYYY-MM-DD format |
| `to` | string | no | End date in YYYY-MM-DD format |
| `limit` | integer | no | Maximum number of events to return (default: 100) |

### Examples

```js
// Get recent events
var result = app.integrations.mixpanel.list_events({
  limit: 50,
})

for (const [name, data] of Object.entries(result.data || {})) {
  console.log("Event: " + name)
}
```
```js
// Get events in a date range
var result = app.integrations.mixpanel.list_events({
  from: "2025-01-01",
  to: "2025-01-31",
  unit: "day",
  limit: 100,
})
```
---

## get_event

Retrieve analytics data for a specific event by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The event name to retrieve data for |
| `type` | string | no | Event type: `"general"` or `"unique"` (default: `"general"`) |
| `unit` | string | no | Time unit: `"hour"`, `"day"`, `"week"`, `"month"` (default: `"day"`) |
| `from` | string | no | Start date in YYYY-MM-DD format |
| `to` | string | no | End date in YYYY-MM-DD format |

### Example

```js
var result = app.integrations.mixpanel.get_event({
  name: "Page View",
  from: "2025-01-01",
  to: "2025-01-31",
})

for (const [date, count] of Object.entries(result.data || {})) {
  console.log("Date: " + date + " — Count: " + String(count))
}
```
---

## list_funnels

List all funnels configured in the Mixpanel project.

### Parameters

None.

### Example

```js
var result = app.integrations.mixpanel.list_funnels({})

for (const funnel of (result.data || [])) {
  console.log("Funnel: " + funnel.name + " (ID: " + String(funnel.id) + ")")
}
```
---

## get_funnel

Retrieve detailed conversion data for a Mixpanel funnel by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel funnel ID |

### Example

```js
var result = app.integrations.mixpanel.get_funnel({
  id: "12345",
})

console.log("Funnel: " + (result.data.name || "unknown"))
for (const step of (result.data.steps || [])) {
  console.log("  Step: " + step.event + " — Conversion: " + String(step.conversion_ratio))
}
```
---

## list_cohorts

List all behavioral cohorts in the Mixpanel project.

### Parameters

None.

### Example

```js
var result = app.integrations.mixpanel.list_cohorts({})

for (const cohort of (result.data || [])) {
  console.log("Cohort: " + cohort.name + " (ID: " + String(cohort.id) + ")")
}
```
---

## get_cohort

Retrieve detailed information for a Mixpanel cohort by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel cohort ID |

### Example

```js
var result = app.integrations.mixpanel.get_cohort({
  id: "67890",
})

console.log("Cohort: " + (result.data.name || "unknown"))
console.log("Count: " + String(result.data.count || 0))
```
---

## get_current_user

Get the currently authenticated Mixpanel user (caller identity).

### Parameters

None.

### Example

```js
var result = app.integrations.mixpanel.get_current_user({})

console.log("Logged in as: " + (result.name || result.email || "unknown"))
console.log("Role: " + (result.role || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Mixpanel accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mixpanel.list_events({limit: 50})

// Explicit default (portable across setups)
app.integrations.mixpanel.default.list_events({limit: 50})

// Named accounts
app.integrations.mixpanel.production.list_events({limit: 50})
app.integrations.mixpanel.staging.list_events({limit: 50})
```
All functions are identical across accounts — only the credentials differ.
