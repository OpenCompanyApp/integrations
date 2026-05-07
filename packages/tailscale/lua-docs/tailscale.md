# Tailscale Lua API

Generated from Tailscale's official OpenAPI 3.1 document served by `https://api.tailscale.com/api/v2`. The namespace is `app.integrations.tailscale`.

This package exposes 85 endpoint-specific tools: 32 read tools and 53 write tools. Configure `api_token` with a Tailscale API access token.

## Usage

```lua
local devices = app.integrations.tailscale.list_tailnet_devices({
  tailnet = '-',
  fields = 'all'
})

local key = app.integrations.tailscale.create_key({
  tailnet = '-',
  body = { capabilities = { devices = { create = { reusable = false } } } }
})
```

## Request Bodies

Tools that create, update, patch, or delete resources may accept a `body` table. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Example Tools

| `tailscale_list_tailnet_devices` | read | GET `/tailnet/{tailnet}/devices` |
| `tailscale_batch_update_custom_device_posture_attributes` | write | PATCH `/tailnet/{tailnet}/device-attributes` |
| `tailscale_get_device` | read | GET `/device/{deviceId}` |
| `tailscale_delete_device` | write | DELETE `/device/{deviceId}` |
| `tailscale_expire_device_key` | write | POST `/device/{deviceId}/expire` |
| `tailscale_list_device_routes` | read | GET `/device/{deviceId}/routes` |
| `tailscale_set_device_routes` | write | POST `/device/{deviceId}/routes` |
| `tailscale_authorize_device` | write | POST `/device/{deviceId}/authorized` |
| `tailscale_set_device_name` | write | POST `/device/{deviceId}/name` |
| `tailscale_set_device_tags` | write | POST `/device/{deviceId}/tags` |
| `tailscale_update_device_key` | write | POST `/device/{deviceId}/key` |
| `tailscale_set_device_ip` | write | POST `/device/{deviceId}/ip` |
| `tailscale_get_device_posture_attributes` | read | GET `/device/{deviceId}/attributes` |
| `tailscale_set_custom_device_posture_attributes` | write | POST `/device/{deviceId}/attributes/{attributeKey}` |
| `tailscale_delete_custom_device_posture_attributes` | write | DELETE `/device/{deviceId}/attributes/{attributeKey}` |
| `tailscale_list_device_invites` | read | GET `/device/{deviceId}/device-invites` |
| `tailscale_create_device_invites` | write | POST `/device/{deviceId}/device-invites` |
| `tailscale_list_user_invites` | read | GET `/tailnet/{tailnet}/user-invites` |
| `tailscale_create_user_invites` | write | POST `/tailnet/{tailnet}/user-invites` |
| `tailscale_get_user_invite` | read | GET `/user-invites/{userInviteId}` |
| `tailscale_delete_user_invite` | write | DELETE `/user-invites/{userInviteId}` |
| `tailscale_resend_user_invite` | write | POST `/user-invites/{userInviteId}/resend` |
| `tailscale_get_device_invite` | read | GET `/device-invites/{deviceInviteId}` |
| `tailscale_delete_device_invite` | write | DELETE `/device-invites/{deviceInviteId}` |
| `tailscale_resend_device_invite` | write | POST `/device-invites/{deviceInviteId}/resend` |
| `tailscale_accept_device_invite` | write | POST `/device-invites/-/accept` |
| `tailscale_list_configuration_audit_logs` | read | GET `/tailnet/{tailnet}/logging/configuration` |
| `tailscale_list_network_flow_logs` | read | GET `/tailnet/{tailnet}/logging/network` |
| `tailscale_get_log_streaming_status` | read | GET `/tailnet/{tailnet}/logging/{logType}/stream/status` |
| `tailscale_get_log_streaming_configuration` | read | GET `/tailnet/{tailnet}/logging/{logType}/stream` |
| `tailscale_set_log_streaming_configuration` | write | PUT `/tailnet/{tailnet}/logging/{logType}/stream` |
| `tailscale_disable_log_streaming` | write | DELETE `/tailnet/{tailnet}/logging/{logType}/stream` |


## Notes

- The base URL defaults to `https://api.tailscale.com/api/v2`.
- Tailscale allows `-` as the `tailnet` path value for the default tailnet.
- Authentication uses HTTP Basic auth with the API token as username and an empty password.
- Returned data is the parsed JSON response from Tailscale.
