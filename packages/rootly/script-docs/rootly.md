# Rootly JavaScript API

Generated from Rootly's official OpenAPI document at `https://rootly-heroku.s3.amazonaws.com/swagger/v1/swagger.json`. The namespace is `app.integrations.rootly`.

This package exposes 536 endpoint-specific tools: 219 read tools and 317 write tools. Use a Rootly API token with permissions for the endpoints you call.

## Usage

```js
var incidents = app.integrations.rootly.list_incidents({
  page_number: 1,
  page_size: 10,
})

var incident = app.integrations.rootly.get_incident({ id: "00000000-0000-0000-0000-000000000000" })
```
## Request Bodies

Tools that create, update, patch, or delete resources may accept a `body` table. Rootly follows JSON:API; body tables should match the upstream schema and are sent with `application/vnd.api+json`. Path and query arguments use snake_case names and are mapped back to the official parameter names, including JSON:API pagination keys like `page[number]`.

## Example Tools

| `rootly_list_alert_events` | read | GET `/v1/alerts/{alert_id}/events` |
| `rootly_create_alert_event` | write | POST `/v1/alerts/{alert_id}/events` |
| `rootly_get_alert_event` | read | GET `/v1/alert_events/{id}` |
| `rootly_update_alert_event` | write | PATCH `/v1/alert_events/{id}` |
| `rootly_delete_alert_event` | write | DELETE `/v1/alert_events/{id}` |
| `rootly_list_alert_fields` | read | GET `/v1/alert_fields` |
| `rootly_create_alert_field` | write | POST `/v1/alert_fields` |
| `rootly_get_alert_field` | read | GET `/v1/alert_fields/{id}` |
| `rootly_update_alert_field` | write | PUT `/v1/alert_fields/{id}` |
| `rootly_delete_alert_field` | write | DELETE `/v1/alert_fields/{id}` |
| `rootly_list_alert_groups` | read | GET `/v1/alert_groups` |
| `rootly_create_alert_group` | write | POST `/v1/alert_groups` |
| `rootly_get_alert_group` | read | GET `/v1/alert_groups/{id}` |
| `rootly_update_alert_group` | write | PATCH `/v1/alert_groups/{id}` |
| `rootly_delete_alert_group` | write | DELETE `/v1/alert_groups/{id}` |
| `rootly_list_alert_routes` | read | GET `/v1/alert_routes` |
| `rootly_create_alert_route` | write | POST `/v1/alert_routes` |
| `rootly_get_alert_route` | read | GET `/v1/alert_routes/{id}` |
| `rootly_update_alert_route` | write | PUT `/v1/alert_routes/{id}` |
| `rootly_patch_alert_route` | write | PATCH `/v1/alert_routes/{id}` |
| `rootly_delete_alert_route` | write | DELETE `/v1/alert_routes/{id}` |
| `rootly_list_alert_routing_rules` | read | GET `/v1/alert_routing_rules` |
| `rootly_create_alert_routing_rule` | write | POST `/v1/alert_routing_rules` |
| `rootly_get_alert_routing_rule` | read | GET `/v1/alert_routing_rules/{id}` |
| `rootly_update_alert_routing_rule` | write | PUT `/v1/alert_routing_rules/{id}` |
| `rootly_delete_alert_routing_rule` | write | DELETE `/v1/alert_routing_rules/{id}` |
| `rootly_list_alert_urgencies` | read | GET `/v1/alert_urgencies` |
| `rootly_create_alert_urgency` | write | POST `/v1/alert_urgencies` |
| `rootly_get_alert_urgency` | read | GET `/v1/alert_urgencies/{id}` |
| `rootly_update_alert_urgency` | write | PUT `/v1/alert_urgencies/{id}` |
| `rootly_delete_alert_urgency` | write | DELETE `/v1/alert_urgencies/{id}` |
| `rootly_list_alerts_sources` | read | GET `/v1/alert_sources` |


## Notes

- The base URL defaults to `https://api.rootly.com`.
- Authentication uses `Authorization: Bearer <api_token>`.
- Returned data is the parsed JSON response from Rootly, preserving JSON:API `data`, `links`, and `meta` shapes.
