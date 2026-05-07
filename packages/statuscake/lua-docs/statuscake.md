# StatusCake Lua Tools

Namespace: `statuscake`

Generated from the official StatusCake Swagger spec linked from the developer portal. Configure `api_key`; runtime requests send `Authorization: Bearer <api_key>`.

## Coverage

- Paths: 18
- Tools: 36
- Read tools: 18
- Write tools: 18

## Usage Notes

- Path and query parameters use snake_case tool keys and are sent with official API names.
- Create/update request payloads go in `body` and are sent as form-encoded fields, matching the Swagger `application/x-www-form-urlencoded` declaration.
- Empty optional query parameters are omitted.

## Example Lua

```lua
local uptime = statuscake.statuscake_list_uptime_tests({ page = 1, limit = 25 })
local locations = statuscake.statuscake_list_uptime_monitoring_locations({})
```
