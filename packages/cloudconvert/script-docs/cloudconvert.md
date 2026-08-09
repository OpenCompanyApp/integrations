# CloudConvert JavaScript Reference

Namespace: `app.integrations.cloudconvert`

CloudConvert tools use a bearer `api_key`. Domain-specific task payloads are passed through to CloudConvert as JSON, so use the field names from the CloudConvert v2 API.

## Common Workflows

Create an async conversion job:

```js
var job = app.integrations.cloudconvert.create_job({
  tasks: {
    import_file: {
      operation: "import/url",
      url: "https://example.test/document.pdf",
    },
    convert_file: {
      operation: "convert",
      input: "import_file",
      output_format: "png",
    },
    export_file: {
      operation: "export/url",
      input: "convert_file",
    }
  },
  tag: "agent-demo",
})
```
Discover supported operation parameters:

```js
var operations = app.integrations.cloudconvert.list_operations({
  operation: "convert",
  output_format: "pdf",
  include: "options",
})
```
Wait for sync completion:

```js
var finished = app.integrations.cloudconvert.wait_job({
  job_id: job.data.id,
})
```
## Coverage Notes

- `list_operations` is the discovery entry point for supported operations, formats, engines, versions, and option schemas.
- `create_job` and `create_job_sync` expect named task definitions, not an ordered list.
- Task operations such as `convert`, `import/url`, and `export/url` are created inside job payloads; CloudConvert does not expose separate public create-task endpoints for those operation pages.
- `list_jobs` and `list_tasks` normalize simple `status`, `tag`, `job_id`, and `operation` parameters into CloudConvert `filter[...]` query keys.
- Sync tools use the configured `sync_url` and may hold the HTTP request open while CloudConvert processes the job or task.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` can call any CloudConvert v2 endpoint path.
- `create_signed_url` and `verify_webhook_signature` run locally because CloudConvert documents those as signing helpers rather than API calls.

Responses are decoded CloudConvert JSON exactly as returned by the API.
