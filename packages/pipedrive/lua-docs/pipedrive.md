# Pipedrive Lua Docs

Namespace: `pipedrive`

This integration is generated from Pipedrive's official v1 and v2 OpenAPI schemas and exposes 371 operations. Use it for CRM automation across deals, persons, organizations, activities, products, leads, projects, notes, files, webhooks, goals, fields, pipelines, stages, users, and search.

## Authentication

Configure a Pipedrive API token. Requests use the `x-api-token` header. The API root defaults to `https://api.pipedrive.com`; versioned URLs ending in `/v1` or `/api/v2` are normalized.

## Common Tools

- `pipedrive_list_deals`, `pipedrive_get_deal`, `pipedrive_create_deal`, `pipedrive_update_deal`
- `pipedrive_list_persons`, `pipedrive_get_person`, `pipedrive_create_person`, `pipedrive_update_person`
- `pipedrive_list_organizations`, `pipedrive_get_organization`, `pipedrive_create_organization`, `pipedrive_update_organization`
- `pipedrive_search_persons`, `pipedrive_search_organizations`
- v2 tools use the `pipedrive_v2_` prefix, for example `pipedrive_v2_get_deals` and `pipedrive_v2_search_item`.

## Generated Operation Pattern

Path and query parameters use snake_case names. For write operations, pass the JSON payload as `body`. Extra top-level arguments that are not path, query, or header parameters are sent as the JSON body.

```lua
local deals = pipedrive.pipedrive_list_deals({
  status = "open",
  limit = 10
})

local created = pipedrive.pipedrive_create_deal({
  body = {
    title = "Example opportunity",
    value = 12000,
    currency = "USD"
  }
})
```

Return values are the parsed Pipedrive JSON response for the operation. The integration does not unwrap the `data` field; agents should read the documented response shape for the selected endpoint.
