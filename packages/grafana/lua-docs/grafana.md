# Grafana Lua API Reference

Namespace: `grafana`

This integration exposes generated coverage for Grafana's official HTTP API OpenAPI document. Configure the API base URL with the `/api` prefix, for example `https://grafana.example.test/api` or `http://localhost:3000/api`.

Authentication uses a Grafana service account token or a legacy API key where older deployments still allow API keys. Grafana permissions are enforced by the instance, so a token may see only the dashboards, folders, data sources, teams, alerts, reports, or RBAC resources it is allowed to access.

## Common Tools

- `grafana_list_dashboards` maps to `GET /search` and searches dashboards and folders.
- `grafana_get_dashboard` maps to `GET /dashboards/uid/{uid}`.
- `grafana_create_dashboard` maps to `POST /dashboards/db`.
- `grafana_list_datasources` maps to `GET /datasources`.
- `grafana_list_alerts` maps to `GET /v1/provisioning/alert-rules`.
- `grafana_list_teams` maps to `GET /teams/search`.
- `grafana_get_current_user` maps to `GET /user`.

The package also exposes generated tools for folders, annotations, dashboard versions, permissions, snapshots, playlist APIs, library elements, reports, public dashboards, teams, orgs, users, service accounts, access-control roles, alerting provisioning, query history, data source proxy calls, and admin/provisioning endpoints.

## Arguments

Path, query, and header parameters use the names from Grafana's OpenAPI document. The runtime also accepts snake_case aliases for camel-case names. For example, `roleUID`, `role_uid`, and `roleuid` resolve to the same path parameter.

Tools with a JSON request body accept a `body` table. If you omit `body`, non-path/query/header arguments are collected into the request body.

YAML-only endpoints accept `body` as a raw YAML string.

## Examples

```lua
local dashboards = grafana.grafana_list_dashboards({
  query = "latency",
  type = "dash-db",
  limit = 25
})
```

```lua
local dashboard = grafana.grafana_get_dashboard({
  uid = "service-latency"
})
```

```lua
local result = grafana.grafana_create_dashboard({
  body = {
    dashboard = {
      uid = "agent-demo",
      title = "Agent Demo",
      panels = {}
    },
    overwrite = true
  }
})
```

```lua
local rules = grafana.grafana_list_alerts({})
```

## Return Shapes

Responses are Grafana's parsed JSON responses with no private host rewriting. Non-JSON responses return:

```lua
{
  body = "...",
  content_type = "text/csv"
}
```

Grafana editions and plugin sets differ. Enterprise-only endpoints, report endpoints, LDAP/SAML endpoints, or newer alerting endpoints may return authorization or not-found errors on instances that do not support them.
