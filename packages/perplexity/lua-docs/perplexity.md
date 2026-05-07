# Perplexity — Lua API Reference

Namespace: `app.integrations.perplexity`

This integration uses the current Perplexity APIs:

- Sonar chat: `POST /v1/sonar`
- Search: `POST /search`
- Async Sonar: `POST /v1/async/sonar`, `GET /v1/async/sonar`, `GET /v1/async/sonar/{id}`
- Agent responses: `POST /v1/agent`
- Embeddings: `POST /v1/embeddings`, `POST /v1/contextualizedembeddings`
- Models: `GET /v1/models`

`ask` is a convenience wrapper over Sonar chat. It is not a separate upstream `/ask` endpoint.

## chat

Create a Sonar chat completion.

Required:

- `messages`: array of `{ role = "system" | "user" | "assistant", content = "..." }`

Common optional fields:

- `model`: defaults to `sonar`
- `temperature`, `top_p`, `max_tokens`
- `response_format`
- `web_search_options`: pass Perplexity's current web search options object
- convenience search options: `search_mode`, `search_domain_filter`, `search_language_filter`, `search_recency_filter`, `return_images`, `return_related_questions`, `disable_search`
- `reasoning_effort`, `language_preference`

```lua
local result = app.integrations.perplexity.chat({
  messages = {
    { role = "user", content = "Summarize the current Perplexity Sonar API." }
  },
  model = "sonar-pro",
  search_domain_filter = { "docs.perplexity.ai" },
  return_related_questions = true
})

print(result.content)
for _, source in ipairs(result.citations or {}) do
  print(source)
end
```

Normalized output includes `id`, `model`, `content`, `role`, `finish_reason`, `usage`, `citations`, `search_results`, `images`, and `related_questions` when present.

## ask

Ask a one-shot Sonar question. This builds a single user message and calls the same Sonar chat endpoint as `chat`.

```lua
local result = app.integrations.perplexity.ask({
  query = "What changed in the latest public Sonar API shape?",
  model = "sonar",
  search_recency_filter = "month"
})

local content = result.choices[1].message.content
print(content)
```

`ask` returns the raw Sonar response so agents can inspect the full `choices`, `citations`, `search_results`, `usage`, `images`, and `related_questions` payload.

## search

Search the web and retrieve relevant page results without generating an answer.

```lua
local result = app.integrations.perplexity.search({
  query = "Perplexity embeddings API",
  max_results = 5,
  search_domain_filter = { "docs.perplexity.ai" }
})

for _, item in ipairs(result.results or {}) do
  print(item.title .. " " .. item.url)
end
```

## create_async_sonar

Submit a long-running Sonar request and poll it later.

```lua
local created = app.integrations.perplexity.create_async_sonar({
  query = "Create a detailed research brief on search-grounded LLM APIs.",
  model = "sonar-deep-research",
  idempotency_key = "research-brief-example-001"
})

print(created.id)
print(created.status)
```

You can pass `messages` instead of `query` for multi-turn requests.

## list_async_sonar

List async Sonar requests for the configured account.

```lua
local result = app.integrations.perplexity.list_async_sonar({})

for _, request in ipairs(result.requests or {}) do
  print(request.id .. " " .. request.status)
end
```

## get_async_sonar

Retrieve one async Sonar request.

```lua
local result = app.integrations.perplexity.get_async_sonar({
  request_id = "req_example"
})

print(result.status)
if result.response then
  print(result.response.choices[1].message.content)
end
```

## agent

Create a Perplexity Agent API response.

```lua
local result = app.integrations.perplexity.agent({
  input = "Find three sources about agentic search APIs and summarize the tradeoffs.",
  model = "perplexity/sonar"
})

for _, output in ipairs(result.output or {}) do
  for _, content in ipairs(output.content or {}) do
    if content.text then
      print(content.text)
    end
  end
end
```

Use `list_models` for Agent API model ids.

## embeddings

Create embeddings for a string or array of strings.

```lua
local result = app.integrations.perplexity.embeddings({
  input = { "First document chunk", "Second document chunk" },
  model = "pplx-embed-v1-0.6b",
  encoding_format = "base64_int8"
})

print(result.model)
print(#(result.data or {}))
```

Embeddings are returned in Perplexity's encoded format, usually base64-encoded compact vectors.

## contextualized_embeddings

Create contextualized embeddings for chunks grouped by source document.

```lua
local result = app.integrations.perplexity.contextualized_embeddings({
  input = {
    { "Document A chunk 1", "Document A chunk 2" },
    { "Document B chunk 1" }
  },
  model = "pplx-embed-context-v1-0.6b"
})

print(result.model)
```

The input is nested: each inner array is one document's chunks.

## list_models

List Perplexity Agent API models.

```lua
local result = app.integrations.perplexity.list_models({})

for _, model in ipairs(result.data or {}) do
  print(model.id .. " " .. (model.owned_by or ""))
end
```

## Multi-Account Usage

```lua
app.integrations.perplexity.chat({...})
app.integrations.perplexity.default.chat({...})
app.integrations.perplexity.research.chat({...})
```

The same tool names are available on each account namespace.
