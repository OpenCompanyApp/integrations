# OpenAlex

Namespace: `openalex`

OpenAlex provides a scholarly graph covering works, authors, sources, institutions, topics, funders, publishers, geographic entities, classifications, and API utilities. The integration uses the current OpenAlex API reference and intentionally excludes deprecated `concepts`; use `topics`, `domains`, `fields`, and `subfields` instead.

All tools require an OpenAlex API key. Changefile tools may require a paid OpenAlex plan.

## Entity Pattern

Most entities have a list tool and a get tool:

```lua
local works = openalex.list_works({
  search = "agentic retrieval",
  filter = {
    publication_year = 2024,
    is_oa = true,
  },
  sort = "cited_by_count:desc",
  per_page = 10,
  select = { "id", "display_name", "doi", "cited_by_count" },
})

local author = openalex.get_author({
  id = "https://orcid.org/0000-0001-6187-6610",
  select = { "id", "display_name", "works_count", "cited_by_count" },
})
```

List tools support `search`, `filter`, `sort`, `per_page`, `page`, `cursor`, `sample`, `seed`, `select`, and `group_by`. `filter` can be a raw OpenAlex filter string or a Lua table; tables are converted to OpenAlex comma-separated `field:value` syntax. `select` arrays are sent comma-separated.

## Current Entity Coverage

- `works`
- `authors`
- `sources`
- `institutions`
- `topics`
- `domains`
- `fields`
- `subfields`
- `sdgs`
- `countries`
- `continents`
- `languages`
- `keywords`
- `publishers`
- `funders`
- `awards`
- `work_types`
- `source_types`
- `institution_types`
- `licenses`

## Autocomplete

Use `openalex.autocomplete` for typeahead suggestions. Supported entities are `works`, `authors`, `sources`, `institutions`, `topics`, `keywords`, `publishers`, and `funders`.

```lua
local suggestions = openalex.autocomplete({
  entity = "authors",
  q = "Ada Lovelace",
})
```

## Utilities

- `openalex.rate_limit` checks the current API-key rate-limit status.
- `openalex.list_changefiles` lists available changefile dates.
- `openalex.get_changefile` gets changefile details for a specific date.

```lua
local usage = openalex.rate_limit({})

local changefile = openalex.get_changefile({
  date = "2026-01-01",
})
```

## Return Shape

The integration returns OpenAlex JSON directly, preserving upstream fields. List responses usually include:

- `meta`
- `results`
- `group_by`

Singleton get tools return the entity object. API errors are returned as tool errors with the OpenAlex error message when available.
