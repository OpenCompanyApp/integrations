# Clerk

Clerk tools are exposed under `app.integrations.clerk`. The integration uses Clerk's Backend API with a secret key. Do not use publishable keys.

## Raw API Helpers

Use raw helpers for Backend API endpoints that do not yet have a first-class tool:

- `clerk_api_get`
- `clerk_api_post`
- `clerk_api_patch`
- `clerk_api_delete`

Paths are relative to `https://api.clerk.com/v1`.

```js
var sessions = app.integrations.clerk.clerk_api_get({
  path: "/sessions",
  query: {
    user_id: "user_123",
  }
})
```
## Users

```js
var users = app.integrations.clerk.clerk_list_users({
  query: "alex",
  limit: 20,
})

var user = app.integrations.clerk.clerk_get_user({
  id: "user_123",
})
```
User tools include:

- `clerk_list_users`
- `clerk_count_users`
- `clerk_get_user`
- `clerk_create_user`
- `clerk_update_user`
- `clerk_delete_user`
- `clerk_ban_user`
- `clerk_unban_user`
- `clerk_lock_user`
- `clerk_unlock_user`

The existing user create/update tools keep their compatibility argument names. New endpoint-mapped tools use `user_id`.

## Sessions

```js
var active = app.integrations.clerk.clerk_list_sessions({
  user_id: "user_123",
  status: "active",
})

app.integrations.clerk.clerk_revoke_session({
  session_id: "sess_123",
})
```
Session tools:

- `clerk_list_sessions`
- `clerk_get_session`
- `clerk_revoke_session`

## Organizations

```js
var org = app.integrations.clerk.clerk_create_organization({
  name: "Example Inc",
  created_by: "user_123",
})

app.integrations.clerk.clerk_create_organization_membership({
  organization_id: "org_123",
  user_id: "user_123",
  role: "org:member",
})
```
Organization tools:

- `clerk_list_organizations`
- `clerk_create_organization`
- `clerk_get_organization`
- `clerk_update_organization`
- `clerk_delete_organization`
- `clerk_list_organization_memberships`
- `clerk_create_organization_membership`
- `clerk_update_organization_membership`
- `clerk_delete_organization_membership`
- `clerk_list_organization_invitations`
- `clerk_create_organization_invitation`
- `clerk_revoke_organization_invitation`

Organization invitation creation is rate limited by Clerk. The tool forwards Clerk API errors directly.

## Application Invitations And Sign-In Tokens

```js
var invitation = app.integrations.clerk.clerk_create_invitation({
  email_address: "person@example.test",
  redirect_url: "https://example.test/welcome",
})
```
Available tools:

- `clerk_list_invitations`
- `clerk_create_invitation`
- `clerk_revoke_invitation`
- `clerk_create_sign_in_token`
- `clerk_revoke_sign_in_token`

## Output Shape

Most tools return Clerk's parsed JSON response directly. Existing compatibility tools such as `clerk_get_current_user` keep their normalized health-check response.
