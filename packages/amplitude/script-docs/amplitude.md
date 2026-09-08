# Amplitude Analytics — Ruby API Reference

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

```ruby
# Get recent events for a user
result = app.integrations.amplitude.list_events(user_id: "user_123", limit: 50)
(result.events || []).each do |event|
  puts((event.event_type).to_s + " at " + (event.server_received_time).to_s)
end
```
```ruby
# Get events in a time range
result = app.integrations.amplitude.list_events(start: "2025-01-01T00:00:00Z", end: "2025-01-31T23:59:59Z", limit: 100)
```
---

## get_event

Retrieve a single event by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude event ID |

### Example

```ruby
result = app.integrations.amplitude.get_event(id: "12345")
puts("Event: " + (result.event_type).to_s)
puts("User: " + (result.user_id).to_s)
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

```ruby
result = app.integrations.amplitude.list_funnels(limit: 20)
((result.funnels || result.data) || []).each do |funnel|
  puts("Funnel: " + ((funnel.name || funnel.id)).to_s + " — conversion: " + (((funnel.conversion_rate || "N/A")).to_s).to_s)
end
```
---

## get_funnel

Retrieve a single funnel by its ID with conversion metrics and step details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude funnel ID |

### Example

```ruby
result = app.integrations.amplitude.get_funnel(id: "42")
puts("Funnel: " + (result.name).to_s)
(result.steps || []).each do |step|
  puts("  Step: " + (step.event_type).to_s + " — " + ((step.count).to_s).to_s + " users")
end
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

```ruby
result = app.integrations.amplitude.list_cohorts(limit: 20)
((result.cohorts || result.data) || []).each do |cohort|
  puts("Cohort: " + ((cohort.name || cohort.id)).to_s + " — size: " + (((cohort.size || "N/A")).to_s).to_s)
end
```
---

## get_cohort

Retrieve a single cohort by its ID with membership and behavioral criteria.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude cohort ID |

### Example

```ruby
result = app.integrations.amplitude.get_cohort(id: "7")
puts("Cohort: " + (result.name).to_s)
puts("Members: " + ((((result.size || result.count) || "N/A")).to_s).to_s)
```
---

## get_current_user

Get the currently authenticated Amplitude user (caller identity).

### Parameters

None.

### Example

```ruby
result = app.integrations.amplitude.get_current_user()
puts("Logged in as: " + (((result.name || result.email) || "unknown")).to_s)
puts("Role: " + ((result.role || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Amplitude accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.amplitude.list_events(user_id: "user_123")
# Explicit default (portable across setups)
app.integrations.amplitude.default.list_events(user_id: "user_123")
# Named accounts
app.integrations.amplitude.production.list_events(user_id: "user_123")
app.integrations.amplitude.staging.list_events(user_id: "user_123")
```
All functions are identical across accounts — only the credentials differ.
