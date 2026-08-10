# ReadMe

Namespace: `readme`

Use this integration to inspect ReadMe project metadata, API keys, branches,
categories, category pages, guide pages, API reference pages, API definitions,
and documentation search results.

## Authentication

ReadMe requires `api_token`. Create an API token in ReadMe and configure it as
the integration secret. The integration sends it as a Bearer token.

## Tools

- `readme_get_project_metadata`
- `readme_list_api_keys`
- `readme_list_branches`, `readme_get_branch`
- `readme_list_categories`, `readme_get_category`,
  `readme_list_category_pages`
- `readme_get_guide`, `readme_get_reference`
- `readme_list_api_definitions`, `readme_get_api_definition`
- `readme_search_docs`

## Sections

Branch content endpoints require a `section` value. Supported values are
`guides`, `reference`, `recipes`, and `custom_pages`.

## Return Notes

Responses keep ReadMe's upstream JSON shape. Slugs, titles, branch names, and
API definition IDs are URL-encoded by the integration. Search uses ReadMe's
documented legacy search endpoint and sends `version` as the `x-readme-version`
header when provided.

## Examples

```js
var branches = tools.readme_list_branches({
  per_page: 20,
})

var categories = tools.readme_list_categories({
  branch: "stable",
  section: "guides",
})

var pages = tools.readme_list_category_pages({
  branch: "stable",
  section: "guides",
  title: "Getting Started",
  per_page: 25,
})

var guide = tools.readme_get_guide({
  branch: "stable",
  slug: "authentication",
})

var results = tools.readme_search_docs({
  search: "webhooks",
  version: "v1.0",
})
```