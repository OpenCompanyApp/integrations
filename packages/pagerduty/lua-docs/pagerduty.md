# PagerDuty Lua Docs

Namespace: `pagerduty`

This integration is generated from PagerDuty's official REST OpenAPI schema and exposes 420 REST operations. Use it for incident response automation, service and team inventory, escalation policies, schedules, users, automation actions, analytics, status pages, maintenance windows, priorities, tags, and webhooks.

## Authentication

Configure a PagerDuty REST API token. Requests use `Authorization: Bearer <token>` and `Accept: application/vnd.pagerduty+json;version=2`.

## Common Tools

- `pagerduty_list_incidents` - list incidents with filters such as `statuses`, `urgencies`, `service_ids`, `team_ids`, `limit`, and `offset`.
- `pagerduty_get_incident` - fetch one incident by `id`.
- `pagerduty_list_services` and `pagerduty_get_service` - inspect services.
- `pagerduty_list_teams` and `pagerduty_get_team` - inspect teams.
- `pagerduty_get_current_user` - verify the authenticated user.

## Generated Operation Pattern

Path and query parameters use snake_case names. PagerDuty query parameters documented with `[]`, such as `statuses[]`, are exposed without brackets, such as `statuses`, and can be passed as arrays.

For write operations, pass the JSON payload as `body`. If you pass extra top-level arguments that are not path, query, or header parameters, the integration sends them as the JSON body.

```lua
local incidents = pagerduty.pagerduty_list_incidents({
  statuses = { "triggered", "acknowledged" },
  limit = 10
})

local incident = pagerduty.pagerduty_get_incident({
  id = "Q0123456789ABC"
})
```

## Scope Notes

This package covers PagerDuty's REST OpenAPI schema. PagerDuty Events API, SCIM, and service-specific integration schemas are separate API families and are intentionally not mixed into this package.

Return values are the parsed PagerDuty JSON response for the operation. The integration does not unwrap collection fields, so agents should read the documented response key, such as `incidents`, `services`, `teams`, or `user`.