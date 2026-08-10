# OpenRouter JavaScript API Reference

OpenRouter exposes model routing, chat completions, Responses-compatible calls, embeddings, reranking, media jobs, account activity, keys, workspaces, providers, guardrails, and generation records through one API key.

Namespace: `app.integrations["openrouter"]`

## Common Patterns

Use the canonical chat endpoint when you want OpenAI-compatible chat completions:

```js
var result = app.integrations["openrouter"].create_completion({
  model: "openai/gpt-4o",
  messages: [
    { role: "user", content: "Summarize this in one sentence." }
  ],
  max_tokens: 120,
  temperature: 0.2,
})

console.log(result.choices[0].message.content)
```
Use `create_response`, `create_message`, `create_embedding`, `rerank`, and `create_video` when an endpoint expects the official OpenRouter JSON payload. Pass that payload under `payload`:

```js
var response = app.integrations["openrouter"].create_response({
  payload: {
    model: "openai/gpt-4o-mini",
    input: "Write a release note.",
  }
})

var embedding = app.integrations["openrouter"].create_embedding({
  payload: {
    model: "openai/text-embedding-3-small",
    input: "search text",
  }
})
```
Read tools that accept filters use a `query` object so agents can pass newly documented query parameters without waiting for a package release:

```js
var generations = app.integrations["openrouter"].list_generations({
  limit: 10,
})

var activity = app.integrations["openrouter"].get_activity({
  query: { limit: 25 },
})
```
## Tool Groups

### Model and Provider Discovery

- `list_models({})`
- `count_models({ query = {...} })`
- `list_user_models({ query = {...} })`
- `list_model_endpoints({ author = "openai", slug = "gpt-4o-mini" })`
- `list_providers({})`
- `list_embedding_models({})`
- `list_video_models({})`

### Generation and Model Calls

- `create_completion({ model = "...", messages = {...}, max_tokens = 100, temperature = 0.2 })`
- `create_response({ payload = {...} })`
- `create_message({ payload = {...} })`
- `create_embedding({ payload = {...} })`
- `rerank({ payload = {...} })`
- `create_video({ payload = {...} })`
- `get_video({ job_id = "job_123" })`

### Generations, Usage, and Account State

- `list_generations({ limit = 10, offset = 0 })`
- `get_generation({ id = "gen_123" })`
- `get_generation_content({ id = "gen_123" })`
- `get_usage({ period = "month" })`
- `get_credits({})`
- `get_activity({ query = {...} })`
- `get_current_user({})`

### API Keys and Workspaces

- `list_api_keys({})`
- `get_api_key({ hash = "key_hash" })`
- `create_api_key({ payload = {...} })`
- `update_api_key({ hash = "key_hash", payload = {...} })`
- `delete_api_key({ hash = "key_hash" })`
- `list_organization_members({ query = {...} })`
- `list_workspaces({ query = {...} })`
- `get_workspace({ id = "workspace_123" })`
- `create_workspace({ payload = {...} })`
- `update_workspace({ id = "workspace_123", payload = {...} })`
- `delete_workspace({ id = "workspace_123" })`
- `list_guardrails({ query = {...} })`

## Raw OpenRouter Paths

For newly released endpoints, use guarded relative-path tools:

```js
var zdr = app.integrations["openrouter"].api_get({
  path: "/endpoints/zdr",
  query: {},
})
```
The raw tools only accept relative OpenRouter API paths. Absolute URLs and parent-directory traversal are rejected.

- `api_get({ path = "/path", query = {...} })`
- `api_post({ path = "/path", payload = {...} })`
- `api_patch({ path = "/path", payload = {...} })`
- `api_delete({ path = "/path", query = {...} })`

## Return Shapes

Tool responses are the decoded OpenRouter JSON response. This package does not flatten upstream fields for model calls, account records, keys, workspaces, or generation records because OpenRouter's API returns endpoint-specific response shapes that agents often need intact.

## Multi-Account Usage

```js
app.integrations["openrouter"].list_models({})
app.integrations["openrouter"].default.list_models({})
app.integrations["openrouter"].work.list_models({})
```
All accounts expose the same tools. Only credentials and optional base URL differ.
