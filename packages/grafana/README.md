# Integration: Grafana

Grafana integration package for OpenCompany and KosmoKrator agents.

This package exposes generated tools from Grafana's official `public/openapi3.json` HTTP API document. It covers dashboards, search, data sources, folders, annotations, snapshots, alerting provisioning, teams, users, orgs, service accounts, reports, public dashboards, RBAC roles, preferences, and admin/provisioning endpoints.

## Configuration

Required credentials:

- `url`: Grafana API base URL, including `/api`, for example `https://grafana.example.test/api`.
- `api_token`: Grafana service account token or legacy API key.

Local development usually uses:

```text
http://localhost:3000/api
```

## Tool Coverage

The generated tool catalog is built from:

```text
https://raw.githubusercontent.com/grafana/grafana/main/public/openapi3.json
```

Legacy tool slugs are preserved for compatibility:

- `grafana_list_dashboards`
- `grafana_get_dashboard`
- `grafana_create_dashboard`
- `grafana_list_datasources`
- `grafana_list_alerts`
- `grafana_list_teams`
- `grafana_get_current_user`

All other operation tools use the `grafana_` prefix followed by a snake_case operation id.

## Notes

Grafana host capabilities vary by edition, feature flag, plugin, and version. Enterprise-only or disabled endpoints can return normal Grafana authorization or not-found errors even when the token is valid.

Generated tools accept OpenAPI parameter names and snake_case aliases. JSON request bodies go in `body`; YAML-only endpoints accept `body` as a YAML string.
