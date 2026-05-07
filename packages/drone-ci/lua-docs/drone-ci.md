# Drone CI

Namespace: `drone-ci`

Use the Drone CI integration to inspect and manage a Drone server through its remote API. The integration requires a Drone server URL and a user access token, then sends requests with `Authorization: Bearer <token>`.

## Common Workflows

- Use `drone_ci_get_current_user` to verify which account the token belongs to.
- Use `drone_ci_list_current_user_repos` and `drone_ci_sync_current_user` when repository discovery looks stale.
- Use `drone_ci_get_repo`, `drone_ci_enable_repo`, `drone_ci_update_repo`, `drone_ci_disable_repo`, `drone_ci_repair_repo`, and `drone_ci_chown_repo` for repository administration.
- Use `drone_ci_list_builds`, `drone_ci_get_build`, `drone_ci_create_build`, `drone_ci_restart_build`, `drone_ci_stop_build`, `drone_ci_approve_build`, `drone_ci_decline_build`, `drone_ci_promote_build`, and `drone_ci_get_build_logs` for build operations.
- Use `drone_ci_list_cron`, `drone_ci_create_cron`, `drone_ci_get_cron`, `drone_ci_update_cron`, `drone_ci_delete_cron`, and `drone_ci_trigger_cron` for repository cron jobs.
- Use `drone_ci_list_secrets`, `drone_ci_create_secret`, `drone_ci_get_secret`, `drone_ci_update_secret`, and `drone_ci_delete_secret` for repository secrets. Drone commonly returns secret metadata rather than secret values.
- Use `drone_ci_list_users` and `drone_ci_get_user` only with tokens that have enough server privileges.
- Use `drone_ci_api_get`, `drone_ci_api_post`, `drone_ci_api_patch`, and `drone_ci_api_delete` for safe relative API paths not covered by first-class tools. Full URLs are rejected.

## Argument Notes

Repository tools use `owner` and `repo` as separate arguments. Build tools use `build` for the build number. Cron and secret tools use `name` for the cron or secret name.

Write tools accept a `payload` object when the Drone API expects a JSON body. Build creation and promotion accept query-style values through either first-class keys such as `branch`, `commit`, and `target`, or a `query` object.

## Examples

```lua
local user = tools.drone_ci_get_current_user({})

local builds = tools.drone_ci_list_builds({
  owner = "acme",
  repo = "web",
  query = { branch = "main" }
})

local promoted = tools.drone_ci_promote_build({
  owner = "acme",
  repo = "web",
  build = 42,
  query = { target = "production" }
})

local secret = tools.drone_ci_create_secret({
  owner = "acme",
  repo = "web",
  payload = {
    name = "DEPLOY_TOKEN",
    data = "dummy-token",
    pull_request = false
  }
})
```

## Return Shapes

The integration returns decoded Drone JSON responses directly. Empty successful responses are normalized to:

```json
{"success": true}
```

Text responses, such as some log responses on older deployments, are normalized to:

```json
{"value": "raw response text"}
```

Self-hosted Drone deployments can differ by version and enabled features. If a route is unavailable, Drone's HTTP error is returned as a tool error rather than silently pretending the capability exists.
