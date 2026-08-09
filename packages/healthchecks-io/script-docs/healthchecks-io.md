# Healthchecks.io Integration

Use the `healthchecks-io` integration to manage Healthchecks.io checks and to send ping signals from agents or scripts.

The package covers the official Management API v3 documented at `https://healthchecks.io/docs/api/` and the Pinging API documented at `https://healthchecks.io/docs/http_api/`.

## Common Tools

- `healthchecks_io_list_checks`, `healthchecks_io_get_check`, `healthchecks_io_create_check`, `healthchecks_io_update_check`, `healthchecks_io_pause_check`, `healthchecks_io_resume_check`, and `healthchecks_io_delete_check` manage checks.
- `healthchecks_io_list_pings`, `healthchecks_io_get_ping_body`, and `healthchecks_io_list_flips` inspect ping history and status changes.
- `healthchecks_io_list_channels`, `healthchecks_io_list_badges`, and `healthchecks_io_get_status` cover project integrations, badges, and service health.
- `healthchecks_io_ping_success_uuid`, `healthchecks_io_ping_start_uuid`, `healthchecks_io_ping_fail_uuid`, `healthchecks_io_ping_log_uuid`, and `healthchecks_io_ping_exit_status_uuid` send UUID-based ping signals.
- `healthchecks_io_ping_success_slug`, `healthchecks_io_ping_start_slug`, `healthchecks_io_ping_fail_slug`, `healthchecks_io_ping_log_slug`, and `healthchecks_io_ping_exit_status_slug` send slug-based ping signals using a `ping_key` and `slug`.

## Request Shape

Management API tools use the configured project API key as `X-Api-Key`. POST management tools accept a `body` object with Healthchecks.io fields such as `name`, `slug`, `tags`, `desc`, `timeout`, `grace`, `schedule`, and `tz`.

Ping tools default to POST but accept `http_method = "HEAD"`, `"GET"`, or `"POST"`. For POST ping tools, use `body_text` to send diagnostic text. Slug ping tools accept `create = 1` for auto-provisioning where the Healthchecks.io Pinging API supports it.

## Return Shape

JSON responses are returned as decoded arrays/objects. Text responses, including Pinging API `OK` responses and ping body retrieval, return `{ body = <text>, status = <http_status>, content_type = <content_type> }`.

## Examples

```js
var checks = app.integrations["healthchecks-io"].list_checks({ tag: [ "backup", "prod" ] })

var created = app.integrations["healthchecks-io"].create_check({
  body: {
    name: "Database Backup",
    slug: "database-backup",
    tags: "backup prod",
    timeout: 3600,
    grace: 600,
  }
})

var ping = app.integrations["healthchecks-io"].ping_success_slug({
  ping_key: "example-ping-key",
  slug: "database-backup",
  create: 1,
  body_text: "backup completed",
})
```
Use fake UUIDs, slugs, ping keys, check names, and diagnostic text in tests and examples. Do not store real ping keys, project API keys, customer details, or production incident logs in fixtures or JavaScript examples.
