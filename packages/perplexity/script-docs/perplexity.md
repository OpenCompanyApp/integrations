# Perplexity — JavaScript API Reference

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

```js
var result = app.integrations.perplexity.chat({
  messages: [
    { role: "user", content: "Summarize the current Perplexity Sonar API." }
  ],
  model: "sonar-pro",
  search_domain_filter: [ "docs.perplexity.ai" ],
  return_related_questions: true,
})

console.log(result.content)
for (const source of (result.citations || [])) {
  console.log(source)
}
```
Normalized output includes `id`, `model`, `content`, `role`, `finish_reason`, `usage`, `citations`, `search_results`, `images`, and `related_questions` when present.

## ask

Ask a one-shot Sonar question. This builds a single user message and calls the same Sonar chat endpoint as `chat`.

```js
var result = app.integrations.perplexity.ask({
  query: "What changed in the latest public Sonar API shape?",
  model: "sonar",
  search_recency_filter: "month",
})

var content = result.choices[0].message.content
console.log(content)
```
`ask` returns the raw Sonar response so agents can inspect the full `choices`, `citations`, `search_results`, `usage`, `images`, and `related_questions` payload.

## search

Search the web and retrieve relevant page results without generating an answer.

```js
var result = app.integrations.perplexity.search({
  query: "Perplexity embeddings API",
  max_results: 5,
  search_domain_filter: [ "docs.perplexity.ai" ],
})

for (const item of (result.results || [])) {
  console.log(item.title + " " + item.url)
}
```
## create_async_sonar

Submit a long-running Sonar request and poll it later.

```js
var created = app.integrations.perplexity.create_async_sonar({
  query: "Create a detailed research brief on search-grounded LLM APIs.",
  model: "sonar-deep-research",
  idempotency_key: "research-brief-example-001",
})

console.log(created.id)
console.log(created.status)
```
You can pass `messages` instead of `query` for multi-turn requests.

## list_async_sonar

List async Sonar requests for the configured account.

```js
var result = app.integrations.perplexity.list_async_sonar({})

for (const request of (result.requests || [])) {
  console.log(request.id + " " + request.status)
}
```
## get_async_sonar

Retrieve one async Sonar request.

```js
var result = app.integrations.perplexity.get_async_sonar({
  request_id: "req_example",
})

console.log(result.status)
if (result.response) {
  console.log(result.response.choices[0].message.content)
}
```
## agent

Create a Perplexity Agent API response.

```js
var result = app.integrations.perplexity.agent({
  input: "Find three sources about agentic search APIs && summarize the tradeoffs.",
  model: "perplexity/sonar",
})

for (const output of (result.output || [])) {
  for (const content of (output.content || [])) {
    if (content.text) {
      console.log(content.text)
    }
  }
}
```
Use `list_models` for Agent API model ids.

## embeddings

Create embeddings for a string or array of strings.

```js
var result = app.integrations.perplexity.embeddings({
  input: [ "First document chunk", "Second document chunk" ],
  model: "pplx-embed-v1-0.6b",
  encoding_format: "base64_int8",
})

console.log(result.model)
console.log((result.data || {}).length)
```
Embeddings are returned in Perplexity's encoded format, usually base64-encoded compact vectors.

## contextualized_embeddings

Create contextualized embeddings for chunks grouped by source document.

```js
var result = app.integrations.perplexity.contextualized_embeddings({
  input: [
    [ "Document A chunk 1", "Document A chunk 2" ],
    [ "Document B chunk 1" ]
  ],
  model: "pplx-embed-context-v1-0.6b",
})

console.log(result.model)
```
The input is nested: each inner array is one document's chunks.

## list_models

List Perplexity Agent API models.

```js
var result = app.integrations.perplexity.list_models({})

for (const model of (result.data || [])) {
  console.log(model.id + " " + (model.owned_by || ""))
}
```
## Multi-Account Usage

```js
app.integrations.perplexity.chat({ /* parameters */ })
app.integrations.perplexity.default.chat({ /* parameters */ })
app.integrations.perplexity.research.chat({ /* parameters */ })
```
The same tool names are available on each account namespace.
