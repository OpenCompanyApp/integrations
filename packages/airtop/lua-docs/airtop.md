# Airtop Integration

Airtop provides cloud browser automation through the official Airtop API. This package exposes generated tools from `https://docs.airtop.ai/openapi.json`.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | Yes | Airtop API key sent as a Bearer token. |
| `url` | url | No | API base URL. Default is `https://api.airtop.ai/api`. |

## Usage Pattern

Tool names are generated from official Airtop operation IDs:

- `airtop_sessions_create`
- `airtop_sessions_get_info`
- `airtop_sessions_windows_load_url`
- `airtop_sessions_windows_scrape_content`
- `airtop_sessions_windows_page_query`
- `airtop_requests_status_get_request_status`

Path and query parameters are exposed as snake_case tool arguments. JSON request payloads are passed through `body` with Airtop's official field names.

```lua
local session = airtop_sessions_create({
  body = {
    configuration = {
      timeoutMinutes = 10
    }
  }
})
```

```lua
local window = airtop_sessions_windows_create({
  session_id = session.id,
  body = {
    url = "https://example.test"
  }
})
```

Some official operation IDs are generic. This integration prefixes them with the API resource path so the tool name stays unique and readable.

```lua
airtop_sessions_windows_load_url({
  session_id = "sess_123",
  window_id = "win_123",
  body = {
    url = "https://example.test"
  }
})
```

```lua
airtop_sessions_windows_scrape_content({
  session_id = "sess_123",
  window_id = "win_123",
  body = {
    includeLinks = true
  }
})
```

Async operations return a request identifier. Poll the official status endpoint:

```lua
airtop_requests_status_get_request_status({
  request_id = "req_123"
})
```

## Return Shape

Tools return Airtop's parsed JSON response. `204 No Content` responses return an empty object. Errors are normalized into tool errors that include the Airtop HTTP status and message when available.

## Notes

- This package covers the official OpenAPI operations available in the Airtop API document: sessions, windows, sync and async automation, form filling, page querying, scraping, screenshots, profiles, automations, files, and request status.
- Prefer exact `body` objects from the Airtop API documentation when using write tools.
- Use fake session IDs, URLs, and file names in examples and tests.
