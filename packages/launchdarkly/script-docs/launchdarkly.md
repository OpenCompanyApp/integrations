# LaunchDarkly JavaScript API Reference

Namespace: `app.integrations.launchdarkly`

This integration manages LaunchDarkly projects, environments, feature flags, segments, account members, and teams through the LaunchDarkly REST API. The typed tools cover common release-management workflows. The raw API tools expose the rest of `/api/v2` for newer or less common endpoints.

LaunchDarkly PATCH endpoints often expect JSON Patch arrays. Feature flags and teams may also accept semantic patch bodies for specific workflows. When in doubt, use the exact patch format from the LaunchDarkly API docs.

## Raw API Helpers

Use these when a LaunchDarkly endpoint is not covered by a first-class tool:

| Tool | Method | Notes |
|------|--------|-------|
| `api_get` | GET | Accepts `path` and optional `query` |
| `api_post` | POST | Accepts `path`, `body`, and optional `query` |
| `api_patch` | PATCH | Accepts `path`, `patch` or `body`, and optional `query` |
| `api_put` | PUT | Accepts `path`, `body`, and optional `query` |
| `api_delete` | DELETE | Accepts `path`, optional `body`, and optional `query` |

```js
var projects = app.integrations.launchdarkly.api_get({
  path: "/projects",
  query: { limit: 20 },
})

var flag = app.integrations.launchdarkly.api_get({
  path: "/flags/default/checkout-flow",
})
```
## Projects

| Tool | Purpose |
|------|---------|
| `list_projects` | List projects with normalized keys, names, tags, and environment counts |
| `get_project` | Get a normalized project summary |
| `create_project` | Create a project |
| `update_project` | Patch a project with JSON Patch |
| `delete_project` | Delete a project |

```js
var created = app.integrations.launchdarkly.create_project({
  key: "web-app",
  name: "Web App",
  tags: [ "example" ],
})

var updated = app.integrations.launchdarkly.update_project({
  project_key: "web-app",
  patch: [
    { op: "replace", path: "/name", value: "Web Application" }
  ]
})
```
Deleting a project also deletes associated environments and flags. LaunchDarkly does not allow deleting the last project in an account.

## Environments

| Tool | Purpose |
|------|---------|
| `list_environments` | List normalized environments for a project |
| `get_environment` | Get one environment |
| `create_environment` | Create an environment |
| `update_environment` | Patch an environment with JSON Patch |
| `delete_environment` | Delete an environment |

```js
var env = app.integrations.launchdarkly.create_environment({
  project_key: "web-app",
  key: "qa",
  name: "QA",
  color: "DADBEE",
  requireComments: true,
})
```
## Feature Flags

| Tool | Purpose |
|------|---------|
| `list_flags` | List normalized flags and per-environment on/off states |
| `get_flag` | Get a normalized flag summary with variations and environment rules |
| `create_feature_flag` | Create a flag |
| `update_feature_flag` | Patch a flag |
| `toggle_flag` | Turn a flag on or off for one environment |
| `copy_feature_flag` | Copy flag settings between environments |
| `delete_feature_flag` | Delete a flag |

```js
var flags = app.integrations.launchdarkly.list_flags({
  project_key: "web-app",
  env: "production",
  limit: 50,
})

var flag = app.integrations.launchdarkly.create_feature_flag({
  project_key: "web-app",
  key: "checkout-flow",
  name: "Checkout Flow",
  kind: "boolean",
  temporary: true,
  tags: [ "release" ],
})

var toggled = app.integrations.launchdarkly.toggle_flag({
  project_key: "web-app",
  feature_flag_key: "checkout-flow",
  environment_key: "production",
  enabled: true,
})
```
For advanced flag changes, `update_feature_flag` accepts either a JSON Patch list or a semantic patch-style body:

```js
var patched = app.integrations.launchdarkly.update_feature_flag({
  project_key: "web-app",
  feature_flag_key: "checkout-flow",
  patch: [
    { op: "replace", path: "/environments/production/on", value: false }
  ]
})

var semantic = app.integrations.launchdarkly.update_feature_flag({
  project_key: "web-app",
  feature_flag_key: "checkout-flow",
  body: {
    environmentKey: "production",
    instructions: [
      { kind: "turnFlagOn" }
    ]
  }
})
```
The host currently sends normal JSON content headers. If a LaunchDarkly semantic patch requires the specialized semantic-patch content type in your account, use `api_patch` only after the host gains custom header support or fall back to JSON Patch.

## Segments

| Tool | Purpose |
|------|---------|
| `list_segments` | List segments for a project environment |
| `get_segment` | Get one segment |
| `create_segment` | Create a rule-based, list-based, or big segment |
| `update_segment` | Patch a segment |
| `delete_segment` | Delete a segment |

```js
var segment = app.integrations.launchdarkly.create_segment({
  project_key: "web-app",
  environment_key: "production",
  key: "beta-users",
  name: "Beta Users",
  tags: [ "example" ],
})
```
Big segments and synced segments can be Enterprise-only in LaunchDarkly. The API may reject those operations depending on the account plan.

## Members

| Tool | Purpose |
|------|---------|
| `get_current_user` | Get the authenticated member |
| `list_members` | List account members |
| `get_member` | Get one member by `_id` |
| `invite_members` | Invite one or more members |
| `update_member` | Patch a member |
| `delete_member` | Remove a member |

```js
var members = app.integrations.launchdarkly.list_members({
  limit: 20,
  filter: "query:alex",
})

var invited = app.integrations.launchdarkly.invite_members({
  body: [
    {
      email: "person@example.test",
      role: "reader",
    }
  ]
})
```
Use member IDs from the `_id` field returned by `list_members` or `invite_members`.

## Teams

| Tool | Purpose |
|------|---------|
| `list_teams` | List teams with optional expansions |
| `get_team` | Get one team |
| `create_team` | Create a team |
| `update_team` | Patch a team |
| `delete_team` | Delete a team |

```js
var teams = app.integrations.launchdarkly.list_teams({
  filter: "query:platform",
  expand: "members,maintainers",
})

var team = app.integrations.launchdarkly.create_team({
  key: "platform",
  name: "Platform",
  description: "Platform engineering",
})
```
Teams are an Enterprise feature in LaunchDarkly. Non-Enterprise accounts may receive permission or plan errors.

## Normalized Versus Raw Output

The legacy convenience tools `list_projects`, `get_project`, `list_environments`, `list_flags`, `get_flag`, `toggle_flag`, and `get_current_user` return smaller normalized payloads for agent workflows.

The newer endpoint-mapped tools return LaunchDarkly's parsed JSON response directly. For DELETE endpoints that return `204 No Content`, the tool returns an empty object.

## Multi-Account Usage

If multiple LaunchDarkly accounts are configured, use account-specific namespaces:

```js
var result = app.integrations.launchdarkly.accounts.production.list_flags({
  project_key: "web-app",
  env: "production",
})
```
## Safety Notes

- Use `example.test` or other dummy values in generated examples and tests.
- Delete operations are destructive and may remove environments, flags, project data, members, or teams.
- LaunchDarkly API tokens are sent as the `Authorization` header value exactly as configured.
