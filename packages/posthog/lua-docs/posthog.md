# PostHog — Lua API Reference

## posthog_capture_event

Send (capture) a custom event to PostHog.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event` | string | yes | The name of the event to capture (e.g., `"signup"`, `"purchase"`, `"button_clicked"`). |
| `distinct_id` | string | yes | A unique identifier for the user performing the event (e.g., user ID, email, or anonymous ID). |
| `properties` | object | no | Optional key-value properties to attach to the event. |
| `timestamp` | string | no | Optional ISO 8601 timestamp for the event. Defaults to the current server time. |

## posthog_list_events

List events with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of events to return (default: 100). |
| `offset` | integer | no | Number of events to skip for pagination (default: 0). |
| `event` | string | no | Filter by event name (e.g., `"$pageview"`, `"signup"`). |
| `distinct_id` | string | no | Filter by distinct user ID. |
| `person_id` | string | no | Filter by internal person UUID. |
| `after` | string | no | Only return events after this timestamp (ISO 8601). |
| `before` | string | no | Only return events before this timestamp (ISO 8601). |

## posthog_get_event

Get details of a specific event by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The unique identifier of the event to retrieve. |

## posthog_list_persons

List persons (users) with optional search.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of persons to return (default: 100). |
| `offset` | integer | no | Number of persons to skip for pagination (default: 0). |
| `search` | string | no | Search query to filter persons by name, email, or distinct ID. |

## posthog_get_person

Get details of a specific person by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `person_id` | string | yes | The unique identifier (UUID) of the person to retrieve. |

## posthog_list_feature_flags

List all feature flags in the project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of feature flags to return (default: 100). |
| `offset` | integer | no | Number of feature flags to skip for pagination (default: 0). |

## posthog_get_feature_flag

Get details of a specific feature flag.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `flag_id` | integer | yes | The unique identifier of the feature flag to retrieve. |

## posthog_create_feature_flag

Create a new feature flag.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Human-readable name for the feature flag (e.g., `"New checkout flow"`). |
| `key` | string | yes | Unique key used to reference the flag in code (e.g., `"new-checkout"`). Must be lowercase with hyphens. |
| `active` | boolean | no | Whether the flag should be active immediately (default: true). |
| `filters` | object | no | Optional filter conditions for targeting specific users or groups. |
| `rollout_percentage` | integer | no | Percentage of users to roll out to (0–100). Omit for 100%. |

## posthog_update_feature_flag

Update an existing feature flag.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `flag_id` | integer | yes | The unique identifier of the feature flag to update. |
| `active` | boolean | no | Set the flag active (true) or inactive (false). |
| `filters` | object | no | New filter conditions for targeting specific users or groups. |
| `rollout_percentage` | integer | no | New rollout percentage (0–100). |

## posthog_delete_feature_flag

Delete a feature flag.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `flag_id` | integer | yes | The unique identifier of the feature flag to delete. |

## posthog_list_insights

List saved insights in the project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of insights to return (default: 100). |
| `offset` | integer | no | Number of insights to skip for pagination (default: 0). |
| `type` | string | no | Filter by insight type: `TRENDS`, `FUNNELS`, `RETENTION`, `PATHS`, `LIFECYCLE`, or `STICKINESS`. |

## posthog_get_insight

Get details of a specific insight by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `insight_id` | integer | yes | The unique identifier of the insight to retrieve. |

## posthog_list_dashboards

List dashboards in the project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of dashboards to return (default: 100). |
| `offset` | integer | no | Number of dashboards to skip for pagination (default: 0). |

## posthog_get_dashboard

Get details of a specific dashboard by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dashboard_id` | integer | yes | The unique identifier of the dashboard to retrieve. |

## posthog_list_cohorts

List cohorts in the project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of cohorts to return (default: 100). |
| `offset` | integer | no | Number of cohorts to skip for pagination (default: 0). |

## Examples

### Capture a custom event

```lua
local result = app.integrations.posthog.posthog_capture_event({
  event = "purchase",
  distinct_id = "user-123",
  properties = {
    product = "Pro Plan",
    amount = 49.99
  }
})
```

### List recent pageview events

```lua
local result = app.integrations.posthog.posthog_list_events({
  event = "$pageview",
  limit = 20,
  after = "2026-04-01T00:00:00Z"
})
for _, event in ipairs(result.results) do
  print(event.distinct_id .. " - " .. event.properties.pathname)
end
```

### Create a feature flag with 50% rollout

```lua
local result = app.integrations.posthog.posthog_create_feature_flag({
  name = "New Dashboard",
  key = "new-dashboard",
  active = true,
  rollout_percentage = 50
})
```

### List dashboards

```lua
local result = app.integrations.posthog.posthog_list_dashboards({
  limit = 10
})
for _, dashboard in ipairs(result.results) do
  print(dashboard.name .. " (ID: " .. dashboard.id .. ")")
end
```

---

## Multi-Account Usage

If you have multiple posthog accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.posthog.function_name({...})

-- Explicit default (portable across setups)
app.integrations.posthog.default.function_name({...})

-- Named accounts
app.integrations.posthog.work.function_name({...})
app.integrations.posthog.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
