# ClickHouse Cloud Lua API

Generated from the official ClickHouse Cloud OpenAPI document at `https://api.clickhouse.cloud/v1`. The namespace is `app.integrations["clickhouse-cloud"]`.

This package exposes 96 endpoint-specific tools: 43 read tools and 53 write tools. Use a ClickHouse Cloud API key ID and key secret; the integration sends them with HTTP Basic authentication.

## Usage

```lua
local organizations = app.integrations["clickhouse-cloud"].organization_get_list({})

local service = app.integrations["clickhouse-cloud"].instance_get({
  organization_id = "00000000-0000-0000-0000-000000000000",
  service_id = "11111111-1111-1111-1111-111111111111"
})
```

## Request Bodies

Tools that create, update, patch, or delete resources may accept a `body` table. The table is passed as the JSON body exactly as expected by the ClickHouse Cloud OpenAPI schema. Path and query arguments use snake_case names, while the service maps them back to the official API names.

## Example Tools

| `clickhouse_cloud_organization_get_list` | read | GET `/v1/organizations` |
| `clickhouse_cloud_organization_get` | read | GET `/v1/organizations/{organizationId}` |
| `clickhouse_cloud_organization_update` | write | PATCH `/v1/organizations/{organizationId}` |
| `clickhouse_cloud_organization_prometheus_get` | read | GET `/v1/organizations/{organizationId}/prometheus` |
| `clickhouse_cloud_organization_roles_get_list` | read | GET `/v1/organizations/{organizationId}/roles` |
| `clickhouse_cloud_organization_role_post` | write | POST `/v1/organizations/{organizationId}/roles` |
| `clickhouse_cloud_organization_role_get` | read | GET `/v1/organizations/{organizationId}/roles/{roleId}` |
| `clickhouse_cloud_organization_role_patch` | write | PATCH `/v1/organizations/{organizationId}/roles/{roleId}` |
| `clickhouse_cloud_organization_role_delete` | write | DELETE `/v1/organizations/{organizationId}/roles/{roleId}` |
| `clickhouse_cloud_instance_get_list` | read | GET `/v1/organizations/{organizationId}/services` |
| `clickhouse_cloud_instance_create` | write | POST `/v1/organizations/{organizationId}/services` |
| `clickhouse_cloud_instance_get` | read | GET `/v1/organizations/{organizationId}/services/{serviceId}` |
| `clickhouse_cloud_instance_update` | write | PATCH `/v1/organizations/{organizationId}/services/{serviceId}` |
| `clickhouse_cloud_instance_delete` | write | DELETE `/v1/organizations/{organizationId}/services/{serviceId}` |
| `clickhouse_cloud_instance_private_endpoint_config_get` | read | GET `/v1/organizations/{organizationId}/services/{serviceId}/privateEndpointConfig` |
| `clickhouse_cloud_instance_query_endpoint_get` | read | GET `/v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint` |


## Notes

- The base URL defaults to `https://api.clickhouse.cloud`.
- Some endpoints are marked beta in ClickHouse Cloud's API documentation; their tool descriptions retain the official endpoint summary.
- Returned data is the parsed JSON response from ClickHouse Cloud, preserving the upstream `status`, `requestId`, and `result` shape where present.
