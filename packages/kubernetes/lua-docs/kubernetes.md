# Kubernetes Lua API

Generated from the official Kubernetes `v1.36.0` OpenAPI/Swagger document at `api/openapi-spec/swagger.json`. The namespace is `app.integrations.kubernetes`.

This package exposes 1111 endpoint-specific tools: 551 read tools and 560 write tools. Configure `url` with the Kubernetes API server URL and `api_token` with a bearer token that has suitable RBAC permissions.

## Usage

```lua
local pods = app.integrations.kubernetes.list_core_v1_namespaced_pod({
  namespace = 'default',
  label_selector = 'app=web'
})

local created = app.integrations.kubernetes.create_core_v1_namespaced_pod({
  namespace = 'default',
  body = { apiVersion = 'v1', kind = 'Pod', metadata = { name = 'example' }, spec = { containers = {} } }
})
```

## Request Bodies

Create, update, patch, delete-collection, and eviction-style endpoints may accept a `body` table matching the Kubernetes object or options schema for that endpoint. Path and query arguments use snake_case names and are mapped back to the official OpenAPI parameter names.

## Example Tools

| `kubernetes_get_service_account_issuer_open_idconfiguration` | read | GET `/.well-known/openid-configuration/` |
| `kubernetes_get_core_apiversions` | read | GET `/api/` |
| `kubernetes_get_core_v1_apiresources` | read | GET `/api/v1/` |
| `kubernetes_list_core_v1_component_status` | read | GET `/api/v1/componentstatuses` |
| `kubernetes_read_core_v1_component_status` | read | GET `/api/v1/componentstatuses/{name}` |
| `kubernetes_list_core_v1_config_map_for_all_namespaces` | read | GET `/api/v1/configmaps` |
| `kubernetes_list_core_v1_endpoints_for_all_namespaces` | read | GET `/api/v1/endpoints` |
| `kubernetes_list_core_v1_event_for_all_namespaces` | read | GET `/api/v1/events` |
| `kubernetes_list_core_v1_limit_range_for_all_namespaces` | read | GET `/api/v1/limitranges` |
| `kubernetes_list_core_v1_namespace` | read | GET `/api/v1/namespaces` |
| `kubernetes_create_core_v1_namespace` | write | POST `/api/v1/namespaces` |
| `kubernetes_create_core_v1_namespaced_binding` | write | POST `/api/v1/namespaces/{namespace}/bindings` |
| `kubernetes_list_core_v1_namespaced_config_map` | read | GET `/api/v1/namespaces/{namespace}/configmaps` |
| `kubernetes_create_core_v1_namespaced_config_map` | write | POST `/api/v1/namespaces/{namespace}/configmaps` |
| `kubernetes_delete_core_v1_collection_namespaced_config_map` | write | DELETE `/api/v1/namespaces/{namespace}/configmaps` |
| `kubernetes_read_core_v1_namespaced_config_map` | read | GET `/api/v1/namespaces/{namespace}/configmaps/{name}` |
| `kubernetes_replace_core_v1_namespaced_config_map` | write | PUT `/api/v1/namespaces/{namespace}/configmaps/{name}` |
| `kubernetes_patch_core_v1_namespaced_config_map` | write | PATCH `/api/v1/namespaces/{namespace}/configmaps/{name}` |
| `kubernetes_delete_core_v1_namespaced_config_map` | write | DELETE `/api/v1/namespaces/{namespace}/configmaps/{name}` |
| `kubernetes_list_core_v1_namespaced_endpoints` | read | GET `/api/v1/namespaces/{namespace}/endpoints` |
| `kubernetes_create_core_v1_namespaced_endpoints` | write | POST `/api/v1/namespaces/{namespace}/endpoints` |
| `kubernetes_delete_core_v1_collection_namespaced_endpoints` | write | DELETE `/api/v1/namespaces/{namespace}/endpoints` |
| `kubernetes_read_core_v1_namespaced_endpoints` | read | GET `/api/v1/namespaces/{namespace}/endpoints/{name}` |
| `kubernetes_replace_core_v1_namespaced_endpoints` | write | PUT `/api/v1/namespaces/{namespace}/endpoints/{name}` |
| `kubernetes_patch_core_v1_namespaced_endpoints` | write | PATCH `/api/v1/namespaces/{namespace}/endpoints/{name}` |
| `kubernetes_delete_core_v1_namespaced_endpoints` | write | DELETE `/api/v1/namespaces/{namespace}/endpoints/{name}` |
| `kubernetes_list_core_v1_namespaced_event` | read | GET `/api/v1/namespaces/{namespace}/events` |
| `kubernetes_create_core_v1_namespaced_event` | write | POST `/api/v1/namespaces/{namespace}/events` |
| `kubernetes_delete_core_v1_collection_namespaced_event` | write | DELETE `/api/v1/namespaces/{namespace}/events` |
| `kubernetes_read_core_v1_namespaced_event` | read | GET `/api/v1/namespaces/{namespace}/events/{name}` |
| `kubernetes_replace_core_v1_namespaced_event` | write | PUT `/api/v1/namespaces/{namespace}/events/{name}` |
| `kubernetes_patch_core_v1_namespaced_event` | write | PATCH `/api/v1/namespaces/{namespace}/events/{name}` |
| `kubernetes_delete_core_v1_namespaced_event` | write | DELETE `/api/v1/namespaces/{namespace}/events/{name}` |
| `kubernetes_list_core_v1_namespaced_limit_range` | read | GET `/api/v1/namespaces/{namespace}/limitranges` |
| `kubernetes_create_core_v1_namespaced_limit_range` | write | POST `/api/v1/namespaces/{namespace}/limitranges` |
| `kubernetes_delete_core_v1_collection_namespaced_limit_range` | write | DELETE `/api/v1/namespaces/{namespace}/limitranges` |
| `kubernetes_read_core_v1_namespaced_limit_range` | read | GET `/api/v1/namespaces/{namespace}/limitranges/{name}` |
| `kubernetes_replace_core_v1_namespaced_limit_range` | write | PUT `/api/v1/namespaces/{namespace}/limitranges/{name}` |
| `kubernetes_patch_core_v1_namespaced_limit_range` | write | PATCH `/api/v1/namespaces/{namespace}/limitranges/{name}` |
| `kubernetes_delete_core_v1_namespaced_limit_range` | write | DELETE `/api/v1/namespaces/{namespace}/limitranges/{name}` |


## Notes

- The API server URL is cluster-specific and must include scheme and host.
- Authentication uses `Authorization: Bearer <api_token>`.
- RBAC controls whether each operation succeeds; this integration does not bypass Kubernetes authorization.
- Returned data is the parsed JSON response from the Kubernetes API server.
