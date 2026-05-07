# Integration: Wildix

Wildix WMS/PBX integration for Laravel and AI agents. The package exposes the official command surface from `@wildix/wms-api-client` for call control, PBX users, groups, departments, OAuth clients, notifications, and PBX administration.

## Source Coverage

The tool catalog is generated from the official Wildix WMS API client package (`@wildix/wms-api-client` 1.2.2). That SDK targets Wildix PBX hosts such as `https://example.wildixin.com` and signs requests with a bearer token.

## Installation

```bash
composer require opencompanyapp/integration-wildix
```

## Configuration

```php
'wildix' => [
    'access_token' => env('WILDIX_ACCESS_TOKEN'),
    'url' => env('WILDIX_URL'), // https://example.wildixin.com
],
```

## Tools

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

All tools accept normalized snake_case arguments. Path, query, and body fields are mapped back to the official Wildix API field names before the request is sent. Advanced callers can pass `query` and `payload` objects for documented fields that are not useful as first-class agent parameters.
