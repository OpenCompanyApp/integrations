# Bitwarden

JavaScript namespace: `bitwarden`

This integration covers the Bitwarden Public API for organization administration. It manages organization collections, event logs, groups, members, subscription details, organization imports, and policies. It does not manage individual vault items; Bitwarden documents that as a separate Vault Management API.

## Authentication

Use an organization API key from the Admin Console, not a personal API key. Configure `client_id` and `client_secret` to let the integration fetch an OAuth client-credentials bearer token with `scope=api.organization`. You can also provide a short-lived `access_token` directly for testing.

Cloud defaults are `https://api.bitwarden.com` and `https://identity.bitwarden.com/connect/token`. EU and self-hosted deployments should set both `api_url` and `identity_url` so the token and API hosts match.

## Common Workflows

- List collections with `bitwarden_collections_list`, then read or update one with `bitwarden_collections_get` or `bitwarden_collections_put`.
- List groups with `bitwarden_groups_list`, update membership ids with `bitwarden_groups_put_member_ids`, or read group member ids with `bitwarden_groups_get_member_ids`.
- Invite and manage members with `bitwarden_members_post`, `bitwarden_members_revoke`, `bitwarden_members_restore`, and `bitwarden_members_post_reinvite`.
- Audit organization activity with `bitwarden_events_list`; use `start`, `end`, and `continuation_token` for bounded pagination.
- Read and update organization policies with `bitwarden_policies_list`, `bitwarden_policies_get`, and `bitwarden_policies_put`.

## Payload Notes

Write tools accept a `body` object matching Bitwarden's official Public API request schema. List responses commonly use Bitwarden's list envelope, for example `object`, `data`, and sometimes `continuationToken`. The tools return the API response without flattening so agents can preserve Bitwarden-specific fields.

## Safe Example

```js
var members = bitwarden_members_list({})
var events = bitwarden_events_list({
  start: "2026-01-01T00:00:00Z",
  end: "2026-01-31T23:59:59Z",
})
```