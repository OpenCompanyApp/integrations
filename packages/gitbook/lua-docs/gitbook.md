# GitBook

Namespace: `gitbook`

Use this integration to inspect GitBook organizations, spaces, current content,
pages, files, search results, and OpenAPI references.

## Authentication

GitBook requires `api_token`. Create a personal access token in GitBook
developer settings. The integration sends it as a Bearer token.

## Tools

- `gitbook_list_organizations`, `gitbook_get_organization`,
  `gitbook_search_organization`
- `gitbook_list_spaces`, `gitbook_get_space`, `gitbook_search_space`
- `gitbook_get_space_content`, `gitbook_list_pages`, `gitbook_get_page`,
  `gitbook_get_page_by_path`
- `gitbook_list_files`, `gitbook_get_file`
- `gitbook_list_openapi_specs`

## Return Notes

Responses keep GitBook's upstream JSON shape. Use `format = "markdown"` when
you need page content that is easier for agents to quote, summarize, or diff.

## Examples

```lua
local orgs = tools.gitbook_list_organizations({})

local spaces = tools.gitbook_list_spaces({
  organization_id = "org_abc",
  limit = 20
})

local results = tools.gitbook_search_space({
  space_id = "space_abc",
  query = "authentication",
  limit = 10
})

local page = tools.gitbook_get_page_by_path({
  space_id = "space_abc",
  page_path = "developers/api",
  format = "markdown"
})
```
