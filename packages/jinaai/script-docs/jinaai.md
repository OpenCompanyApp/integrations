# Jina AI — JavaScript API Reference

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

```js
var result = app.integrations.jinaai.search({
  q: "Laravel queue worker retry strategy",
})

for (const item of (result.data.result || [])) {
  console.log(item.title + " " + item.url)
}
```
## read

Read a URL and extract LLM-friendly content.

```js
var result = app.integrations.jinaai.read({
  url: "https://example.test/article",
})

console.log(result.data.content)
```
## ground

Verify a statement with Jina Grounding.

```js
var result = app.integrations.jinaai.ground({
  statement: "Jina Reader can convert URLs to markdown.",
})

console.log(result.data.result)
console.log(result.data.factuality)
```
`references` can be passed to restrict sources. The legacy `context` field is still forwarded for compatibility, but `references` is preferred for source control.

## embeddings

Generate embeddings.

```js
var result = app.integrations.jinaai.embeddings({
  input: [
    "Laravel is a PHP framework",
    "Vue.js is a JavaScript framework"
  ],
  model: "jina-embeddings-v3",
})

console.log((result.data || {}).length)
```
## rerank

Rerank documents by relevance to a query.

```js
var result = app.integrations.jinaai.rerank({
  query: "How to install Laravel",
  documents: [
    "Laravel uses Composer for installation.",
    "Vue renders browser interfaces."
  ],
  top_n: 1,
})

console.log(result.results[0].relevance_score)
```
## classify

Classify text or image inputs.

```js
var result = app.integrations.jinaai.classify({
  input: [ "Composer installs Laravel packages." ],
  labels: [ "php", "javascript", "database" ],
  top_k: 1,
})

console.log(result.data[0].label)
```
For few-shot classification, pass the classifier fields supported by the upstream API, such as `classifier_id`.

## segment

Tokenize or segment long text.

```js
var result = app.integrations.jinaai.segment({
  content: "A long paragraph that should be split before embedding.",
  return_chunks: true,
  max_chunk_length: 256,
})

for (const chunk of (result.chunks || [])) {
  console.log(chunk)
}
```
## Multi-Account Usage

```js
app.integrations.jinaai.search({ /* parameters */ })
app.integrations.jinaai.default.search({ /* parameters */ })
app.integrations.jinaai.production.search({ /* parameters */ })
```
All functions are identical across accounts; only credentials differ.
