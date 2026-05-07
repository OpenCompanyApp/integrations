# Europe PMC

Namespace: `europe-pmc`

Europe PMC provides public APIs for life-sciences publications, full-text XML, citations and references, database links, annotations, and GRIST grant data. No credentials are required.

## Publication Search

Use `europe_pmc_search` for normal queries and `europe_pmc_search_post` for long queries.

```lua
local results = europe_pmc.search({
  query = 'TITLE:"large language model" AND OPEN_ACCESS:Y',
  resultType = "core",
  pageSize = 25,
  cursorMark = "*",
})
```

Common `resultType` values are `idlist`, `lite`, and `core`. `format` defaults to `json`; XML and Dublin Core are available where Europe PMC supports them.

## Article Metadata

```lua
local article = europe_pmc.article({
  source = "MED",
  id = "28585529",
  resultType = "core",
})
```

Use `source` values from Europe PMC such as `MED`, `PMC`, `AGR`, or `PAT`.

## Citation Network And Links

```lua
local refs = europe_pmc.references({ source = "MED", id = "28585529" })
local cited_by = europe_pmc.citations({ source = "MED", id = "28585529" })
local db_links = europe_pmc.database_links({ source = "MED", id = "28585529" })
local scholix = europe_pmc.data_links({ source = "MED", id = "28585529" })
```

`europe_pmc_labs_links` returns external links supplied by third-party providers. `europe_pmc_evaluations` returns evaluations when Europe PMC has them for the article.

## Full Text

```lua
local xml = europe_pmc.full_text_xml({ id = "PMC1664601" })
```

Full-text and book XML responses are parsed under `xml`. Supplementary files may return a zip/binary body, exposed as `body` with `content_type`.

## Fields, Profiles, Metrics

```lua
local fields = europe_pmc.fields({})
local profile = europe_pmc.profile({ query = "malaria" })
local metrics = europe_pmc.metrics({})
```

Use `fields` to discover query fields before building advanced searches.

## Annotations

```lua
local annotations = europe_pmc.annotations_by_article_ids({
  articleIds = { "MED:28585529", "PMC:PMC1664601" },
  type = "Chemicals",
})
```

Other annotation tools query by entity, provider, relationship, or section/type. `europe_pmc_annotations_by_section_or_type` requires at least `section` or `type`.

## Grants

Use `europe_pmc_grants_search` for GRIST grant data.

```lua
local grants = europe_pmc.grants_search({
  query = 'ga:"Wellcome Trust" pi:smith',
  resultType = "core",
  page = 1,
})
```

GRIST fielded search examples include `gid:083611`, `title:cancer`, `pi:smith`, `aff:Cambridge`, and `epmc_funders:yes`.
