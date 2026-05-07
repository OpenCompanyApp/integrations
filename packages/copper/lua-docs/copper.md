# Copper CRM Lua API Reference

Namespace: `copper`

Copper calls contact records "People" in the official API. This package keeps the existing `contact` tool names for agent compatibility while routing them to Copper `/people` endpoints.

## Authentication

Copper requires:

- `api_key`
- `email`
- optional `url`, defaulting to `https://api.copper.com/developer_api/v1`

## People / Contacts

```lua
local people = app.integrations.copper.list_contacts({
  page_size = 25,
  page_number = 1,
  sort_by = "name",
})

local person = app.integrations.copper.get_contact({ id = 123 })

local by_email = app.integrations.copper.get_contact_by_email({
  email = "ada@example.test",
})

local created = app.integrations.copper.create_contact({
  name = "Ada Example",
  email = "ada@example.test",
})

local updated = app.integrations.copper.update_contact({
  id = 123,
  name = "Ada Lovelace",
})

app.integrations.copper.delete_contact({ id = 123 })
```

## Companies

```lua
local companies = app.integrations.copper.list_companies({
  page_size = 25,
  sort_by = "name",
})

local company = app.integrations.copper.get_company({ id = 456 })

local created = app.integrations.copper.create_company({
  name = "Example Corp",
})

app.integrations.copper.update_company({
  id = 456,
  details = "Enterprise account",
})

app.integrations.copper.delete_company({ id = 456 })
```

## Opportunities

```lua
local opportunities = app.integrations.copper.list_opportunities({
  page_size = 25,
  pipeline_ids = { 10 },
})

local opportunity = app.integrations.copper.get_opportunity({ id = 789 })

local created = app.integrations.copper.create_opportunity({
  name = "Example renewal",
  pipeline_id = 10,
})

app.integrations.copper.update_opportunity({
  id = 789,
  monetary_value = 250000,
  win_probability = 70,
})

app.integrations.copper.delete_opportunity({ id = 789 })
```

## Leads

```lua
local leads = app.integrations.copper.list_leads({
  page_size = 25,
  email = "buyer@example.test",
})

local lead = app.integrations.copper.get_lead({ id = 111 })

local created = app.integrations.copper.create_lead({
  name = "Buyer Example",
  company_name = "Example Corp",
  status_id = 222,
})

app.integrations.copper.update_lead({
  id = 111,
  details = "Qualified inbound lead",
})

app.integrations.copper.delete_lead({ id = 111 })
```

## Projects And Tasks

```lua
local projects = app.integrations.copper.list_projects({
  page_size = 25,
})

local project = app.integrations.copper.create_project({
  name = "Implementation",
  company_id = 456,
})

local tasks = app.integrations.copper.list_tasks({
  page_size = 25,
  status = "open",
})

local task = app.integrations.copper.create_task({
  name = "Follow up",
  assignee_id = 333,
  related_resource = { type = "company", id = 456 },
})
```

Each project and task also has matching `get`, `update`, and `delete` tools.

## Activities

```lua
local activities = app.integrations.copper.list_activities({
  page_size = 25,
  parent = { type = "person", id = 123 },
})

local activity = app.integrations.copper.create_activity({
  parent = { type = "person", id = 123 },
  type = { category = "user", id = 1 },
  details = "Discussed renewal timing.",
})

local types = app.integrations.copper.list_activity_types({})
```

Activities also support `get_activity`, `update_activity`, and `delete_activity`.

## Users, Pipelines, And Metadata

```lua
local me = app.integrations.copper.get_current_user({})
local users = app.integrations.copper.list_users({ page_size = 50 })
local account = app.integrations.copper.get_account_details({})

local pipelines = app.integrations.copper.list_pipelines({})
local stages = app.integrations.copper.list_pipeline_stages({})
local stages_for_pipeline = app.integrations.copper.list_pipeline_stages_in_pipeline({
  pipeline_id = 10,
})

local lead_statuses = app.integrations.copper.list_lead_statuses({})
local sources = app.integrations.copper.list_customer_sources({})
local loss_reasons = app.integrations.copper.list_loss_reasons({})
local contact_types = app.integrations.copper.list_contact_types({})
local tags = app.integrations.copper.list_tags({})
local custom_fields = app.integrations.copper.list_custom_field_definitions({})
```

## Webhooks

```lua
local hooks = app.integrations.copper.list_webhooks({})

local hook = app.integrations.copper.create_webhook({
  target = "https://example.test/hooks/copper",
  type = "person",
  event = "updated",
})

local fetched = app.integrations.copper.get_webhook({ id = 1001 })

app.integrations.copper.update_webhook({
  id = 1001,
  target = "https://example.test/hooks/copper-v2",
})

app.integrations.copper.delete_webhook({ id = 1001 })
```

## Multi-Account

Hosts can expose account-scoped namespaces. The functions are identical; only credentials differ.

```lua
app.integrations.copper.default.list_contacts({ page_size = 10 })
app.integrations.copper.sales.list_opportunities({ page_size = 10 })
```
