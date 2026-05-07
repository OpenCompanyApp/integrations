# CircleCI Lua Reference

Namespace: `app.integrations.circleci`

CircleCI tools use a personal API token sent as the `Circle-Token` header. Project slugs should be passed as a single string such as `gh/example-org/example-repo`.

## Common Workflows

Trigger a pipeline:

```lua
local pipeline = app.integrations.circleci.trigger_pipeline({
  project_slug = "gh/example-org/example-repo",
  branch = "main",
  parameters = {
    deploy = false
  }
})
```

Inspect the pipeline and workflow:

```lua
local workflows = app.integrations.circleci.list_pipeline_workflows({
  pipeline_id = pipeline.id
})

local jobs = app.integrations.circleci.list_workflow_jobs({
  workflow_id = workflows.items[1].id
})
```

Manage a context secret:

```lua
app.integrations.circleci.upsert_context_env_var({
  context_id = "context-uuid",
  env_var_name = "DEPLOY_TOKEN",
  value = "secret-value"
})
```

## Coverage Notes

- `project_slug` and `org_slug` preserve slash-separated CircleCI slugs in API paths and query strings.
- `list_pipelines`, `list_projects`, and context listing normalize `org_slug`, `owner_slug`, and `page_token` to CircleCI's documented hyphenated query keys.
- Pipeline tools cover trigger, continue, config, values, project pipelines, and pipeline workflows.
- Workflow and job tools cover approvals, cancellation, reruns, workflow jobs, artifacts, and test metadata.
- Project tools cover checkout keys, environment variables, settings, and project deletion.
- Context tools cover context-level secrets and restrictions; secret values are write-only in CircleCI responses.
- Raw `api_get`, `api_post`, `api_patch`, `api_put`, and `api_delete` can call any CircleCI API v2 endpoint path.

Responses are decoded CircleCI JSON exactly as returned by the API.
