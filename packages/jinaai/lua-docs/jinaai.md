# Jina AI — Lua API Reference

## search

Search the web using Jina AI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | yes | The search query string |

### Examples

### Basic web search

```lua
local result = app.integrations.jinaai.search({
  q = "Laravel 12 new features"
})

for _, item in ipairs(result.data.result) do
  print(item.title .. ": " .. item.url)
end
```

---

## read

Read and extract clean content from a URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | The URL to read and extract content from |

### Examples

### Read a web page

```lua
local result = app.integrations.jinaai.read({
  url = "https://laravel.com/docs/12.x"
})

print(result.data.content)
```

---

## ground

Ground a statement against provided context — verify whether a claim is supported by reference text.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `statement` | string | yes | The statement or claim to verify |
| `context` | string | yes | The reference context text to ground the statement against |

### Examples

### Verify a claim

```lua
local result = app.integrations.jinaai.ground({
  statement = "Laravel 12 was released in 2025",
  context = "Laravel 12 was officially released on March 11, 2025, introducing new features like conversational exception handling and improved queue management."
})

for _, fact in ipairs(result.data.facts) do
  print(fact.statement .. ": " .. fact.grounded)
end
```

---

## embeddings

Generate text embeddings — convert text into dense vector representations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `input` | array | yes | An array of strings to generate embeddings for |
| `model` | string | no | The embedding model (e.g., `"jina-embeddings-v3"`) |

### Available Models

`jina-embeddings-v3`, `jina-embeddings-v2-base-en`, `jina-embeddings-v2-base-de`, `jina-embeddings-v2-base-es`, `jina-embeddings-v2-base-code`, `jina-embeddings-v2-base-zh`

### Examples

### Generate embeddings for texts

```lua
local result = app.integrations.jinaai.embeddings({
  input = {
    "Laravel is a PHP framework",
    "Vue.js is a JavaScript framework"
  },
  model = "jina-embeddings-v3"
})

for _, embedding in ipairs(result.data) do
  print("Embedding index " .. embedding.index .. ": " .. #embedding.embedding .. " dimensions")
end
```

---

## rerank

Rerank documents by relevance to a query.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The query to rank documents against |
| `documents` | array | yes | An array of document strings to rank |
| `model` | string | no | The reranking model (e.g., `"jina-reranker-v2-base-multilingual"`) |
| `top_n` | integer | no | Maximum number of top results to return |

### Available Models

`jina-reranker-v2-base-multilingual`, `jina-reranker-v1-turbo-en`, `jina-reranker-v1-tiny-en`, `jina-colbert-v1-en`, `jina-colbert-v2`

### Examples

### Rerank search results

```lua
local result = app.integrations.jinaai.rerank({
  query = "How to install Laravel",
  documents = {
    "Laravel is a web application framework with expressive, elegant syntax.",
    "To install Laravel, use Composer: composer create-project laravel/laravel example-app",
    "Vue.js is a progressive JavaScript framework for building user interfaces.",
    "Laravel Sail provides a Docker-based development environment."
  },
  top_n = 2
})

for _, doc in ipairs(result.results) do
  print("Rank " .. doc.index .. " (score: " .. doc.relevance_score .. "): " .. doc.document.text:sub(1, 80))
end
```

---

## Multi-Account Usage

If you have multiple Jina AI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.jinaai.function_name({...})

-- Explicit default (portable across setups)
app.integrations.jinaai.default.function_name({...})

-- Named accounts
app.integrations.jinaai.production.function_name({...})
app.integrations.jinaai.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
