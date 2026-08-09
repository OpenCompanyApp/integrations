# CockroachDB Cloud JavaScript API Reference

Namespace: `cockroachdb`

This integration exposes generated coverage for CockroachDB Cloud's official OpenAPI document at `https://cockroachlabs.cloud/assets/docs/api/latest/openapi.json`.

Configure `url` as the API root, usually `https://cockroachlabs.cloud`. Existing configs that use `https://cockroachlabs.cloud/api/v1` continue to work for Cloud v1 tools.

Authentication uses a CockroachDB Cloud API key as a bearer token. Endpoint access depends on the roles assigned to that API key.

## Common Tools

- `cockroachdb_list_clusters` maps to `GET /api/v1/clusters`.
- `cockroachdb_get_cluster` maps to `GET /api/v1/clusters/{cluster_id}`.
- `cockroachdb_create_cluster` maps to `POST /api/v1/clusters`.
- `cockroachdb_list_databases` maps to `GET /api/v1/clusters/{cluster_id}/databases`.
- `cockroachdb_list_users` maps to `GET /api/v1/clusters/{cluster_id}/sql-users`.

The generated catalog also covers API keys, audit logs, available regions, backups, backup config, blackout windows, client CA certificates, CMEK, connection strings, folders, invites, maintenance windows, metrics exports, networking, node maps, physical replication streams, private endpoints, roles, JWT issuers, spend limits, egress rules, log export, and SCIM users/groups/schemas.

## Arguments

Path and query parameters use names from the OpenAPI document. Snake-case aliases are also accepted. For dotted query parameters such as `pagination.limit`, you may pass either `pagination.limit` or `pagination_limit`.

Tools with a JSON request body accept a `body` table. If `body` is omitted, non-path/query/header arguments are collected into the JSON body.

## Examples

```js
var clusters = cockroachdb.cockroachdb_list_clusters({
  pagination_limit: 25,
})
```
```js
var cluster = cockroachdb.cockroachdb_get_cluster({
  cluster_id: "00000000-0000-0000-0000-000000000000",
})
```
```js
var databases = cockroachdb.cockroachdb_list_databases({
  cluster_id: "00000000-0000-0000-0000-000000000000",
  pagination_limit: 50,
})
```
```js
var created = cockroachdb.cockroachdb_create_cluster({
  body: {
    name: "agent-demo",
    provider: "AWS",
    spec: {},
  }
})
```
## Return Shapes

Responses are CockroachDB Cloud's parsed JSON responses. Paginated responses may include token or pagination fields, depending on the endpoint.

Non-JSON responses return:

```js
const example = {
  body: "...",
  content_type: "text/plain",
}
```
The previous `cockroachdb_get_current_user` and `cockroachdb_get_database` helpers are intentionally not part of the generated catalog because the current official OpenAPI document does not expose those operations.
