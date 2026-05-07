# Render Lua Reference

Namespace: `render`

This integration covers Render's official public OpenAPI registry from `https://api-docs.render.com/openapi/render-public-api-1.json`. Tools map directly to documented operations for services, deploys, jobs, cron runs, disks, databases, key value stores, projects, environments, env groups, owners, registry credentials, logs, metrics, webhooks, workflows, tasks, maintenance, and Blueprints.

All tools return Render's JSON response directly. Endpoints that stream or return non-JSON content return `{ body, content_type }`.

## Common Patterns

List services:

```lua
local services = app.integrations.render.list_services({
  limit = 20
})
```

Create a deploy:

```lua
local deploy = app.integrations.render.create_deploy({
  service_id = "srv-example",
  body = {
    clearCache = "do_not_clear"
  }
})
```

Cancel a deploy:

```lua
app.integrations.render.cancel_deploy({
  service_id = "srv-example",
  deploy_id = "dep-example"
})
```

Read service environment variables:

```lua
local env = app.integrations.render.get_env_vars_for_service({
  service_id = "srv-example",
  limit = 50
})
```

Create a Postgres export:

```lua
local export = app.integrations.render.create_postgres_export({
  postgres_id = "dpg-example",
  body = {
    format = "custom"
  }
})
```

Query CPU metrics:

```lua
local cpu = app.integrations.render.get_cpu({
  resource = "srv-example",
  startTime = "2026-01-01T00:00:00Z",
  endTime = "2026-01-01T01:00:00Z"
})
```

## Tool Families

- Account and owners: `get_current_user`, `list_owners`, `retrieve_owner`, `retrieve_owner_members`, owner audit logs, workspace member updates
- Services: `list_services`, `create_service`, `get_service`, `update_service`, `delete_service`, `suspend_service`, `resume_service`, `restart_service`, `scale_service`, autoscaling, previews, routes, headers, custom domains, env vars, and secret files
- Deploys and jobs: `list_deploys`, `create_deploy`, `get_deploy`, `cancel_deploy`, `rollback_deploy`, `list_jobs`, `post_job`, `retrieve_job`, `cancel_job`, cron job run tools
- Datastores: disks and snapshots, Postgres, Redis, key value stores, connection info, database users, exports, recovery, failover, suspend, resume, and restart operations
- Projects and environments: projects, environments, resources, environment groups, env-group variables, and env-group secret files
- Logs and metrics: logs, log subscriptions, log streams, metrics streams, CPU, memory, HTTP, bandwidth, disk, instance, task-run, and filter-value metrics
- Automation and integrations: Blueprints, registry credentials, webhooks and webhook events, workflows, workflow versions, tasks, task runs, and maintenance

For operations with a request body, pass `body = { ... }` or pass body fields directly when there is no ambiguity. Path and query parameters follow Render's documented names; snake_case aliases work for camelCase parameters such as `service_id`, `deploy_id`, `owner_id`, `start_time`, and `end_time`.
