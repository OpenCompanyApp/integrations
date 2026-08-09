# UptimeRobot Integration

Use the `uptimerobot` integration to manage UptimeRobot v3 resources: monitors, monitor groups, incidents, public status pages, announcements, maintenance windows, integrations, tags, and user alert contacts.

All tools are generated from the official UptimeRobot v3 OpenAPI spec at `https://cdn.uptimerobot.com/api/openapi.yaml`. Configure an API token; runtime requests send it as `Authorization: Bearer <token>`.

## Common Tools

- `uptimerobot_monitors_list` lists monitors with filters such as `status`, `name`, `url`, `tags`, `group_id`, `limit`, `cursor`, and repeated `custom_field` values.
- `uptimerobot_monitors_create`, `uptimerobot_monitors_update`, `uptimerobot_monitors_delete`, `uptimerobot_monitors_pause`, and `uptimerobot_monitors_start` manage monitor lifecycle.
- `uptimerobot_incidents_list`, `uptimerobot_incidents_get`, and incident comment/activity/alert tools inspect incidents.
- `uptimerobot_psp_create`, `uptimerobot_psp_update`, and announcement tools manage public status pages. PSP create/update use multipart request bodies when files are provided.
- `uptimerobot_maintenance_windows_*`, `uptimerobot_integrations_*`, and `uptimerobot_tags_*` cover maintenance, notification integrations, and tags.

## Return Shape

JSON responses are returned as decoded arrays/objects from UptimeRobot. Empty successful responses return `{ success = true, status = <http_status> }`.

## Examples

```js
var monitors = app.integrations.uptimerobot.monitors_list({
  status: "UP,DOWN",
  limit: 50,
  custom_field: [ "environment:production", "team:core" ],
})

var created = app.integrations.uptimerobot.monitors_create({
  body: {
    name: "Production API",
    url: "https://example.test/health",
    type: "HTTP",
  }
})

var user = app.integrations.uptimerobot.user_get_me({})
```
Read-only UptimeRobot API keys can call read endpoints only. Account-specific keys are required for create, update, delete, pause, start, and reset operations.
