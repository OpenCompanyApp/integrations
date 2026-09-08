# Mixpanel Analytics — Ruby API Reference

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

```ruby
# Get recent events
result = app.integrations.mixpanel.list_events(limit: 50)
(result.data || {}).to_a.each do |name, data|
  puts("Event: " + (name).to_s)
end
```
```ruby
# Get events in a date range
result = app.integrations.mixpanel.list_events(from: "2025-01-01", to: "2025-01-31", unit: "day", limit: 100)
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

```ruby
result = app.integrations.mixpanel.get_event(name: "Page View", from: "2025-01-01", to: "2025-01-31")
(result.data || {}).to_a.each do |date, count|
  puts("Date: " + (date).to_s + " — Count: " + ((count).to_s).to_s)
end
```
---

## list_funnels

List all funnels configured in the Mixpanel project.

### Parameters

None.

### Example

```ruby
result = app.integrations.mixpanel.list_funnels()
(result.data || []).each do |funnel|
  puts("Funnel: " + (funnel.name).to_s + " (ID: " + ((funnel.id).to_s).to_s + ")")
end
```
---

## get_funnel

Retrieve detailed conversion data for a Mixpanel funnel by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel funnel ID |

### Example

```ruby
result = app.integrations.mixpanel.get_funnel(id: "12345")
puts("Funnel: " + ((result.data.name || "unknown")).to_s)
(result.data.steps || []).each do |step|
  puts("  Step: " + (step.event).to_s + " — Conversion: " + ((step.conversion_ratio).to_s).to_s)
end
```
---

## list_cohorts

List all behavioral cohorts in the Mixpanel project.

### Parameters

None.

### Example

```ruby
result = app.integrations.mixpanel.list_cohorts()
(result.data || []).each do |cohort|
  puts("Cohort: " + (cohort.name).to_s + " (ID: " + ((cohort.id).to_s).to_s + ")")
end
```
---

## get_cohort

Retrieve detailed information for a Mixpanel cohort by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel cohort ID |

### Example

```ruby
result = app.integrations.mixpanel.get_cohort(id: "67890")
puts("Cohort: " + ((result.data.name || "unknown")).to_s)
puts("Count: " + (((result.data.count || 0)).to_s).to_s)
```
---

## get_current_user

Get the currently authenticated Mixpanel user (caller identity).

### Parameters

None.

### Example

```ruby
result = app.integrations.mixpanel.get_current_user()
puts("Logged in as: " + (((result.name || result.email) || "unknown")).to_s)
puts("Role: " + ((result.role || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Mixpanel accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.mixpanel.list_events(limit: 50)
# Explicit default (portable across setups)
app.integrations.mixpanel.default.list_events(limit: 50)
# Named accounts
app.integrations.mixpanel.production.list_events(limit: 50)
app.integrations.mixpanel.staging.list_events(limit: 50)
```
All functions are identical across accounts — only the credentials differ.
