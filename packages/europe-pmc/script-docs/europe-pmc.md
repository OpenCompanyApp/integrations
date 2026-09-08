# Europe PMC

Namespace: `europe-pmc`

Europe PMC provides public APIs for life-sciences publications, full-text XML, citations and references, database links, annotations, and GRIST grant data. No credentials are required.

## Publication Search

Use `europe_pmc_search` for normal queries and `europe_pmc_search_post` for long queries.

```ruby
results = app.call("integrations.europe-pmc.search", query: "TITLE:\"large language model\" AND OPEN_ACCESS:Y", result_type: "core", page_size: 25, cursor_mark: "*")
```
Common `resultType` values are `idlist`, `lite`, and `core`. `format` defaults to `json`; XML and Dublin Core are available where Europe PMC supports them.

## Article Metadata

```ruby
article = app.call("integrations.europe-pmc.article", source: "MED", id: "28585529", result_type: "core")
```
Use `source` values from Europe PMC such as `MED`, `PMC`, `AGR`, or `PAT`.

## Citation Network And Links

```ruby
refs = app.call("integrations.europe-pmc.references", source: "MED", id: "28585529")
cited_by = app.call("integrations.europe-pmc.citations", source: "MED", id: "28585529")
db_links = app.call("integrations.europe-pmc.database_links", source: "MED", id: "28585529")
scholix = app.call("integrations.europe-pmc.data_links", source: "MED", id: "28585529")
```
`europe_pmc_labs_links` returns external links supplied by third-party providers. `europe_pmc_evaluations` returns evaluations when Europe PMC has them for the article.

## Full Text

```ruby
xml = app.call("integrations.europe-pmc.full_text_xml", id: "PMC1664601")
```
Full-text and book XML responses are parsed under `xml`. Supplementary files may return a zip/binary body, exposed as `body` with `content_type`.

## Fields, Profiles, Metrics

```ruby
fields = app.call("integrations.europe-pmc.fields")
profile = app.call("integrations.europe-pmc.profile", query: "malaria")
metrics = app.call("integrations.europe-pmc.metrics")
```
Use `fields` to discover query fields before building advanced searches.

## Annotations

```ruby
annotations = app.call("integrations.europe-pmc.annotations_by_articles", article_ids: ["MED:28585529", "PMC:PMC1664601"], type: "Chemicals")
```
Other annotation tools query by entity, provider, relationship, or section/type. `europe_pmc_annotations_by_section_or_type` requires at least `section` or `type`.

## Grants

Use `europe_pmc_grants_search` for GRIST grant data.

```ruby
grants = app.call("integrations.europe-pmc.grants_search", query: "ga:\"Wellcome Trust\" pi:smith", result_type: "core", page: 1)
```
GRIST fielded search examples include `gid:083611`, `title:cancer`, `pi:smith`, `aff:Cambridge`, and `epmc_funders:yes`.
