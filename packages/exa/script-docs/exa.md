# Exa AI

JavaScript API reference for the `exa` integration package. Exa provides AI-oriented web search, clean content extraction, similar-link discovery, and grounded answers with citations.

The integration uses the official `x-api-key` header. Exa also accepts `Authorization: Bearer`, but this package uses `x-api-key` consistently.

## Search

### `exa_search`

Search the web with current Exa search types. Common types include `auto`, `instant`, `fast`, `deep-lite`, `deep`, and `deep-reasoning`; legacy `keyword` and `neural` are also accepted where supported.

```js
var results = exa_search({
  query: "Laravel queue monitoring best practices",
  type: "auto",
  num_results: 5,
})
```
Use domain and date filters when the source scope matters:

```js
var docs = exa_search({
  query: "OpenAI Responses API file search",
  include_domains: [ "platform.openai.com" ],
  start_published_date: "2026-01-01T00:00:00Z",
})
```
For research-like structured extraction, prefer `/search` with `type = "deep-reasoning"` and `output_schema`. Exa documents the older `/research/v1` API as deprecated as of May 1, 2026.

```js
var structured = exa_search({
  query: "Compare the current pricing of three vector databases",
  type: "deep-reasoning",
  output_schema: {
    type: "object",
    properties: {
      vendors: {
        type: "array",
        items: {
          type: "object",
          properties: {
            name: { type: "string" },
            pricingSummary: { type: "string" },
          },
        },
      },
    },
  },
})
```
## Search And Contents

### `exa_search_and_contents`

Search and retrieve content in one call. The content options are sent in Exa's current nested `contents` object.

```js
var results = exa_search_and_contents({
  query: "latest Typefully API v2 migration guide",
  num_results: 3,
  text: true,
  highlights: {
    query: "API v2 migration",
    maxCharacters: 3000,
  },
})
```
You can request summaries instead of full text:

```js
var summarized = exa_search_and_contents({
  query: "recent Exa Search API changes",
  type: "fast",
  summary: {
    query: "Summarize the API changes for developers.",
  },
})
```
## Answer

### `exa_answer`

Generate a grounded answer to a question. Exa returns an `answer` string and may include citations and cost metadata.

```js
var answer = exa_answer({
  query: "What is the latest documented status of Exa research API deprecation?",
  text: true,
})
console.log(answer.answer)
```
## Contents

### `exa_get_contents`

Retrieve clean page contents, highlights, summaries, and metadata for URLs or Exa document IDs. The current Exa Contents API is URL-first, while `ids` remains supported for search result IDs.

```js
var contents = exa_get_contents({
  urls: [ "https://example.test/article" ],
  text: true,
  summary: {
    query: "Summarize this page for an engineering agent.",
  },
})
```
Use cache freshness and subpage options when crawling site sections:

```js
var crawl = exa_get_contents({
  urls: [ "https://example.test/docs" ],
  text: true,
  max_age_hours: 24,
  subpages: 2,
  subpage_target: "api reference",
})
```
## Similar Links

### `exa_find_similar`

Find pages similar to a given URL.

```js
var similar = exa_find_similar({
  url: "https://example.test/product",
  num_results: 10,
  exclude_source_domain: true,
})
```
## User

### `exa_get_current_user`

```js
var user = exa_get_current_user()
console.log(user.email)
```
## Return Shapes

Search, contents, similar-link, and answer tools return the raw Exa JSON shape. Common fields include `requestId`, `results`, `answer`, `citations`, `statuses`, and `costDollars`.

## Multi-Account Usage

Use the namespace prefix assigned by the host:

```js
var results = ns_exa_work.exa_search({
  query: "company research",
  type: "fast",
})
```