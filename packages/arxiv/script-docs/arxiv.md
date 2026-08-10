# arXiv

Namespace: `arxiv`

arXiv exposes a public Atom API for searching preprints and an OAI-PMH endpoint for metadata harvesting. This integration normalizes XML into compact JavaScript-friendly arrays while keeping arXiv and OAI field names recognizable.

## Search

Use `arxiv_search_papers` with the official `search_query` syntax. Common prefixes include `all`, `ti`, `au`, `abs`, `cat`, `id`, `jr`, and `doi`.

```js
var results = arxiv.search_papers({
  search_query: 'cat:cs.AI AND ti:"agent"',
  start: 0,
  max_results: 5,
  sortBy: "submittedDate",
  sortOrder: "descending",
})
```
Focused helpers build common queries for you:

```js
var by_author = arxiv.search_by_author({
  author: "Ada Lovelace",
  max_results: 5,
})

var by_title = arxiv.search_by_title({
  title: "agent",
  max_results: 5,
})

var recent = arxiv.search_recent({
  search_query: "cat:cs.AI",
  max_results: 10,
})
```
## Get By ID

Use `arxiv_get_papers` when you already have arXiv IDs.

```js
var papers = arxiv.get_papers({
  id_list: [ "2103.15348", "1706.03762" ],
})
```
## Return Shape

Results include feed metadata and an `entries` array. Each entry contains:

- `arxiv_id`
- `title`
- `summary`
- `published`
- `updated`
- `authors`
- `primary_category`
- `categories`
- `doi`
- `journal_ref`
- `comment`
- `abs_url`
- `pdf_url`
- `links`

The API supports paging with `start` and `max_results`. For repeated large fetches, keep slices small and respect arXiv pacing guidance.

## OAI-PMH Metadata

Use OAI tools when you need repository metadata, bulk identifiers, records, date ranges, sets, or resumption tokens. arXiv metadata prefixes commonly include `arXiv`, `arXivRaw`, and `oai_dc`.

```js
var info = arxiv.oai_identify({})

var records = arxiv.oai_list_records({
  metadataPrefix: "arXiv",
  from: "2024-01-01",
  until: "2024-01-31",
  set: "cs",
})

var next_page = arxiv.oai_list_records({
  resumptionToken: records.data.ListRecords.children.resumptionToken._text,
})
```
Use `arxiv_oai_get_record` for one known OAI identifier:

```js
var record = arxiv.oai_get_record({
  identifier: "oai:arXiv.org:2103.15348",
  metadataPrefix: "arXiv",
})
```
OAI responses include:

- `response_date`
- `request`
- `errors`
- `data`

The `data` object preserves nested XML nodes, attributes in `_attributes`, text in `_text`, and repeated elements as arrays. OAI harvesting can return partial pages; always pass the `resumptionToken` from the previous response until arXiv stops returning one.
