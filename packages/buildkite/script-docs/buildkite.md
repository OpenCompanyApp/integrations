# Buildkite

Buildkite tools are available under `app.integrations.buildkite`.

Use this integration to inspect organizations, pipelines, builds, and job diagnostics, or to trigger and manage builds from agent workflows. Buildkite REST API calls use a bearer access token and the API v2 base URL.

## Common Workflow

```js
var orgs = app.integrations.buildkite.list_organizations({ per_page: 20 })
var pipelines = app.integrations.buildkite.list_pipelines({
  organization: "acme-inc",
  per_page: 20,
})

var builds = app.integrations.buildkite.list_builds({
  organization: "acme-inc",
  pipeline: "deploy",
  branch: "main",
  state: "failed",
})
```
## Trigger a Build

```js
var build = app.integrations.buildkite.create_build({
  organization: "acme-inc",
  pipeline: "deploy",
  payload: {
    commit: "HEAD",
    branch: "main",
    message: "Deploy from agent",
    env: {
      DEPLOY_TARGET: "staging",
    },
  },
})
```
Buildkite rebuild, cancel, and retry operations require the build number, not the build UUID.

```js
app.integrations.buildkite.retry_failed_jobs({
  organization: "acme-inc",
  pipeline: "deploy",
  number: 42,
  payload: { states: "failed,soft_failed" },
})
```
## Job Diagnostics

```js
var log = app.integrations.buildkite.get_job_log({
  organization: "acme-inc",
  pipeline: "deploy",
  number: 42,
  job_id: "b63254c0-3271-4a98-8270-7cfbd6c2f14e",
})
```
## Raw Helpers

Raw helpers accept only relative API paths. Absolute URLs and parent-directory traversal are rejected.

```js
var user = app.integrations.buildkite.api_get({
  path: "/user",
})
```
## Notes

- The integration sends `Authorization: Bearer <token>`.
- Tool access depends on the scopes granted to the configured Buildkite token.
- Responses are normalized only for transport errors. Buildkite JSON payloads are otherwise returned as provided by the API.
