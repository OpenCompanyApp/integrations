# Wikidata

Namespace: `wikidata`

Use this integration to search and retrieve public Wikidata entities, inspect
claims, run bounded SPARQL queries, and build stable entity data or page URLs.

## Authentication

The read-only Wikidata APIs used here are public and require no credentials.

## Tools

- `wikidata_search_entities`: search items or properties with
  `wbsearchentities`.
- `wikidata_get_entities`: retrieve entities with `wbgetentities`.
- `wikidata_get_claims`: retrieve claims with `wbgetclaims`.
- `wikidata_sparql`: run a Wikidata Query Service SPARQL query.
- `wikidata_entity_data_url`: build a `Special:EntityData` URL.
- `wikidata_entity_page_url`: build a canonical Wikidata page URL.

## Return Notes

Action API responses keep upstream Wikidata fields. Multiple IDs and props use
Wikidata's pipe-separated syntax, for example `Q42|Q60` or
`labels|descriptions|claims`.

Keep SPARQL queries selective and bounded. Prefer `wikidata_search_entities`
and `wikidata_get_entities` for simple entity lookup instead of using SPARQL
for text search.

## Examples

```ruby
results = app.integrations.wikidata.search_entities(search: "Douglas Adams", language: "en", limit: 5)
entity = app.integrations.wikidata.get_entities(ids: "Q42", props: "labels|descriptions|claims", languages: "en")
query = app.integrations.wikidata.sparql(query: "\n    SELECT ?item ?itemLabel WHERE {\n      ?item wdt:P31 wd:Q5.\n      SERVICE wikibase:label { bd:serviceParam wikibase:language \"en\". }\n    }\n    LIMIT 5\n  ")
```