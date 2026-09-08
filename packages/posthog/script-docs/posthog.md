# PostHog Ruby API Reference

This package exposes PostHog tools from the official PostHog OpenAPI schema at `https://us.posthog.com/api/schema/` plus a small `posthog_capture_event` helper for the documented ingestion API at `https://posthog.com/docs/api/capture`.

Namespace: `posthog`

## Authentication and Scope

Private API tools use a PostHog personal API token with `Authorization: Bearer <api_token>`. Configure `url` for US, EU, or self-hosted PostHog instances. Many tools require `project_id` or `environment_id`; configure defaults once, or pass those IDs as tool parameters.

`posthog_capture_event` sends events to `/capture/` and uses `project_api_key` by default. You can pass `api_key` per call when routing events to a different project.

## Coverage

Generated operation tools: 1600
Total tools including capture helper: 1601

Stable exact tool slugs for common operations:

- `posthog_eventslist`, `posthog_eventsretrieve`
- `posthog_personslist`, `posthog_personsretrieve`
- `posthog_featureflagslist`, `posthog_featureflagsretrieve`, `posthog_featureflagscreate`, `posthog_featureflagsupdate`, `posthog_featureflagsdestroy`
- `posthog_insightslist`, `posthog_insightsretrieve`
- `posthog_dashboardslist`, `posthog_dashboardsretrieve`
- `posthog_cohortslist`

Generated tools follow the pattern `posthog_<operation_id>`. Path and query parameters are exposed by snake_case name. Request bodies are passed as `body`, or as loose top-level arguments that are not already consumed as path/query/header parameters.

## Examples

### List recent events

```ruby
result = app.call("integrations.posthog.posthog_eventslist", projectid: "project_123", limit: 20)
```
### Get a feature flag using configured project_id

```ruby
flag = app.call("integrations.posthog.posthog_featureflagsretrieve", projectid: "project_123", id: 42)
```
### Create a feature flag

```ruby
created = app.call("integrations.posthog.posthog_featureflagscreate", projectid: "project_123", body: {name: "New dashboard", key: "new-dashboard", active: true})
```
### Capture an event

```ruby
event = app.call("integrations.posthog.posthog_capture_event", event: "purchase", distinct_id: "user-123", properties: {plan: "pro", amount: 49.99})
```
## Return Shape

Tools return the parsed JSON response from PostHog. Empty `204` responses return an empty table. Non-JSON responses return `{ body = "...", content_type = "..." }` so agents can handle export/download-style endpoints without losing content.
