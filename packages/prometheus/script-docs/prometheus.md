# Prometheus — JavaScript API Reference

## list_alerts

List Prometheus alerts with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Optional label selector filter (e.g., `"severity=critical"`) |
| `receiver` | string | no | Filter alerts by receiver name |

### Examples

```js
// List all alerts
var result = app.integrations.prometheus.list_alerts({})

for (const alert of (result.alerts || [])) {
  console.log(alert.name + " — state: " + alert.state)
}

// Filter by label
var result = app.integrations.prometheus.list_alerts({
  filter: "severity=critical",
})
```
---

## get_alert

Get a Prometheus alert by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the alert to retrieve |

### Example

```js
var result = app.integrations.prometheus.get_alert({
  name: "HighMemoryUsage",
})

console.log("Alert: " + result.name)
console.log("State: " + result.state)
console.log("Expression: " + result.query)
```
---

## list_rules

List Prometheus alerting and recording rules.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter rules by type: `"alert"` or `"recording"` |

### Examples

```js
// List all rules
var result = app.integrations.prometheus.list_rules({})

for (const group of (result.groups || [])) {
  console.log("Group: " + group.name)
  for (const rule of (group.rules || [])) {
    console.log("  Rule: " + rule.name)
  }
}

// Filter to alerting rules only
var result = app.integrations.prometheus.list_rules({
  type: "alert",
})
```
---

## get_rule

Get a Prometheus rule group by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the rule group to retrieve |

### Example

```js
var result = app.integrations.prometheus.get_rule({
  name: "system-alerts",
})

console.log("Rule Group: " + result.name)
for (const rule of (result.rules || [])) {
  console.log("  Rule: " + rule.name + " — type: " + rule.type)
}
```
---

## list_targets

List Prometheus scrape targets.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter targets by state: `"active"` or `"dropped"` |

### Examples

```js
// List all targets
var result = app.integrations.prometheus.list_targets({})

for (const target of (result.activeTargets || [])) {
  console.log(target.discoveredLabels.__address__ + " — health: " + target.health)
}

// Filter to active targets only
var result = app.integrations.prometheus.list_targets({
  state: "active",
})
```
---

## get_target

Get a Prometheus target by its instance address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `instance` | string | yes | The target instance address (e.g., `"localhost:9090"`) |

### Example

```js
var result = app.integrations.prometheus.get_target({
  instance: "localhost:9090",
})

console.log("Health: " + result.health)
console.log("Last Scrape: " + result.lastScrape)
console.log("Scrape Duration: " + result.scrapeDuration)
```
---

## get_current_user

Get the current authenticated Prometheus user info. Useful for verifying authentication.

### Parameters

None.

### Example

```js
var result = app.integrations.prometheus.get_current_user({})

console.log("User: " + (result.name || result.email))
console.log("ID: " + result.id)
```
---

## Multi-Account Usage

If you have multiple Prometheus instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.prometheus.list_alerts({})

// Explicit default (portable across setups)
app.integrations.prometheus.default.list_alerts({})

// Named accounts
app.integrations.prometheus.production.list_alerts({})
app.integrations.prometheus.staging.list_alerts({})
```
All functions are identical across accounts — only the credentials differ.
