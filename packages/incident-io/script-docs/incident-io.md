# incident.io JavaScript API

Generated from incident.io's official OpenAPI v3 endpoint at `https://api.incident.io/v1/openapiV3.json`. The namespace is `app.integrations["incident-io"]`.

This package exposes 169 endpoint-specific tools: 86 read tools and 83 write tools. Use an incident.io API key with the permissions required for the endpoints you call.

## Usage

```js
var identity = app.integrations["incident-io"].utilities_v1_identity({})

var incidents = app.integrations["incident-io"].incidents_v2_list({
  page_size: 25,
})
```
## Request Bodies

Tools that create, update, rotate, trigger, archive, or delete resources may accept a `body` table. The table is passed as the JSON body expected by the incident.io OpenAPI schema. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Example Tools

| `incident_io_actions_v1_list` | read | GET `/v1/actions` |
| `incident_io_actions_v1_show` | read | GET `/v1/actions/{id}` |
| `incident_io_api_keys_v1_list` | read | GET `/v1/api_keys` |
| `incident_io_api_keys_v1_create` | write | POST `/v1/api_keys` |
| `incident_io_api_keys_v1_show` | read | GET `/v1/api_keys/{id}` |
| `incident_io_api_keys_v1_update` | write | PUT `/v1/api_keys/{id}` |
| `incident_io_api_keys_v1_delete` | write | DELETE `/v1/api_keys/{id}` |
| `incident_io_api_keys_v1_rotate` | write | POST `/v1/api_keys/{id}/actions/rotate` |
| `incident_io_custom_field_options_v1_list` | read | GET `/v1/custom_field_options` |
| `incident_io_custom_field_options_v1_create` | write | POST `/v1/custom_field_options` |
| `incident_io_custom_field_options_v1_show` | read | GET `/v1/custom_field_options/{id}` |
| `incident_io_custom_field_options_v1_update` | write | PUT `/v1/custom_field_options/{id}` |
| `incident_io_custom_field_options_v1_delete` | write | DELETE `/v1/custom_field_options/{id}` |
| `incident_io_custom_fields_v1_list` | read | GET `/v1/custom_fields` |
| `incident_io_custom_fields_v1_create` | write | POST `/v1/custom_fields` |
| `incident_io_custom_fields_v1_show` | read | GET `/v1/custom_fields/{id}` |
| `incident_io_custom_fields_v1_update` | write | PUT `/v1/custom_fields/{id}` |
| `incident_io_custom_fields_v1_delete` | write | DELETE `/v1/custom_fields/{id}` |
| `incident_io_utilities_v1_identity` | read | GET `/v1/identity` |
| `incident_io_incident_attachments_v1_list` | read | GET `/v1/incident_attachments` |
| `incident_io_incident_attachments_v1_create` | write | POST `/v1/incident_attachments` |
| `incident_io_incident_attachments_v1_delete` | write | DELETE `/v1/incident_attachments/{id}` |
| `incident_io_incident_memberships_v1_create` | write | POST `/v1/incident_memberships` |
| `incident_io_incident_memberships_v1_revoke` | write | POST `/v1/incident_memberships/actions/revoke` |
| `incident_io_incident_relationships_v1_list` | read | GET `/v1/incident_relationships` |
| `incident_io_incident_roles_v1_list` | read | GET `/v1/incident_roles` |
| `incident_io_incident_roles_v1_create` | write | POST `/v1/incident_roles` |
| `incident_io_incident_roles_v1_show` | read | GET `/v1/incident_roles/{id}` |


## Notes

- The base URL defaults to `https://api.incident.io`.
- Authentication uses `Authorization: Bearer <api_key>`.
- Returned data is the parsed JSON response from incident.io, including pagination or error fields where provided by the API.
