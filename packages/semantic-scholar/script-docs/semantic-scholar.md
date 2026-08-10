# Semantic Scholar

Namespace: `semantic_scholar`

Semantic Scholar provides Academic Graph, Recommendations, and Datasets APIs for scholarly papers, authors, citations, snippets, recommendations, and dataset download metadata. All tools require a Semantic Scholar API key sent as `x-api-key`.

## Academic Graph

Use paper search for relevance-ranked discovery and bulk search for larger result traversal.

```js
var papers = semantic_scholar.search_papers({
  query: "retrieval augmented generation",
  limit: 10,
  fields: [ "title", "year", "authors", "citationCount", "openAccessPdf" ],
})

var paper = semantic_scholar.get_paper({
  paper_id: "CorpusId:216867622",
  fields: [ "title", "abstract", "authors", "references", "citations" ],
})
```
Paper graph traversal tools:

- `semantic_scholar_get_paper_authors`
- `semantic_scholar_get_paper_citations`
- `semantic_scholar_get_paper_references`
- `semantic_scholar_batch_get_papers`
- `semantic_scholar_autocomplete_papers`
- `semantic_scholar_title_search_papers`
- `semantic_scholar_search_snippets`

Author tools:

- `semantic_scholar_search_authors`
- `semantic_scholar_get_author`
- `semantic_scholar_batch_get_authors`
- `semantic_scholar_get_author_papers`

## Recommendations

```js
var recommendations = semantic_scholar.recommend_papers({
  payload: {
    positivePaperIds: [ "CorpusId:216867622" ],
    negativePaperIds: {},
  },
  limit: 5,
  fields: [ "title", "year", "authors" ],
})

var similar = semantic_scholar.recommend_for_paper({
  paper_id: "CorpusId:216867622",
  limit: 5,
})
```
## Datasets

The Datasets API returns release, dataset, and diff metadata plus download links. Dataset usage is governed by Semantic Scholar license terms.

```js
var releases = semantic_scholar.list_dataset_releases({})

var dataset = semantic_scholar.get_dataset({
  release_id: "2026-01-01",
  dataset_name: "papers",
})
```
## Return Shape

The integration returns Semantic Scholar JSON directly. Common response shapes include:

- `data` arrays for search and paged graph endpoints
- entity objects for singleton paper/author lookups
- recommendation arrays for Recommendations API tools
- release/dataset metadata and download links for Datasets API tools

Arrays in `fields`, `publicationTypes`, `venue`, `fieldsOfStudy`, `paperIds`, and similar parameters are sent as comma-separated values, matching the official API.
