# Dialpad JavaScript Tools

Namespace: `dialpad`

The Dialpad integration exposes 193 operations from the official Dialpad API spec shipped with `dialpad-python-sdk`. Use these tools for users, calls, SMS, numbers, offices, departments, rooms, call centers, channels, contacts, webhooks, websocket subscriptions, stats jobs, transcripts, and access-control policies.

## Auth

Configure `access_token`. Use `url = "https://sandbox.dialpad.com"` for sandbox calls. The default `auth_mode` is `bearer`; use `query` only if the target host expects the documented `apikey` query parameter.

## Examples

```js
var company = app.integrations.dialpad.company_get({})

var users = app.integrations.dialpad.users_list({
  state: "active",
  email: "user@example.test",
})

var message = app.integrations.dialpad.sms_send({
  body: {
    text: "Hello from an agent",
    to_numbers: [ "+14155550100" ],
    user_id: "123456789",
  }
})
```
## Common Tools

| Tool | Endpoint | Area |
|------|----------|------|
| `dialpad_accesscontrolpolicies_assign` | POST `/api/v2/accesscontrolpolicies/{id}/assign` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_assignments` | GET `/api/v2/accesscontrolpolicies/{id}/assignments` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_create` | POST `/api/v2/accesscontrolpolicies` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_delete` | DELETE `/api/v2/accesscontrolpolicies/{id}` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_get` | GET `/api/v2/accesscontrolpolicies/{id}` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_list` | GET `/api/v2/accesscontrolpolicies` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_unassign` | POST `/api/v2/accesscontrolpolicies/{id}/unassign` | accesscontrolpolicies |
| `dialpad_accesscontrolpolicies_update` | PATCH `/api/v2/accesscontrolpolicies/{id}` | accesscontrolpolicies |
| `dialpad_app_settings_get` | GET `/api/v2/app/settings` | app |
| `dialpad_blockednumbers_add` | POST `/api/v2/blockednumbers/add` | blockednumbers |
| `dialpad_blockednumbers_get` | GET `/api/v2/blockednumbers/{number}` | blockednumbers |
| `dialpad_blockednumbers_list` | GET `/api/v2/blockednumbers` | blockednumbers |
| `dialpad_blockednumbers_remove` | POST `/api/v2/blockednumbers/remove` | blockednumbers |
| `dialpad_call_actions_hangup` | PUT `/api/v2/call/{id}/actions/hangup` | call |
| `dialpad_call_call` | POST `/api/v2/call` | call |
| `dialpad_call_get_call_info` | GET `/api/v2/call/{id}` | call |
| `dialpad_call_initiate_ivr_call` | POST `/api/v2/call/initiate_ivr_call` | call |
| `dialpad_call_list` | GET `/api/v2/call` | call |
| `dialpad_call_participants_add` | POST `/api/v2/call/{id}/participants/add` | call |
| `dialpad_call_put_call_labels` | PUT `/api/v2/call/{id}/labels` | call |
| `dialpad_call_transfer_call` | POST `/api/v2/call/{id}/transfer` | call |
| `dialpad_call_unpark` | POST `/api/v2/call/{id}/unpark` | call |
| `dialpad_call_callback` | POST `/api/v2/callback` | callback |
| `dialpad_call_validate_callback` | POST `/api/v2/callback/validate` | callback |
| `dialpad_callcenters_create` | POST `/api/v2/callcenters` | callcenters |
| `dialpad_callcenters_delete` | DELETE `/api/v2/callcenters/{id}` | callcenters |
| `dialpad_callcenters_get` | GET `/api/v2/callcenters/{id}` | callcenters |
| `dialpad_callcenters_listall` | GET `/api/v2/callcenters` | callcenters |
| `dialpad_callcenters_operators_delete` | DELETE `/api/v2/callcenters/{id}/operators` | callcenters |
| `dialpad_callcenters_operators_dutystatus` | PATCH `/api/v2/callcenters/operators/{id}/dutystatus` | callcenters |
| `dialpad_callcenters_operators_get` | GET `/api/v2/callcenters/{id}/operators` | callcenters |
| `dialpad_callcenters_operators_get_dutystatus` | GET `/api/v2/callcenters/operators/{id}/dutystatus` | callcenters |
| `dialpad_callcenters_operators_get_skilllevel` | GET `/api/v2/callcenters/{call_center_id}/operators/{user_id}/skill` | callcenters |
| `dialpad_callcenters_operators_post` | POST `/api/v2/callcenters/{id}/operators` | callcenters |
| `dialpad_callcenters_operators_skilllevel` | PATCH `/api/v2/callcenters/{call_center_id}/operators/{user_id}/skill` | callcenters |
| `dialpad_callcenters_status` | GET `/api/v2/callcenters/{id}/status` | callcenters |
| `dialpad_callcenters_update` | PATCH `/api/v2/callcenters/{id}` | callcenters |
| `dialpad_calllabel_list` | GET `/api/v2/calllabels` | calllabels |
| `dialpad_call_review_share_link_create` | POST `/api/v2/callreviewsharelink` | callreviewsharelink |
| `dialpad_call_review_share_link_delete` | DELETE `/api/v2/callreviewsharelink/{id}` | callreviewsharelink |
| `dialpad_call_review_share_link_get` | GET `/api/v2/callreviewsharelink/{id}` | callreviewsharelink |
| `dialpad_call_review_share_link_update` | PUT `/api/v2/callreviewsharelink/{id}` | callreviewsharelink |
| `dialpad_callrouters_create` | POST `/api/v2/callrouters` | callrouters |
| `dialpad_callrouters_delete` | DELETE `/api/v2/callrouters/{id}` | callrouters |
| `dialpad_callrouters_get` | GET `/api/v2/callrouters/{id}` | callrouters |
| `dialpad_callrouters_list` | GET `/api/v2/callrouters` | callrouters |
| `dialpad_callrouters_update` | PATCH `/api/v2/callrouters/{id}` | callrouters |
| `dialpad_numbers_assign_call_router_number_post` | POST `/api/v2/callrouters/{id}/assign_number` | callrouters |
| `dialpad_channels_delete` | DELETE `/api/v2/channels/{id}` | channels |
| `dialpad_channels_get` | GET `/api/v2/channels/{id}` | channels |
| `dialpad_channels_list` | GET `/api/v2/channels` | channels |
| `dialpad_channels_members_delete` | DELETE `/api/v2/channels/{id}/members` | channels |
| `dialpad_channels_members_list` | GET `/api/v2/channels/{id}/members` | channels |
| `dialpad_channels_members_post` | POST `/api/v2/channels/{id}/members` | channels |
| `dialpad_channels_post` | POST `/api/v2/channels` | channels |
| `dialpad_coaching_team_get` | GET `/api/v2/coachingteams/{id}` | coachingteams |
| `dialpad_coaching_team_listall` | GET `/api/v2/coachingteams` | coachingteams |
| `dialpad_coaching_team_members_add` | POST `/api/v2/coachingteams/{id}/members` | coachingteams |
| `dialpad_coaching_team_members_get` | GET `/api/v2/coachingteams/{id}/members` | coachingteams |
| `dialpad_company_get` | GET `/api/v2/company` | company |
| `dialpad_company_sms_opt_out` | GET `/api/v2/company/{id}/smsoptout` | company |
| `dialpad_conference_meetings_list` | GET `/api/v2/conference/meetings` | conference |
| `dialpad_conference_rooms_list` | GET `/api/v2/conference/rooms` | conference |
| `dialpad_contacts_create` | POST `/api/v2/contacts` | contacts |
| `dialpad_contacts_create_with_uid` | PUT `/api/v2/contacts` | contacts |
| `dialpad_contacts_delete` | DELETE `/api/v2/contacts/{id}` | contacts |
| `dialpad_contacts_get` | GET `/api/v2/contacts/{id}` | contacts |
| `dialpad_contacts_list` | GET `/api/v2/contacts` | contacts |
| `dialpad_contacts_update` | PATCH `/api/v2/contacts/{id}` | contacts |
| `dialpad_custom_ivrs_get` | GET `/api/v2/customivrs` | customivrs |
| `dialpad_ivr_create` | POST `/api/v2/customivrs` | customivrs |
| `dialpad_ivr_delete` | DELETE `/api/v2/customivrs/{target_type}/{target_id}/{ivr_type}` | customivrs |
| `dialpad_ivr_update` | PATCH `/api/v2/customivrs/{target_type}/{target_id}/{ivr_type}` | customivrs |
| `dialpad_ivr_details_update` | PATCH `/api/v2/customivrs/{ivr_id}` | customivrs |
| `dialpad_departments_create` | POST `/api/v2/departments` | departments |
| `dialpad_departments_delete` | DELETE `/api/v2/departments/{id}` | departments |
| `dialpad_departments_get` | GET `/api/v2/departments/{id}` | departments |
| `dialpad_departments_listall` | GET `/api/v2/departments` | departments |
| `dialpad_departments_operators_delete` | DELETE `/api/v2/departments/{id}/operators` | departments |
| `dialpad_departments_operators_get` | GET `/api/v2/departments/{id}/operators` | departments |

The full generated catalog contains all operations from the official Dialpad spec.