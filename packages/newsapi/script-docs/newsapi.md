# NewsAPI

Namespace: `newsapi`

Use this integration to search indexed news articles, retrieve live top and
breaking headlines, and discover source IDs available for top-headlines calls.

## Authentication

NewsAPI requires an API key. The integration sends it in the `X-Api-Key`
header rather than adding it to query strings.

## Tools

- `newsapi_everything`: search indexed articles with `q`, source/domain
  filters, date bounds, language, sorting, and pagination.
- `newsapi_top_headlines`: retrieve top headlines by country, category, source,
  keyword, and pagination.
- `newsapi_sources`: list source IDs available for `newsapi_top_headlines`.

## Return Notes

NewsAPI responses keep the upstream field names. Article responses include
`status`, `totalResults`, and `articles`. Each article has `source`, `author`,
`title`, `description`, `url`, `urlToImage`, `publishedAt`, and `content`.
The `content` field is usually truncated by NewsAPI and should not be treated
as full article text.

`newsapi_everything` requires at least one of `q`, `sources`, or `domains`.
`newsapi_top_headlines` does not allow `sources` to be mixed with `country` or
`category`, matching NewsAPI's documented constraint.

## Examples

```js
var ai = tools.newsapi_everything({
  q: "\"artificial intelligence\" OR LLM",
  language: "en",
  sort_by: "publishedAt",
  page_size: 20,
})

var headlines = tools.newsapi_top_headlines({
  country: "us",
  category: "technology",
  page_size: 10,
})

var sources = tools.newsapi_sources({
  language: "en",
  country: "us",
})
```