# US Census

Namespace: `us-census`

Use this integration to discover U.S. Census Data API datasets, inspect dataset
metadata, find variables and geographies, view official examples, and run data
queries.

## Authentication

The Census Data API is public. An `api_key` is optional; configure it when you
need higher allowed usage. The public API guide notes a 50-variable limit per
query and public unauthenticated rate limits.

## Tools

- `us_census_list_datasets`: search the global `data.json` dataset catalog.
- `us_census_dataset_metadata`: get root metadata for one dataset path.
- `us_census_variables`: list or search variables, optionally inside a group.
- `us_census_groups`: list or search variable groups.
- `us_census_geographies`: list supported geographies.
- `us_census_examples`: fetch official example queries.
- `us_census_data_query`: query data and normalize rows into records.
- `us_census_data_query_url`: build a shareable data query URL.

## Dataset Paths

Use dataset paths without `/data`, for example:

- `2023/acs/acs5`
- `2023/acs/acs1/profile`
- `2020/dec/pl`

## Examples

```lua
local variables = tools.us_census_variables({
  dataset = "2023/acs/acs5",
  q = "median household income",
  limit = 10
})

local rows = tools.us_census_data_query({
  dataset = "2023/acs/acs5",
  get = "NAME,B19013_001E",
  ["for"] = "state:*"
})

local counties = tools.us_census_data_query({
  dataset = "2023/acs/acs5",
  get = "NAME,B01001_001E",
  ["for"] = "county:*",
  ["in"] = "state:06"
})
```
