# GitGuardian Integration

Use the `gitguardian` integration to scan content for secrets and manage GitGuardian workspace resources such as incidents, sources, teams, members, SCIM users and groups, honeytokens, audit logs, custom tags, IP allowlists, invitations, and quotas.

All tools are generated from the official GitGuardian OpenAPI document at `https://api.gitguardian.com/v1/openapi.json`. Configure a GitGuardian API key; runtime calls send `Authorization: Token <api_key>`.

## Common Tools

- `gitguardian_content_scan`, `gitguardian_multiple_scan`, and `gitguardian_scan_create_incidents` scan content and optionally create incidents.
- `gitguardian_list_incidents`, `gitguardian_retrieve_incidents`, `gitguardian_update_secret_incident`, and action tools manage internal secret incidents.
- Public incident, note, member, team, invitation, source, honeytoken, custom tag, IP allowlist, audit log, and SCIM tools map directly to the official v1 endpoints.
- SCIM tools use `application/scim+json` request bodies where the upstream spec requires it.

## Return Shape

JSON responses are returned as decoded arrays/objects from GitGuardian. Empty successful responses return `{ success = true, status = <http_status> }`.

## Examples

```lua
local scan = app.integrations.gitguardian.content_scan({
  body = {
    document = "token = 'dummy-example-token'",
    filename = "example.txt"
  }
})

local incidents = app.integrations.gitguardian.list_incidents({
  per_page = 20,
  status = "TRIGGERED"
})

local token = app.integrations.gitguardian.self_retrieve_api_token({})
```

Never place real secrets, repository names, customer emails, or production source identifiers in tests, fixtures, prompts, or Lua examples.
