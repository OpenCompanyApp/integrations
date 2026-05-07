# Apollo.io Lua Reference

Namespace: `apollo`

Apollo separates net-new database records from records saved to your team:

- `search_people` searches Apollo's people database.
- `search_contacts` searches contacts saved in your team account.
- `list_organizations` searches Apollo's organization database. The legacy slug
  is retained even though the upstream operation is Organization Search.
- `search_accounts` searches accounts saved in your team account.

Some endpoints require a master API key or plan-specific access. A `403` usually
means the key is valid but the Apollo account cannot use that endpoint.
Requests are authenticated with Apollo's `X-Api-Key` header, not a bearer token.

## Search And Enrichment

```lua
local people = app.integrations.apollo.search_people({
  q_keywords = "revenue operations",
  person_titles = { "VP Sales", "Head of Revenue" },
  page = 1,
  per_page = 10,
})

local person = app.integrations.apollo.enrich({
  email = "person@example.test",
  reveal_personal_emails = false,
})

local bulk_people = app.integrations.apollo.bulk_enrich_people({
  details = {
    { email = "one@example.test" },
    { name = "Jane Example", domain = "example.test" },
  },
})

local orgs = app.integrations.apollo.list_organizations({
  q_organization_name = "example",
  organization_locations = { "california" },
})

local org = app.integrations.apollo.enrich_organization({
  domain = "example.test",
})

local bulk_orgs = app.integrations.apollo.bulk_enrich_organizations({
  domains = { "example.test", "example.invalid" },
})
```

Use the `filters` object for documented Apollo filters that do not have a named
parameter in this package:

```lua
local result = app.integrations.apollo.search_people({
  filters = {
    person_seniorities = { "director", "vp" },
    organization_num_employees_ranges = { "100,250" },
  },
  per_page = 25,
})
```

## Contacts

```lua
local contacts = app.integrations.apollo.search_contacts({
  q_keywords = "example",
  page = 1,
  per_page = 10,
})

local contact = app.integrations.apollo.get_contact({
  contact_id = "66e34b81740c50074e3d1bd4",
})

local created = app.integrations.apollo.create_contact({
  first_name = "Jane",
  last_name = "Example",
  email = "jane@example.test",
  organization_name = "Example Inc",
  run_dedupe = true,
})

local updated = app.integrations.apollo.update_contact({
  contact_id = "66e34b81740c50074e3d1bd4",
  title = "VP Sales",
})

local stages = app.integrations.apollo.list_contact_stages({})
```

## Accounts

```lua
local accounts = app.integrations.apollo.search_accounts({
  q_organization_name = "example",
  page = 1,
})

local account = app.integrations.apollo.get_organization({
  account_id = "6518c6184f20350001a0b9c0",
})

local created = app.integrations.apollo.create_account({
  name = "Example Inc",
  domain = "example.test",
})

local updated = app.integrations.apollo.update_account({
  account_id = "6518c6184f20350001a0b9c0",
  account_stage_id = "6095a710bd01d100a506d4b9",
})

local stages = app.integrations.apollo.list_account_stages({})
```

## Team Metadata

```lua
local usage = app.integrations.apollo.get_api_usage_stats({})
local users = app.integrations.apollo.list_users({})
local email_accounts = app.integrations.apollo.list_email_accounts({})
```

## Normalized Output

Tools return Apollo's JSON response with only transport errors normalized. Agents
should inspect the upstream keys such as `people`, `contacts`, `organizations`,
`accounts`, `pagination`, or endpoint-specific result arrays.
