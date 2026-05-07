# Integration: CockroachDB Cloud

CockroachDB Cloud integration package for OpenCompany and KosmoKrator agents.

This package exposes generated tools from CockroachDB Cloud's official OpenAPI document. It covers Cloud v1 resources and SCIM resources, including clusters, databases, SQL users, API keys, roles, audit logs, folders, backups, networking, metrics, maintenance windows, CMEK, JWT issuers, private endpoints, invites, and SCIM users/groups/schemas.

## Configuration

Required credentials:

- `access_token`: CockroachDB Cloud API key.
- `url`: API root URL. Defaults to `https://cockroachlabs.cloud`.

Legacy configs using `https://cockroachlabs.cloud/api/v1` still work for Cloud v1 endpoints.

## Tool Coverage

The generated tool catalog is built from:

```text
https://cockroachlabs.cloud/assets/docs/api/latest/openapi.json
```

Compatibility slugs that still map to official operations are preserved:

- `cockroachdb_list_clusters`
- `cockroachdb_get_cluster`
- `cockroachdb_create_cluster`
- `cockroachdb_list_databases`
- `cockroachdb_list_users`

The previous `cockroachdb_get_current_user` and `cockroachdb_get_database` helpers were removed because the current official spec does not expose those operations.

## Notes

Generated tools accept OpenAPI parameter names and snake_case aliases. Dotted query parameters such as `pagination.limit` can be passed as `pagination.limit` or `pagination_limit`.
