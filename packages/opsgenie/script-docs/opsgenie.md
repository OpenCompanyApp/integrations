# Opsgenie — JavaScript API Reference

## list_alerts

List Opsgenie alerts with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query (e.g., `"status:open AND priority:P1"`) |
| `limit` | integer | no | Max results to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |
| `sort` | string | no | Sort field (e.g., `"createdAt"`, `"updatedAt"`) |
| `order` | string | no | Sort order: `"asc"` or `"desc"` (default: `"desc"`) |

### Example

```js
var result = app.integrations.opsgenie.list_alerts({
  query: "status:open",
  limit: 10,
})

for (const alert of (result.data || [])) {
  console.log(alert.id + ": " + alert.message + " [" + alert.priority + "]")
}
```
---

## get_alert

Get full details of a specific Opsgenie alert.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `alert_id` | string | yes | The Opsgenie alert ID |

### Example

```js
var result = app.integrations.opsgenie.get_alert({
  alert_id: "abc123-def456",
})

console.log("Message: " + result.data.message)
console.log("Status: " + result.data.status)
console.log("Priority: " + result.data.priority)
```
---

## create_alert

Create a new Opsgenie alert.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message` | string | yes | Alert message text |
| `alias` | string | no | Client-defined identifier (for deduplication) |
| `description` | string | no | Detailed description |
| `priority` | string | no | Priority: `"P1"`, `"P2"`, `"P3"`, `"P4"`, or `"P5"` (default: `"P3"`) |
| `teams` | array | no | Team names to route to (e.g., `{"ops", "engineering"}`) |
| `visibleTo` | array | no | Teams/users visible to (no notifications) |
| `actions` | array | no | Custom actions (e.g., `{"Restart", "ScaleUp"}`) |
| `tags` | array | no | Tags (e.g., `{"production", "critical"}`) |
| `details` | object | no | Key-value map of extra details |
| `entity` | string | no | Domain of the alert |
| `source` | string | no | Source (e.g., `"monitoring"`) |
| `user` | string | no | Display name of the request owner |
| `note` | string | no | Additional note |

### Example

```js
var result = app.integrations.opsgenie.create_alert({
  message: "Production database CPU above 95%",
  priority: "P1",
  description: "CPU utilization has exceeded 95% for the last 10 minutes on db-primary-01.",
  teams: ["ops", "backend"],
  tags: ["production", "database", "critical"],
  actions: ["Restart Database", "Scale Up"],
  source: "monitoring",
})

console.log("Alert created: " + (result.requestId || "ok"))
```
---

## list_incidents

List Opsgenie incidents with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query (e.g., `"status:open AND priority:P1"`) |
| `limit` | integer | no | Max results to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |
| `sort` | string | no | Sort field (e.g., `"createdAt"`, `"updatedAt"`) |
| `order` | string | no | Sort order: `"asc"` or `"desc"` (default: `"desc"`) |

### Example

```js
var result = app.integrations.opsgenie.list_incidents({
  query: "status:open",
  limit: 10,
})

for (const incident of (result.data || [])) {
  console.log(incident.id + ": " + incident.message + " [" + incident.status + "]")
}
```
---

## get_incident

Get full details of a specific Opsgenie incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `incident_id` | string | yes | The Opsgenie incident ID |

### Example

```js
var result = app.integrations.opsgenie.get_incident({
  incident_id: "inc-abc123",
})

console.log("Message: " + result.data.message)
console.log("Status: " + result.data.status)
console.log("Priority: " + result.data.priority)
```
---

## list_teams

List all Opsgenie teams.

### Parameters

None.

### Example

```js
var result = app.integrations.opsgenie.list_teams({})

for (const team of (result.data || [])) {
  console.log(team.id + ": " + team.name)
}
```
---

## get_current_user

Get the currently authenticated Opsgenie user.

### Parameters

None.

### Example

```js
var result = app.integrations.opsgenie.get_current_user({})

console.log("User: " + (result.data.username || "unknown"))
console.log("Name: " + (result.data.fullName || "unknown"))
console.log("Email: " + (result.data.emailAddress || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Opsgenie accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.opsgenie.list_alerts({})

// Explicit default (portable across setups)
app.integrations.opsgenie.default.list_alerts({})

// Named accounts
app.integrations.opsgenie.production.list_alerts({})
app.integrations.opsgenie.staging.list_alerts({})
```
All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Check for high-priority open alerts

```js
var result = app.integrations.opsgenie.list_alerts({
  query: "status:open AND priority:P1",
  limit: 50,
})

var critical = result.data || {}

if (critical.length > 0) {
  console.log(critical.length + " critical alerts found!")
  for (const alert of (critical)) {
    console.log("  - " + alert.message + " (" + alert.priority + ")")
  }
} else {
  console.log("No critical alerts — all clear.")
}
```
### Create an alert from an incident trigger

```js
var incidents = app.integrations.opsgenie.list_incidents({
  query: "status:open",
  limit: 10,
})

for (const incident of (incidents.data || [])) {
  if (incident.priority === "P1") {
    app.integrations.opsgenie.create_alert({
      message: "ESCALATION: " + incident.message,
      priority: "P1",
      teams: ["management"],
      tags: ["escalation", "auto"],
      note: "Auto-escalated from incident " + incident.id,
    })
  }
}
```