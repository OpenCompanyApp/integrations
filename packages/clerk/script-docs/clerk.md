# Clerk

Clerk tools are exposed under `app.integrations.clerk`. The integration uses Clerk's Backend API with a secret key. Do not use publishable keys.

## Raw API Helpers

Use raw helpers for Backend API endpoints that do not yet have a first-class tool:

- `clerk_api_get`
- `clerk_api_post`
- `clerk_api_patch`
- `clerk_api_delete`

Paths are relative to `https://api.clerk.com/v1`.

```ruby
sessions = app.integrations.clerk.api_get(path: "/sessions", query: {user_id: "user_123"})
```
## Users

```ruby
users = app.integrations.clerk.list_users(query: "alex", limit: 20)
user = app.integrations.clerk.get_user(id: "user_123")
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

```ruby
active = app.integrations.clerk.list_sessions(user_id: "user_123", status: "active")
app.integrations.clerk.revoke_session(session_id: "sess_123")
```
Session tools:

- `clerk_list_sessions`
- `clerk_get_session`
- `clerk_revoke_session`

## Organizations

```ruby
org = app.integrations.clerk.create_organization(name: "Example Inc", created_by: "user_123")
app.integrations.clerk.create_organization_membership(organization_id: "org_123", user_id: "user_123", role: "org:member")
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

```ruby
invitation = app.integrations.clerk.create_invitation(email_address: "person@example.test", redirect_url: "https://example.test/welcome")
```
Available tools:

- `clerk_list_invitations`
- `clerk_create_invitation`
- `clerk_revoke_invitation`
- `clerk_create_sign_in_token`
- `clerk_revoke_sign_in_token`

## Output Shape

Most tools return Clerk's parsed JSON response directly. Existing compatibility tools such as `clerk_get_current_user` keep their normalized health-check response.
