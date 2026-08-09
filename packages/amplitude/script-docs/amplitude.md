# Amplitude Analytics — JavaScript API Reference

## list_events

List events from Amplitude, optionally filtered by user, device, or time range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no | Filter by Amplitude user ID |
| `device_id` | string | no | Filter by device ID |
| `start` | string | no | Start timestamp (ISO 8601 or milliseconds epoch) |
| `end` | string | no | End timestamp (ISO 8601 or milliseconds epoch) |
| `limit` | integer | no | Maximum number of events to return (default: 1000) |

### Examples

```js
// Get recent events for a user
var result = app.integrations.amplitude.list_events({
  user_id: "user_123",
  limit: 50,
})

for (const event of (result.events || [])) {
  console.log(event.event_type + " at " + event.server_received_time)
}
```
```js
// Get events in a time range
var result = app.integrations.amplitude.list_events({
  start: "2025-01-01T00:00:00Z",
  end: "2025-01-31T23:59:59Z",
  limit: 100,
})
```
---

## get_event

Retrieve a single event by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude event ID |

### Example

```js
var result = app.integrations.amplitude.get_event({
  id: "12345",
})

console.log("Event: " + result.event_type)
console.log("User: " + result.user_id)
```
---

## list_funnels

List funnels configured in the Amplitude project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by Amplitude project ID |
| `limit` | integer | no | Maximum number of funnels to return (default: 100) |

### Example

```js
var result = app.integrations.amplitude.list_funnels({
  limit: 20,
})

for (const funnel of (result.funnels || result.data || [])) {
  console.log("Funnel: " + (funnel.name || funnel.id) + " — conversion: " + String(funnel.conversion_rate || "N/A"))
}
```
---

## get_funnel

Retrieve a single funnel by its ID with conversion metrics and step details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude funnel ID |

### Example

```js
var result = app.integrations.amplitude.get_funnel({
  id: "42",
})

console.log("Funnel: " + result.name)
for (const step of (result.steps || [])) {
  console.log("  Step: " + step.event_type + " — " + String(step.count) + " users")
}
```
---

## list_cohorts

List behavioral cohorts in the Amplitude project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by Amplitude project ID |
| `limit` | integer | no | Maximum number of cohorts to return (default: 100) |

### Example

```js
var result = app.integrations.amplitude.list_cohorts({
  limit: 20,
})

for (const cohort of (result.cohorts || result.data || [])) {
  console.log("Cohort: " + (cohort.name || cohort.id) + " — size: " + String(cohort.size || "N/A"))
}
```
---

## get_cohort

Retrieve a single cohort by its ID with membership and behavioral criteria.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude cohort ID |

### Example

```js
var result = app.integrations.amplitude.get_cohort({
  id: "7",
})

console.log("Cohort: " + result.name)
console.log("Members: " + String(result.size || result.count || "N/A"))
```
---

## get_current_user

Get the currently authenticated Amplitude user (caller identity).

### Parameters

None.

### Example

```js
var result = app.integrations.amplitude.get_current_user({})

console.log("Logged in as: " + (result.name || result.email || "unknown"))
console.log("Role: " + (result.role || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Amplitude accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.amplitude.list_events({user_id: "user_123"})

// Explicit default (portable across setups)
app.integrations.amplitude.default.list_events({user_id: "user_123"})

// Named accounts
app.integrations.amplitude.production.list_events({user_id: "user_123"})
app.integrations.amplitude.staging.list_events({user_id: "user_123"})
```
All functions are identical across accounts — only the credentials differ.
