# Perplexity — Ruby API Reference

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

```ruby
result = app.integrations.perplexity.sonar_chat(messages: [{role: "user", content: "Summarize the current Perplexity Sonar API."}], model: "sonar-pro", search_domain_filter: ["docs.perplexity.ai"], return_related_questions: true)
puts(result.content)
(result.citations || []).each do |source|
  puts(source)
end
```
Normalized output includes `id`, `model`, `content`, `role`, `finish_reason`, `usage`, `citations`, `search_results`, `images`, and `related_questions` when present.

## ask

Ask a one-shot Sonar question. This builds a single user message and calls the same Sonar chat endpoint as `chat`.

```ruby
result = app.integrations.perplexity.ask(query: "What changed in the latest public Sonar API shape?", model: "sonar", search_recency_filter: "month")
content = result.choices[0].message.content
puts(content)
```
`ask` returns the raw Sonar response so agents can inspect the full `choices`, `citations`, `search_results`, `usage`, `images`, and `related_questions` payload.

## search

Search the web and retrieve relevant page results without generating an answer.

```ruby
result = app.integrations.perplexity.search_web(query: "Perplexity embeddings API", max_results: 5, search_domain_filter: ["docs.perplexity.ai"])
(result.results || []).each do |item|
  puts((item.title).to_s + " " + (item.url).to_s)
end
```
## create_async_sonar

Submit a long-running Sonar request and poll it later.

```ruby
created = app.integrations.perplexity.create_async_sonar(query: "Create a detailed research brief on search-grounded LLM APIs.", model: "sonar-deep-research", idempotency_key: "research-brief-example-001")
puts(created.id)
puts(created.status)
```
You can pass `messages` instead of `query` for multi-turn requests.

## list_async_sonar

List async Sonar requests for the configured account.

```ruby
result = app.integrations.perplexity.list_async_sonar()
(result.requests || []).each do |request|
  puts((request.id).to_s + " " + (request.status).to_s)
end
```
## get_async_sonar

Retrieve one async Sonar request.

```ruby
result = app.integrations.perplexity.get_async_sonar(request_id: "req_example")
puts(result.status)
if result.response
  puts(result.response.choices[0].message.content)
end
```
## agent

Create a Perplexity Agent API response.

```ruby
result = app.integrations.perplexity.agent_response(input: "Find three sources about agentic search APIs && summarize the tradeoffs.", model: "perplexity/sonar")
(result.output || []).each do |output|
  (output.content || []).each do |content|
    if content.text
      puts(content.text)
    end
  end
end
```
Use `list_models` for Agent API model ids.

## embeddings

Create embeddings for a string or array of strings.

```ruby
result = app.integrations.perplexity.embeddings(input: ["First document chunk", "Second document chunk"], model: "pplx-embed-v1-0.6b", encoding_format: "base64_int8")
puts(result.model)
puts((result.data || {}).length)
```
Embeddings are returned in Perplexity's encoded format, usually base64-encoded compact vectors.

## contextualized_embeddings

Create contextualized embeddings for chunks grouped by source document.

```ruby
result = app.integrations.perplexity.contextualized_embeddings(input: [["Document A chunk 1", "Document A chunk 2"], ["Document B chunk 1"]], model: "pplx-embed-context-v1-0.6b")
puts(result.model)
```
The input is nested: each inner array is one document's chunks.

## list_models

List Perplexity Agent API models.

```ruby
result = app.integrations.perplexity.list_models()
(result.data || []).each do |model|
  puts((model.id).to_s + " " + ((model.owned_by || "")).to_s)
end
```
## Multi-Account Usage

```ruby
app.integrations.perplexity.sonar_chat()
app.integrations.perplexity.default.sonar_chat()
app.integrations.perplexity.research.sonar_chat()
```
The same tool names are available on each account namespace.
