# Wildix JavaScript API Reference

Namespace: `app.integrations.wildix`

This integration exposes the official Wildix WMS/PBX API surface from the `@wildix/wms-api-client` package. Configure it with a bearer token and your PBX API base URL, usually `https://example.wildixin.com`.

## Usage Pattern

```js
var result = app.integrations.wildix.get_personal_info({})
```
Tool arguments use snake_case. The integration maps them back to Wildix request fields such as `sipCallId`, `groupDn`, `redirectUri`, and filter query names before sending the HTTP request.

## Operation Coverage

| `wildix_call_control_answer` | write | POST `/api/v2/call-control/answer` |
| `wildix_call_control_attendant_transfer` | write | POST `/api/v2/call-control/attendant-transfer` |
| `wildix_call_control_blind_transfer` | write | POST `/api/v2/call-control/blind-transfer` |
| `wildix_call_control_dtmf` | write | POST `/api/v2/call-control/dtmf` |
| `wildix_call_control_hangup` | write | POST `/api/v2/call-control/hangup` |
| `wildix_call_control_hold` | write | POST `/api/v2/call-control/hold` |
| `wildix_call_control_make_call` | write | POST `/api/v2/call-control/make-call` |
| `wildix_call_control_unhold` | write | POST `/api/v2/call-control/unhold` |
| `wildix_call_control_update_contact_info` | write | POST `/api/v2/call-control/update-contact-info` |
| `wildix_create_pbx_acl_group` | write | POST `/api/v1/pbx/aclgroups` |
| `wildix_create_pbx_colleague` | write | POST `/api/v1/PBX/Colleagues` |
| `wildix_create_pbx_o_auth2_client` | write | POST `/api/v1/pbx/applications/oauth2` |
| `wildix_delete_pbx_acl_group` | write | DELETE `/api/v1/pbx/aclgroups/{id}` |
| `wildix_delete_pbx_colleague` | write | DELETE `/api/v1/PBX/Colleagues/{id}` |
| `wildix_delete_pbx_o_auth2_client` | write | DELETE `/api/v1/pbx/applications/oauth2/{id}` |
| `wildix_get_call_queues_settings` | read | GET `/api/v1/pbx/settings/callqueues/{groupId}` |
| `wildix_get_colleague_by_id` | read | GET `/api/v1/Colleagues/{id}` |
| `wildix_get_pbx_acl_groups_permissions` | read | GET `/api/v1/pbx/aclgroups/permissions` |
| `wildix_get_pbx_call_groups` | read | GET `/api/v1/Dialplan/CallGroups` |
| `wildix_get_pbx_colleagues` | read | GET `/api/v1/PBX/Colleagues` |
| `wildix_get_pbxes` | read | GET `/api/v1/network/pbxes` |
| `wildix_get_pbx_o_auth2_clients` | read | GET `/api/v1/pbx/applications/oauth2` |
| `wildix_get_personal_info` | read | GET `/api/v1/personal/info` |
| `wildix_list_pbx_departments` | read | GET `/api/v1/Departments` |
| `wildix_list_pbx_groups` | read | GET `/api/v1/Groups` |
| `wildix_list_user_active_calls` | read | GET `/api/v2/call-control/list-calls` |
| `wildix_list_user_devices` | read | GET `/api/v2/call-control/list-devices` |
| `wildix_notifications` | write | POST `/api/v1/notifications` |
| `wildix_originate` | write | POST `/api/v1/originate` |
| `wildix_originate_call` | write | POST `/api/v1/originate/call` |
| `wildix_reload_broadcasts` | write | POST `/api/v1/broadcasts/reload` |
| `wildix_update_pbx_o_auth2_client` | write | PUT `/api/v1/pbx/applications/oauth2/{id}` |

## Examples

### List active calls for the authenticated user

```js
var calls = app.integrations.wildix.list_user_active_calls({})
```
### Make a call

```js
var result = app.integrations.wildix.call_control_make_call({
  destination: "+15550101000",
  device: "Web",
})
```
### Get PBX colleagues with filters

```js
var users = app.integrations.wildix.get_pbx_colleagues({
  count: 25,
  start: 0,
  query: {
    ["filter[email][]"]: [ "ada@example.test" ]
  }
})
```
### Create an OAuth2 client

```js
var client = app.integrations.wildix.create_pbx_o_auth2_client({
  name: "Agent App",
  redirect_uri: [ "https://example.test/oauth/callback" ],
})
```
## Notes

Call-control tools accept an optional `user` parameter. Wildix documents that only root admin authorization can target a different user; otherwise the authorized user is used.

Write tools return the normalized JSON response from the PBX host. Empty responses are returned as `{ success = true }`.

## Multi-Account Usage

```js
app.integrations.wildix.default.get_personal_info({})
app.integrations.wildix.office.list_user_devices({})
```