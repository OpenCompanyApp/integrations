# Semaphore CI

Semaphore CI tools are available under `app.integrations["semaphore-ci"]`.

Use this integration to manage Semaphore API v1alpha resources: workflows, pipelines, promotions, tasks, jobs, self-hosted agents, deployment targets, artifacts, and artifact retention policies. Requests use `Authorization: Token <api_token>` and `User-Agent: SemaphoreCI v2.0 Client`.

## Base URL

Configure the organization URL, for example:

```text
https://acme.semaphoreci.com
```

The integration appends `/api/v1alpha` automatically when it is not already present.

## Workflows And Pipelines

Run a workflow:

```js
var run = app.integrations["semaphore-ci"].semaphore_ci_run_workflow({
  payload: {
    project_id: "project-uuid",
    reference: "refs/heads/main",
    pipeline_file: ".semaphore/semaphore.yml",
    parameters: {
      DEPLOY_ENV: "staging",
    }
  }
})
```
List pipelines:

```js
var pipelines = app.integrations["semaphore-ci"].semaphore_ci_list_pipelines({
  project_id: "project-uuid",
  branch_name: "main",
})
```
Stop a pipeline:

```js
app.integrations["semaphore-ci"].semaphore_ci_stop_pipeline({
  pipeline_id: "pipeline-uuid",
})
```
## Jobs And Logs

```js
var job = app.integrations["semaphore-ci"].semaphore_ci_get_job({
  job_id: "job-uuid",
})

var logs = app.integrations["semaphore-ci"].semaphore_ci_get_job_logs({
  job_id: "job-uuid",
  artifact_job_logs: true,
})
```
`artifact_job_logs=true` can redirect to a signed artifact URL when artifact logs are available upstream.

## Deployment Targets

Create a deployment target with the required project query and target payload:

```js
var target = app.integrations["semaphore-ci"].semaphore_ci_create_deployment_target({
  project_id: "project-uuid",
  payload: {
    name: "staging",
    project_id: "project-uuid",
    unique_token: "idempotency-uuid",
    description: "Staging deployment target",
  }
})
```
Delete uses a required `unique_token` query parameter:

```js
app.integrations["semaphore-ci"].semaphore_ci_delete_deployment_target({
  target_id: "target-uuid",
  unique_token: "idempotency-uuid",
})
```
## Artifacts

List artifacts by scope:

```js
var artifacts = app.integrations["semaphore-ci"].semaphore_ci_list_artifacts({
  scope: "jobs",
  scope_id: "job-uuid",
  path: "agent",
})
```
Artifact paths must be relative. Semaphore rejects absolute paths, traversal segments, and backslashes.

## Raw API Helpers

Use raw helpers for newer or long-tail API v1alpha endpoints:

```js
var result = app.integrations["semaphore-ci"].semaphore_ci_api_get({
  path: "/pipelines",
  query: { project_id: "project-uuid" },
})
```
Raw paths must be relative. `/api/v1alpha/pipelines` and `/pipelines` are both accepted; full external URLs are rejected.

## Response Shape

JSON responses are returned as Semaphore provides them. Empty successful responses return `{ success = true }`. Plain text responses return `{ value = "..." }`.

## Safety

- Examples use fake UUIDs and project names.
- Tool access depends on the permissions granted to the Semaphore API token.
- Deployment target files and environment variables may contain secrets; avoid sending sensitive values into logs.
- Prefer named tools for destructive operations because they document required ids and idempotency tokens.
