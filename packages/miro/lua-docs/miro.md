# Miro Lua Tools

Namespace: `miro`

Generated from the official Miro Developer Platform OpenAPI spec in `miroapp/api-clients`. Configure `access_token` with a Miro OAuth access token.

## Coverage

- Paths: 114
- Tools: 197
- Read tools: 85
- Write tools: 112
- Multipart upload tools: 5

## Usage Notes

- Path and query parameters use snake_case tool keys and are sent with official API names.
- JSON and `application/scim+json` request payloads go in `body`.
- Multipart upload tools also use `body`; each field can be a scalar value or a prebuilt multipart part object with `name` and `contents`.
- Some official path parameter names include generated suffixes from the Miro spec. Those names are preserved in snake_case so requests remain mechanically faithful to the source.

## Example Lua

```lua
local boards = miro.miro_get_boards({ limit = 25 })
local note = miro.miro_create_sticky_note_item({ board_id = "board-id", body = { data = { content = "Follow up" } } })
```
