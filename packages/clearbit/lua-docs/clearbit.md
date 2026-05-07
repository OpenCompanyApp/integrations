# Clearbit Lua API Reference

Namespace: `app.integrations.clearbit`

Clearbit exposes B2B person, company, reveal, prospector, discovery, autocomplete, name-to-domain, and risk APIs. Most tools require an API key. `list_autocomplete` is public. Name-to-domain and risk are legacy unsupported APIs for existing Clearbit customers.

## Enrichment

```lua
local person = app.integrations.clearbit.enrich_person({
  email = "person@example.test"
})

local combined = app.integrations.clearbit.enrich_combined({
  email = "person@example.test"
})

local company = app.integrations.clearbit.enrich_company({
  domain = "example.test"
})
```

`enrich_combined` returns Clearbit's combined person/company response. Use it when you need both the individual contact and company context from one email lookup.

## Reveal

```lua
local reveal = app.integrations.clearbit.reveal({
  ip = "203.0.113.10"
})
```

Reveal identifies the company associated with an IP address. It does not identify the specific person visiting the site.

## Prospector

```lua
local prospects = app.integrations.clearbit.prospect({
  domain = "example.test",
  roles = "sales,engineering",
  seniority = "executive",
  page = 1
})
```

Useful filters include `domain`, `role`, `roles`, `seniority`, `title`, `company`, and `page`.

## Company Lookup

```lua
local suggestions = app.integrations.clearbit.list_autocomplete({
  name = "Example"
})

local domain = app.integrations.clearbit.name_to_domain({
  name = "Example"
})
```

Autocomplete is public and returns matching company names, domains, and logos. Name-to-domain requires an existing Clearbit API key and may be unavailable for new accounts.

## Discovery And Risk

```lua
local companies = app.integrations.clearbit.discovery_search({
  params = {
    query = "name:example",
    limit = 10
  }
})

local risk = app.integrations.clearbit.calculate_risk({
  params = {
    email = "person@example.test",
    ip = "203.0.113.10",
    name = "Example Person"
  }
})
```

Risk is a legacy unsupported API. Treat errors from this endpoint as a plan or product-availability issue unless credentials are known to have Risk access.

## Long-Tail GET Endpoints

```lua
local result = app.integrations.clearbit.api_get({
  api = "company",
  path = "/companies/find",
  params = { domain = "example.test" }
})
```

`api` must be one of `person`, `company`, `autocomplete`, `prospector`, `reveal`, `discovery`, `risk`, or `name_to_domain`. The path must be relative, not a full URL.

## Multi-Account Usage

```lua
app.integrations.clearbit.enrich_company({ domain = "example.test" })
app.integrations.clearbit.default.enrich_company({ domain = "example.test" })
app.integrations.clearbit.sales.enrich_person({ email = "person@example.test" })
```

All functions are identical across accounts; only credentials differ.
