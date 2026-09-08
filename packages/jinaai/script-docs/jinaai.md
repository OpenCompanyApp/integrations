# Jina AI — Ruby API Reference

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

```ruby
result = app.integrations.jinaai.search(q: "Laravel queue worker retry strategy")
(result.data.result || []).each do |item|
  puts((item.title).to_s + " " + (item.url).to_s)
end
```
## read

Read a URL and extract LLM-friendly content.

```ruby
result = app.integrations.jinaai.read(url: "https://example.test/article")
puts(result.data.content)
```
## ground

Verify a statement with Jina Grounding.

```ruby
result = app.integrations.jinaai.ground(statement: "Jina Reader can convert URLs to markdown.")
puts(result.data.result)
puts(result.data.factuality)
```
`references` can be passed to restrict sources. The legacy `context` field is still forwarded for compatibility, but `references` is preferred for source control.

## embeddings

Generate embeddings.

```ruby
result = app.integrations.jinaai.embeddings(input: ["Laravel is a PHP framework", "Vue.js is a Ruby framework"], model: "jina-embeddings-v3")
puts((result.data || {}).length)
```
## rerank

Rerank documents by relevance to a query.

```ruby
result = app.integrations.jinaai.rerank(query: "How to install Laravel", documents: ["Laravel uses Composer for installation.", "Vue renders browser interfaces."], top_n: 1)
puts(result.results[0].relevance_score)
```
## classify

Classify text or image inputs.

```ruby
result = app.integrations.jinaai.classify(input: ["Composer installs Laravel packages."], labels: ["php", "javascript", "database"], top_k: 1)
puts(result.data[0].label)
```
For few-shot classification, pass the classifier fields supported by the upstream API, such as `classifier_id`.

## segment

Tokenize or segment long text.

```ruby
result = app.integrations.jinaai.segment(content: "A long paragraph that should be split before embedding.", return_chunks: true, max_chunk_length: 256)
(result.chunks || []).each do |chunk|
  puts(chunk)
end
```
## Multi-Account Usage

```ruby
app.integrations.jinaai.search()
app.integrations.jinaai.default.search()
app.integrations.jinaai.production.search()
```
All functions are identical across accounts; only credentials differ.
