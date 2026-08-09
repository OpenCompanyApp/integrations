# FireHydrant JavaScript API

Generated from FireHydrant's official ReadMe API registry OpenAPI document (`dnq41ujmori9g73`). The namespace is `app.integrations.firehydrant`.

This package exposes 477 endpoint-specific tools: 218 read tools and 259 write tools. Use a FireHydrant API token with permissions for the endpoints you call.

## Usage

```js
var ping = app.integrations.firehydrant.ping({})

var incidents = app.integrations.firehydrant.list_incidents({
  page: 1,
  per_page: 25,
})
```
## Request Bodies

Tools that create, update, patch, or delete resources may accept a `body` table. The table is passed as the JSON body expected by the FireHydrant OpenAPI schema. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Example Tools

| `firehydrant_ping` | read | GET `/v1/ping` |
| `firehydrant_list_environments` | read | GET `/v1/environments` |
| `firehydrant_create_environment` | write | POST `/v1/environments` |
| `firehydrant_get_environment` | read | GET `/v1/environments/{environment_id}` |
| `firehydrant_update_environment` | write | PATCH `/v1/environments/{environment_id}` |
| `firehydrant_delete_environment` | write | DELETE `/v1/environments/{environment_id}` |
| `firehydrant_list_environment_services` | read | GET `/v1/environments/{environment_id}/services` |
| `firehydrant_list_environment_functionalities` | read | GET `/v1/environments/{environment_id}/functionalities` |
| `firehydrant_list_services` | read | GET `/v1/services` |
| `firehydrant_create_service` | write | POST `/v1/services` |
| `firehydrant_create_service_links` | write | POST `/v1/services/service_links` |
| `firehydrant_get_service` | read | GET `/v1/services/{service_id}` |
| `firehydrant_update_service` | write | PATCH `/v1/services/{service_id}` |
| `firehydrant_delete_service` | write | DELETE `/v1/services/{service_id}` |
| `firehydrant_list_service_environments` | read | GET `/v1/services/{service_id}/environments` |
| `firehydrant_get_service_dependencies` | read | GET `/v1/services/{service_id}/dependencies` |
| `firehydrant_list_service_available_upstream_dependencies` | read | GET `/v1/services/{service_id}/available_upstream_dependencies` |
| `firehydrant_list_service_available_downstream_dependencies` | read | GET `/v1/services/{service_id}/available_downstream_dependencies` |
| `firehydrant_delete_service_link` | write | DELETE `/v1/services/{service_id}/service_links/{remote_id}` |
| `firehydrant_create_service_checklist_response` | write | POST `/v1/services/{service_id}/checklist_response/{checklist_id}` |
| `firehydrant_create_service_dependency` | write | POST `/v1/service_dependencies` |
| `firehydrant_get_service_dependency` | read | GET `/v1/service_dependencies/{service_dependency_id}` |
| `firehydrant_update_service_dependency` | write | PATCH `/v1/service_dependencies/{service_dependency_id}` |
| `firehydrant_delete_service_dependency` | write | DELETE `/v1/service_dependencies/{service_dependency_id}` |
| `firehydrant_list_functionalities` | read | GET `/v1/functionalities` |
| `firehydrant_create_functionality` | write | POST `/v1/functionalities` |
| `firehydrant_get_functionality` | read | GET `/v1/functionalities/{functionality_id}` |
| `firehydrant_update_functionality` | write | PATCH `/v1/functionalities/{functionality_id}` |
| `firehydrant_delete_functionality` | write | DELETE `/v1/functionalities/{functionality_id}` |
| `firehydrant_list_functionality_environments` | read | GET `/v1/functionalities/{functionality_id}/environments` |
| `firehydrant_list_functionality_services` | read | GET `/v1/functionalities/{functionality_id}/services` |
| `firehydrant_list_teams` | read | GET `/v1/teams` |


## Notes

- The base URL defaults to `https://api.firehydrant.io`.
- EU organizations can set `url` to `https://api.eu.firehydrant.io`.
- Authentication uses `Authorization: Bearer <api_token>`.
- Returned data is the parsed JSON response from FireHydrant.
