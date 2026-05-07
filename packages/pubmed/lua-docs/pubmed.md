# PubMed

Namespace: `pubmed`

PubMed exposes the public NCBI Entrez E-utilities. This integration defaults to the `pubmed` database where applicable, but most tools accept `db` so agents can work with other Entrez databases when the upstream utility supports them.

NCBI allows public use without credentials. For higher request rates and usage compliance, pass `api_key`, `email`, and `tool` on calls. NCBI expects registered `email` and `tool` values for production clients.

## Search

Use `pubmed_search` for ESearch. Set `usehistory = "y"` when you plan to fetch a larger result set through the History server.

```lua
local found = pubmed.search({
  term = '("large language model"[Title/Abstract]) AND medicine',
  retmax = 10,
  sort = "pub_date",
  usehistory = "y",
})
```

JSON ESearch responses preserve NCBI fields such as `esearchresult.count`, `esearchresult.idlist`, `esearchresult.querykey`, and `esearchresult.webenv`.

## Summaries And Fetching

Use explicit PubMed IDs:

```lua
local summaries = pubmed.summary({
  id = { "40654110", "40654099" },
})
```

Or use History server keys from ESearch or EPost:

```lua
local abstracts = pubmed.fetch({
  query_key = found.esearchresult.querykey,
  WebEnv = found.esearchresult.webenv,
  retstart = 0,
  retmax = 20,
  rettype = "abstract",
  retmode = "xml",
})
```

XML and text responses are returned as:

- `xml` for parsed XML trees, with attributes under `_attributes` and text under `_text` when needed
- `body` for plain text responses
- `status`
- `content_type`

## Links

Use `pubmed_link` for ELink. It defaults `dbfrom` to `pubmed`.

```lua
local links = pubmed.link({
  id = "40654110",
  db = "pmc",
  cmd = "neighbor",
})
```

## Database Info

Use `pubmed_info` for EInfo metadata, including fields and link names. Omit `db` to list available Entrez databases.

```lua
local info = pubmed.info({
  db = "pubmed",
  version = "2.0",
})
```

## History Server

Use `pubmed_post` to save known IDs and pass the returned `query_key` and `WebEnv` into summary, fetch, or link tools.

```lua
local posted = pubmed.post({
  id = { "40654110", "40654099" },
})
```

## Spelling And Global Counts

```lua
local spelling = pubmed.spell({
  term = "asthmaa",
})

local counts = pubmed.global_query({
  term = "CRISPR",
})
```

`pubmed_global_query` uses EGQuery and usually returns XML unless NCBI changes the endpoint behavior.

## Citation Matching

Use `pubmed_citation_match` for ECitMatch. Each citation must follow NCBI's Batch Citation Matcher format:

`journal_title|year|volume|first_page|author_name|your_key|`

```lua
local matches = pubmed.citation_match({
  citations = {
    "proc natl acad sci u s a|1991|88|3248|mann bj|example-1|",
  },
})
```

Multiple citations are submitted in one request as `bdata`. The response is generally plain text, so read `body` for matched PMID rows.
