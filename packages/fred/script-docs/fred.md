# FRED

Namespace: `fred`

Use this integration to browse Federal Reserve Economic Data categories,
releases, sources, tags, series metadata, observations, and vintage dates.

## Authentication

FRED requires an API key. Configure `api_key` once; tools add it to requests as
the FRED `api_key` query parameter and request JSON responses with
`file_type=json`.

## Tool Groups

- Categories: `fred_category`, `fred_category_children`,
  `fred_category_related`, `fred_category_series`, `fred_category_tags`,
  `fred_category_related_tags`.
- Releases: `fred_releases`, `fred_releases_dates`, `fred_release`,
  `fred_release_dates`, `fred_release_series`, `fred_release_sources`,
  `fred_release_tags`, `fred_release_related_tags`, `fred_release_tables`.
- Series: `fred_series`, `fred_series_categories`,
  `fred_series_observations`, `fred_series_release`, `fred_series_search`,
  `fred_series_search_tags`, `fred_series_search_related_tags`,
  `fred_series_tags`, `fred_series_updates`, `fred_series_vintagedates`.
- Sources: `fred_sources`, `fred_source`, `fred_source_releases`.
- Tags: `fred_tags`, `fred_related_tags`, `fred_tags_series`.

## Return Notes

Responses keep FRED's upstream JSON shape. The integration does not rename
fields such as `seriess`, `observations`, `categories`, `releases`, `tags`,
`sources`, `release_dates`, or `vintage_dates`.

Use FRED's semicolon-separated tag syntax for `tag_names` and
`exclude_tag_names`, for example `usa;monthly`. Use comma-separated
`vintage_dates` for series observations.

## Examples

```js
var matches = tools.fred_series_search({
  search_text: "unemployment rate",
  limit: 5,
  order_by: "popularity",
  sort_order: "desc",
})

var observations = tools.fred_series_observations({
  series_id: "UNRATE",
  observation_start: "2020-01-01",
  observation_end: "2026-01-01",
  units: "lin",
})

var categorySeries = tools.fred_category_series({
  category_id: 125,
  tag_names: "usa;monthly",
  limit: 10,
})
```