# Prometheus — Lua API Reference

## list_alerts

List Prometheus alerts with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Optional label selector filter (e.g., `"severity=critical"`) |
| `receiver` | string | no | Filter alerts by receiver name |

### Examples

```lua
-- List all alerts
local result = app.integrations.prometheus.list_alerts({})

for _, alert in ipairs(result.alerts or {}) do
  print(alert.name .. " — state: " .. alert.state)
end

-- Filter by label
local result = app.integrations.prometheus.list_alerts({
  filter = "severity=critical"
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

```lua
local result = app.integrations.prometheus.get_alert({
  name = "HighMemoryUsage"
})

print("Alert: " .. result.name)
print("State: " .. result.state)
print("Expression: " .. result.query)
```

---

## list_rules

List Prometheus alerting and recording rules.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter rules by type: `"alert"` or `"recording"` |

### Examples

```lua
-- List all rules
local result = app.integrations.prometheus.list_rules({})

for _, group in ipairs(result.groups or {}) do
  print("Group: " .. group.name)
  for _, rule in ipairs(group.rules or {}) do
    print("  Rule: " .. rule.name)
  end
end

-- Filter to alerting rules only
local result = app.integrations.prometheus.list_rules({
  type = "alert"
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

```lua
local result = app.integrations.prometheus.get_rule({
  name = "system-alerts"
})

print("Rule Group: " .. result.name)
for _, rule in ipairs(result.rules or {}) do
  print("  Rule: " .. rule.name .. " — type: " .. rule.type)
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

```lua
-- List all targets
local result = app.integrations.prometheus.list_targets({})

for _, target in ipairs(result.activeTargets or {}) do
  print(target.discoveredLabels.__address__ .. " — health: " .. target.health)
end

-- Filter to active targets only
local result = app.integrations.prometheus.list_targets({
  state = "active"
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

```lua
local result = app.integrations.prometheus.get_target({
  instance = "localhost:9090"
})

print("Health: " .. result.health)
print("Last Scrape: " .. result.lastScrape)
print("Scrape Duration: " .. result.scrapeDuration)
```

---

## get_current_user

Get the current authenticated Prometheus user info. Useful for verifying authentication.

### Parameters

None.

### Example

```lua
local result = app.integrations.prometheus.get_current_user({})

print("User: " .. (result.name or result.email))
print("ID: " .. result.id)
```

---

## Multi-Account Usage

If you have multiple Prometheus instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.prometheus.list_alerts({})

-- Explicit default (portable across setups)
app.integrations.prometheus.default.list_alerts({})

-- Named accounts
app.integrations.prometheus.production.list_alerts({})
app.integrations.prometheus.staging.list_alerts({})
```

All functions are identical across accounts — only the credentials differ.
