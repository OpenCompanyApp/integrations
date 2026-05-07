# Zendesk Sell Lua Reference

Namespace: `app.integrations["zendesk-sell"]`

Use Zendesk Sell field names directly for expanded endpoint tools. Write tools
wrap your arguments inside the Sell API `data` envelope before sending the
request.

## Core Records

Contacts, leads, and deals support list, get, create, update, delete, and
upsert tools.

```lua
local contact = app.integrations["zendesk-sell"].create_contact({
  first_name = "Ada",
  last_name = "Example",
  email = "ada@example.test",
  contact_id = 100
})

local deal = app.integrations["zendesk-sell"].create_deal({
  name = "Website Redesign",
  value = 25000,
  currency = "USD",
  stage_id = 2,
  contact_id = contact.data.id
})
```

Use upsert tools when an external identifier or email should prevent duplicate
records:

```lua
local lead = app.integrations["zendesk-sell"].upsert_lead({
  email = "ada@example.test",
  first_name = "Ada",
  last_name = "Example",
  custom_fields = {
    external_id = "lead-123"
  }
})
```

## Activities

Tasks and notes require a related resource.

```lua
app.integrations["zendesk-sell"].create_task({
  content = "Follow up",
  resource_type = "deal",
  resource_id = 12345,
  due_date = "2026-05-20"
})

app.integrations["zendesk-sell"].create_note({
  content = "Budget confirmed.",
  resource_type = "deal",
  resource_id = 12345,
  is_important = true
})
```

## Metadata

Use metadata tools to find valid IDs before writing records:

- `list_users`, `get_user`
- `list_pipelines`, `get_pipeline`
- `list_stages`, `get_stage`
- `list_deal_sources`, `list_lead_sources`, `list_loss_reasons`
- `list_products`, `get_product`

## Return Shape

Tools return Zendesk Sell's decoded JSON. Collections usually return `items`
and `meta`; single-record operations usually return `data` and `meta`.

## Multi-Account Usage

```lua
app.integrations["zendesk-sell"].list_contacts({ page = 1 })
app.integrations["zendesk-sell"].production.list_contacts({ page = 1 })
```
