# Prometheus — Ruby API Reference

## list_alerts

List Prometheus alerts with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Optional label selector filter (e.g., `"severity=critical"`) |
| `receiver` | string | no | Filter alerts by receiver name |

### Examples

```ruby
# List all alerts
result = app.integrations.prometheus.list_alerts()
(result.alerts || []).each do |alert|
  puts((alert.name).to_s + " — state: " + (alert.state).to_s)
end
# Filter by label
result = app.integrations.prometheus.list_alerts(filter: "severity=critical")
```
---

## get_alert

Get a Prometheus alert by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the alert to retrieve |

### Example

```ruby
result = app.integrations.prometheus.get_alert(name: "HighMemoryUsage")
puts("Alert: " + (result.name).to_s)
puts("State: " + (result.state).to_s)
puts("Expression: " + (result.query).to_s)
```
---

## list_rules

List Prometheus alerting and recording rules.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter rules by type: `"alert"` or `"recording"` |

### Examples

```ruby
# List all rules
result = app.integrations.prometheus.list_rules()
(result.groups || []).each do |group|
  puts("Group: " + (group.name).to_s)
  (group.rules || []).each do |rule|
    puts("  Rule: " + (rule.name).to_s)
  end
end
# Filter to alerting rules only
result = app.integrations.prometheus.list_rules(type: "alert")
```
---

## get_rule

Get a Prometheus rule group by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the rule group to retrieve |

### Example

```ruby
result = app.integrations.prometheus.get_rule(name: "system-alerts")
puts("Rule Group: " + (result.name).to_s)
(result.rules || []).each do |rule|
  puts("  Rule: " + (rule.name).to_s + " — type: " + (rule.type).to_s)
end
```
---

## list_targets

List Prometheus scrape targets.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter targets by state: `"active"` or `"dropped"` |

### Examples

```ruby
# List all targets
result = app.integrations.prometheus.list_targets()
(result.activeTargets || []).each do |target|
  puts((target.discoveredLabels.__address__).to_s + " — health: " + (target.health).to_s)
end
# Filter to active targets only
result = app.integrations.prometheus.list_targets(state: "active")
```
---

## get_target

Get a Prometheus target by its instance address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `instance` | string | yes | The target instance address (e.g., `"localhost:9090"`) |

### Example

```ruby
result = app.integrations.prometheus.get_target(instance: "localhost:9090")
puts("Health: " + (result.health).to_s)
puts("Last Scrape: " + (result.lastScrape).to_s)
puts("Scrape Duration: " + (result.scrapeDuration).to_s)
```
---

## get_current_user

Get the current authenticated Prometheus user info. Useful for verifying authentication.

### Parameters

None.

### Example

```ruby
result = app.integrations.prometheus.get_current_user()
puts("User: " + ((result.name || result.email)).to_s)
puts("ID: " + (result.id).to_s)
```
---

## Multi-Account Usage

If you have multiple Prometheus instances configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.prometheus.list_alerts()
# Explicit default (portable across setups)
app.integrations.prometheus.default.list_alerts()
# Named accounts
app.integrations.prometheus.production.list_alerts()
app.integrations.prometheus.staging.list_alerts()
```
All functions are identical across accounts — only the credentials differ.
