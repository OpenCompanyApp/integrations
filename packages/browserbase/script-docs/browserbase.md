# Browserbase Integration

Namespace: `browserbase`

This integration exposes Browserbase OpenAPI v1 operations as endpoint-specific tools. It was generated from `https://docs.browserbase.com/reference/api/openapi.v1.yaml` and uses the documented `X-BB-API-Key` header against `https://api.browserbase.com`.

JSON request bodies are passed through `body`. Multipart upload endpoints expose `file` as a local file path. Use list/get endpoints to discover IDs before updating sessions, contexts, extensions, downloads, functions, and invocations.

## Coverage

- Official paths: 28
- Official operations: 34
- Read operations: 22
- Write operations: 12

## Examples

```js
var projects = browserbase.browserbase_projects_list({})
var session = browserbase.browserbase_sessions_create({ body: { projectId: "prj_example" } })
var search = browserbase.browserbase_search_web({ body: { query: "OpenCompany integrations", numResults: 5 } })
```
## Tools

- `browserbase_contexts_create` - POST /v1/contexts
- `browserbase_contexts_get` - GET /v1/contexts/{id}
- `browserbase_contexts_update` - PUT /v1/contexts/{id}
- `browserbase_contexts_delete` - DELETE /v1/contexts/{id}
- `browserbase_downloads_list` - GET /v1/downloads
- `browserbase_downloads_get` - GET /v1/downloads/{id}
- `browserbase_downloads_delete` - DELETE /v1/downloads/{id}
- `browserbase_extensions_upload` - POST /v1/extensions
- `browserbase_extensions_get` - GET /v1/extensions/{id}
- `browserbase_extensions_delete` - DELETE /v1/extensions/{id}
- `browserbase_fetch_create` - POST /v1/fetch
- `browserbase_functions_list` - GET /v1/functions
- `browserbase_function_builds_list` - GET /v1/functions/builds
- `browserbase_function_builds_get` - GET /v1/functions/builds/{id}
- `browserbase_function_builds_get_logs` - GET /v1/functions/builds/{id}/logs
- `browserbase_invocations_get` - GET /v1/functions/invocations/{id}
- `browserbase_invocations_get_logs` - GET /v1/functions/invocations/{id}/logs
- `browserbase_function_versions_get` - GET /v1/functions/versions/{id}
- `browserbase_function_versions_list_invocations` - GET /v1/functions/versions/{id}/invocations
- `browserbase_functions_get` - GET /v1/functions/{id}
- `browserbase_functions_invoke` - POST /v1/functions/{id}/invoke
- `browserbase_functions_list_versions` - GET /v1/functions/{id}/versions
- `browserbase_projects_list` - GET /v1/projects
- `browserbase_projects_get` - GET /v1/projects/{id}
- `browserbase_projects_usage` - GET /v1/projects/{id}/usage
- `browserbase_search_web` - POST /v1/search
- `browserbase_sessions_list` - GET /v1/sessions
- `browserbase_sessions_create` - POST /v1/sessions
- `browserbase_sessions_get` - GET /v1/sessions/{id}
- `browserbase_sessions_update` - POST /v1/sessions/{id}
- `browserbase_sessions_get_debug` - GET /v1/sessions/{id}/debug
- `browserbase_sessions_get_logs` - GET /v1/sessions/{id}/logs
- `browserbase_sessions_get_recording` - GET /v1/sessions/{id}/recording
- `browserbase_sessions_upload_file` - POST /v1/sessions/{id}/uploads

All examples use fake IDs and safe placeholder values. Configure API keys through the host credential resolver, not in JavaScript source.
