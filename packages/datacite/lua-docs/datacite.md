# DataCite

Namespace: `datacite`

DataCite exposes public DOI metadata, clients/repositories, providers, prefixes, Event Data, usage reports, activities, heartbeat status, and a read-only GraphQL API. No API key is required for the public retrieval tools.

Mutation endpoints for creating, updating, or deleting DOIs and repositories are intentionally not exposed by this integration.

## DOI Metadata

```lua
local dois = datacite.list_dois({
  query = "climate data",
  ["client-id"] = "datacite.datacite",
  ["page[size]"] = 10,
  sort = "-created",
  detail = true,
})

local doi = datacite.get_doi({
  id = "10.5438/0012",
})
```

`datacite_list_dois` supports common DataCite filters such as `created`, `registered`, `published`, `provider-id`, `client-id`, `prefix`, `resource-type-id`, `random`, `sample-size`, `detail`, `include`, `page[number]`, `page[size]`, and `page[cursor]`.

## Repository And Provider Metadata

Use these tools for account and prefix discovery:

- `datacite_list_clients`
- `datacite_get_client`
- `datacite_client_stats`
- `datacite_list_client_prefixes`
- `datacite_list_providers`
- `datacite_get_provider`
- `datacite_provider_stats`
- `datacite_list_provider_prefixes`
- `datacite_list_prefixes`
- `datacite_get_prefix`
- `datacite_prefix_stats`

## Event Data And Reports

```lua
local events = datacite.list_events({
  doi = "10.5438/0012",
  ["relation-type-id"] = "references",
})

local status = datacite.heartbeat({})
```

Event Data tools expose links between DataCite DOIs and other DOIs or URLs. Report tools expose usage report metadata where available.

## GraphQL

```lua
local result = datacite.graphql_query({
  query = [[
    query($id: ID!) {
      dataset(id: $id) {
        id
        titles { title }
        publicationYear
      }
    }
  ]],
  variables = {
    id = "https://doi.org/10.5438/0012",
  },
})
```

The GraphQL API is read-only. It can query DOI resources, members, repositories, prefixes, researchers, funders, and organizations as supported by DataCite.

## Return Shape

REST tools return DataCite JSON:API responses directly, typically with `data`, `included`, `meta`, and `links`. GraphQL returns the GraphQL JSON response. Arrays in query parameters are sent as comma-separated values.
