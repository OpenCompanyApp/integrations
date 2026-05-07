# Jina AI — Lua API Reference

Namespace: `app.integrations.jinaai`

This integration uses Jina Search Foundation endpoints:

- Search Reader: `https://s.jina.ai/`
- URL Reader: `https://r.jina.ai/`
- Grounding: `https://g.jina.ai/`
- Embeddings: `https://api.jina.ai/v1/embeddings`
- Rerank: `https://api.jina.ai/v1/rerank`
- Classify: `https://api.jina.ai/v1/classify`
- Segment: `https://api.jina.ai/v1/segment`

## search

Search the web and return Jina Reader search results.

```lua
local result = app.integrations.jinaai.search({
  q = "Laravel queue worker retry strategy"
})

for _, item in ipairs(result.data.result or {}) do
  print(item.title .. " " .. item.url)
end
```

## read

Read a URL and extract LLM-friendly content.

```lua
local result = app.integrations.jinaai.read({
  url = "https://example.test/article"
})

print(result.data.content)
```

## ground

Verify a statement with Jina Grounding.

```lua
local result = app.integrations.jinaai.ground({
  statement = "Jina Reader can convert URLs to markdown."
})

print(result.data.result)
print(result.data.factuality)
```

`references` can be passed to restrict sources. The legacy `context` field is still forwarded for compatibility, but `references` is preferred for source control.

## embeddings

Generate embeddings.

```lua
local result = app.integrations.jinaai.embeddings({
  input = {
    "Laravel is a PHP framework",
    "Vue.js is a JavaScript framework"
  },
  model = "jina-embeddings-v3"
})

print(#(result.data or {}))
```

## rerank

Rerank documents by relevance to a query.

```lua
local result = app.integrations.jinaai.rerank({
  query = "How to install Laravel",
  documents = {
    "Laravel uses Composer for installation.",
    "Vue renders browser interfaces."
  },
  top_n = 1
})

print(result.results[1].relevance_score)
```

## classify

Classify text or image inputs.

```lua
local result = app.integrations.jinaai.classify({
  input = { "Composer installs Laravel packages." },
  labels = { "php", "javascript", "database" },
  top_k = 1
})

print(result.data[1].label)
```

For few-shot classification, pass the classifier fields supported by the upstream API, such as `classifier_id`.

## segment

Tokenize or segment long text.

```lua
local result = app.integrations.jinaai.segment({
  content = "A long paragraph that should be split before embedding.",
  return_chunks = true,
  max_chunk_length = 256
})

for _, chunk in ipairs(result.chunks or {}) do
  print(chunk)
end
```

## Multi-Account Usage

```lua
app.integrations.jinaai.search({...})
app.integrations.jinaai.default.search({...})
app.integrations.jinaai.production.search({...})
```

All functions are identical across accounts; only credentials differ.
