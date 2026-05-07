# Greenhouse Integration

Use the `greenhouse` integration to call Greenhouse Harvest v3 endpoints for recruiting data: candidates, applications, jobs, interviews, offers, users, approvals, custom fields, departments, offices, scorecards, and partner webhooks.

This package is generated from Greenhouse's official Harvest v3 OpenAPI registry and exposes 151 operations. Harvest v1/v2 are deprecated; this integration targets v3.

## Authentication

- Supply `access_token` to call Harvest v3 with an existing bearer token.
- Or supply `client_id` and `client_secret`; the integration calls `/auth/token` and uses the returned `access_token` for runtime calls.
- `url` defaults to `https://harvest.greenhouse.io`.

## Request Shape

Path, query, and header parameters are exposed as snake_case tool parameters. JSON request bodies are passed through the `body` object and should match the official Harvest v3 schema for that endpoint.

List filters support Greenhouse's documented shapes. For date filters such as `created_at`, pass either a preformatted string like `"gte|2024-01-01T00:00:00Z"` or an object such as `{ gte = "2024-01-01T00:00:00Z" }`. Array filters such as `ids` are serialized as comma-separated values.

## Return Shape

Responses are returned as decoded JSON from Greenhouse. Empty responses return `{ success = true, status = 204 }` plus the pagination `Link` header when present. API errors are converted to tool errors using Greenhouse's `message` or `error` response when available.

## Examples

```lua
local token = app.integrations.greenhouse.post_auth_token({
  body = { sub = 123456 }
})

local candidates = app.integrations.greenhouse.get_v3_candidates({
  per_page = 50,
  created_at = { gte = "2024-01-01T00:00:00Z" },
})

local candidate = app.integrations.greenhouse.post_v3_candidates({
  body = {
    first_name = "Ada",
    last_name = "Lovelace",
    email_addresses = {{ value = "ada@example.test", type = "personal" }},
  }
})
```

Use fake names, email addresses, IDs, and tokens in tests and examples. Never store real Greenhouse candidate, employee, job, offer, interview, webhook, or OAuth credential data in fixtures or Lua examples.
