# PostHog JavaScript API Reference

This package exposes PostHog tools from the official PostHog OpenAPI schema at `https://us.posthog.com/api/schema/` plus a small `posthog_capture_event` helper for the documented ingestion API at `https://posthog.com/docs/api/capture`.

Namespace: `posthog`

## Authentication and Scope

Private API tools use a PostHog personal API token with `Authorization: Bearer <api_token>`. Configure `url` for US, EU, or self-hosted PostHog instances. Many tools require `project_id` or `environment_id`; configure defaults once, or pass those IDs as tool parameters.

`posthog_capture_event` sends events to `/capture/` and uses `project_api_key` by default. You can pass `api_key` per call when routing events to a different project.

## Coverage

Generated operation tools: 1600
Total tools including capture helper: 1601

High-use compatibility slugs retained:

- `posthog_list_events`, `posthog_get_event`
- `posthog_list_persons`, `posthog_get_person`
- `posthog_list_feature_flags`, `posthog_get_feature_flag`, `posthog_create_feature_flag`, `posthog_update_feature_flag`, `posthog_delete_feature_flag`
- `posthog_list_insights`, `posthog_get_insight`
- `posthog_list_dashboards`, `posthog_get_dashboard`
- `posthog_list_cohorts`

Generated tools follow the pattern `posthog_<operation_id>`. Path and query parameters are exposed by snake_case name. Request bodies are passed as `body`, or as loose top-level arguments that are not already consumed as path/query/header parameters.

## Examples

### List recent events

```js
var result = app.integrations.posthog.posthog_list_events({
  environment_id: "env_123",
  limit: 20,
})
```
### Get a feature flag using configured project_id

```js
var flag = app.integrations.posthog.posthog_get_feature_flag({
  id: 42,
})
```
### Create a feature flag

```js
var created = app.integrations.posthog.posthog_create_feature_flag({
  body: {
    name: "New dashboard",
    key: "new-dashboard",
    active: true,
  }
})
```
### Capture an event

```js
var event = app.integrations.posthog.posthog_capture_event({
  event: "purchase",
  distinct_id: "user-123",
  properties: {
    plan: "pro",
    amount: 49.99,
  }
})
```
## Return Shape

Tools return the parsed JSON response from PostHog. Empty `204` responses return an empty table. Non-JSON responses return `{ body = "...", content_type = "..." }` so agents can handle export/download-style endpoints without losing content.
