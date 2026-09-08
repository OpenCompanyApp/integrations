# Opsgenie — Ruby API Reference

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

```ruby
result = app.integrations.opsgenie.list_alerts(query: "status:open", limit: 10)
(result.data || []).each do |alert|
  puts((alert.id).to_s + ": " + (alert.message).to_s + " [" + (alert.priority).to_s + "]")
end
```
---

## get_alert

Get full details of a specific Opsgenie alert.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `alert_id` | string | yes | The Opsgenie alert ID |

### Example

```ruby
result = app.integrations.opsgenie.get_alert(alert_id: "abc123-def456")
puts("Message: " + (result.data.message).to_s)
puts("Status: " + (result.data.status).to_s)
puts("Priority: " + (result.data.priority).to_s)
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

```ruby
result = app.integrations.opsgenie.create_alert(message: "Production database CPU above 95%", priority: "P1", description: "CPU utilization has exceeded 95% for the last 10 minutes on db-primary-01.", teams: ["ops", "backend"], tags: ["production", "database", "critical"], actions: ["Restart Database", "Scale Up"], source: "monitoring")
puts("Alert created: " + ((result.requestId || "ok")).to_s)
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

```ruby
result = app.integrations.opsgenie.list_incidents(query: "status:open", limit: 10)
(result.data || []).each do |incident|
  puts((incident.id).to_s + ": " + (incident.message).to_s + " [" + (incident.status).to_s + "]")
end
```
---

## get_incident

Get full details of a specific Opsgenie incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `incident_id` | string | yes | The Opsgenie incident ID |

### Example

```ruby
result = app.integrations.opsgenie.get_incident(incident_id: "inc-abc123")
puts("Message: " + (result.data.message).to_s)
puts("Status: " + (result.data.status).to_s)
puts("Priority: " + (result.data.priority).to_s)
```
---

## list_teams

List all Opsgenie teams.

### Parameters

None.

### Example

```ruby
result = app.integrations.opsgenie.list_teams()
(result.data || []).each do |team|
  puts((team.id).to_s + ": " + (team.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated Opsgenie user.

### Parameters

None.

### Example

```ruby
result = app.integrations.opsgenie.get_current_user()
puts("User: " + ((result.data.username || "unknown")).to_s)
puts("Name: " + ((result.data.fullName || "unknown")).to_s)
puts("Email: " + ((result.data.emailAddress || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Opsgenie accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.opsgenie.list_alerts()
# Explicit default (portable across setups)
app.integrations.opsgenie.default.list_alerts()
# Named accounts
app.integrations.opsgenie.production.list_alerts()
app.integrations.opsgenie.staging.list_alerts()
```
All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Check for high-priority open alerts

```ruby
result = app.integrations.opsgenie.list_alerts(query: "status:open AND priority:P1", limit: 50)
critical = (result.data || {})
if (critical.length > 0)
  puts((critical.length).to_s + " critical alerts found!")
  critical.each do |alert|
    puts("  - " + (alert.message).to_s + " (" + (alert.priority).to_s + ")")
  end
else
  puts("No critical alerts — all clear.")
end
```
### Create an alert from an incident trigger

```ruby
incidents = app.integrations.opsgenie.list_incidents(query: "status:open", limit: 10)
(incidents.data || []).each do |incident|
  if (incident.priority == "P1")
    app.integrations.opsgenie.create_alert(message: "ESCALATION: " + (incident.message).to_s, priority: "P1", teams: ["management"], tags: ["escalation", "auto"], note: "Auto-escalated from incident " + (incident.id).to_s)
  end
end
```