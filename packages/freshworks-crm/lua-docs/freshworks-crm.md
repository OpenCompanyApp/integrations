# Freshworks CRM Lua API Reference

Namespace: `freshworks-crm`

Freshworks CRM tools call Freshsales/Freshworks CRM REST endpoints under a base URL ending in `/crm/sales`, for example `https://example.myfreshworks.com/crm/sales`.

## Contacts

```lua
local contacts = app.integrations["freshworks-crm"].freshworks_crm_list_contacts({
  page = 1,
  per_page = 25,
})

local contact = app.integrations["freshworks-crm"].freshworks_crm_get_contact({ id = 123 })

local created = app.integrations["freshworks-crm"].freshworks_crm_create_contact({
  first_name = "Ada",
  last_name = "Example",
  email = "ada@example.test",
})

app.integrations["freshworks-crm"].freshworks_crm_update_contact({
  id = 123,
  job_title = "VP Sales",
})

app.integrations["freshworks-crm"].freshworks_crm_delete_contact({ id = 123 })
```

Contact filters and views:

```lua
local filters = app.integrations["freshworks-crm"].freshworks_crm_list_contact_filters({})

local view = app.integrations["freshworks-crm"].freshworks_crm_get_contact_view({
  view_id = 3,
  page = 1,
  per_page = 25,
})
```

## Sales Accounts And Deals

```lua
local accounts = app.integrations["freshworks-crm"].freshworks_crm_list_accounts({ page = 1 })

local account = app.integrations["freshworks-crm"].freshworks_crm_create_account({
  name = "Example Corp",
  website = "https://example.test",
})

local deals = app.integrations["freshworks-crm"].freshworks_crm_list_deals({
  page = 1,
  per_page = 25,
})

local deal = app.integrations["freshworks-crm"].freshworks_crm_create_deal({
  name = "Example Renewal",
  amount = 25000,
  sales_account_id = 456,
})
```

Accounts and deals each have matching `get`, `update`, `delete`, filter-list, view, and bulk-upsert tools where supported by Freshworks CRM.

## Tasks And Appointments

```lua
local tasks = app.integrations["freshworks-crm"].freshworks_crm_list_tasks({
  filter = "open",
  page = 1,
})

local task = app.integrations["freshworks-crm"].freshworks_crm_create_task({
  title = "Follow up",
  targetable_id = 123,
  targetable_type = "Contact",
})

local appointments = app.integrations["freshworks-crm"].freshworks_crm_list_appointments({
  filter = "upcoming",
})

local appointment = app.integrations["freshworks-crm"].freshworks_crm_create_appointment({
  title = "Discovery call",
  targetable_id = 123,
  targetable_type = "Contact",
})
```

Tasks and appointments each have matching `get`, `update`, and `delete` tools.

## Notes, Calls, And Activities

```lua
local note = app.integrations["freshworks-crm"].freshworks_crm_create_note({
  description = "Buyer asked about implementation timeline.",
  targetable_id = 123,
  targetable_type = "Contact",
})

local call = app.integrations["freshworks-crm"].freshworks_crm_create_phone_call({
  targetable_id = 123,
  targetable_type = "Contact",
  phone_number = "+15550101010",
  direction = "outgoing",
})

local activities = app.integrations["freshworks-crm"].freshworks_crm_list_sales_activities({
  page = 1,
  per_page = 25,
})

local activity = app.integrations["freshworks-crm"].freshworks_crm_create_sales_activity({
  title = "Demo completed",
  targetable_id = 678,
  targetable_type = "Deal",
})
```

Notes and sales activities have matching `get`, `update`, and `delete` tools.

## Search And Metadata

```lua
local me = app.integrations["freshworks-crm"].freshworks_crm_get_current_user({})

local results = app.integrations["freshworks-crm"].freshworks_crm_search({
  q = "Example Corp",
})

local lookup = app.integrations["freshworks-crm"].freshworks_crm_lookup({
  q = "ada@example.test",
})

local contact_fields = app.integrations["freshworks-crm"].freshworks_crm_list_contact_fields({})
local account_fields = app.integrations["freshworks-crm"].freshworks_crm_list_account_fields({})
local deal_fields = app.integrations["freshworks-crm"].freshworks_crm_list_deal_fields({})
local activity_fields = app.integrations["freshworks-crm"].freshworks_crm_list_sales_activity_fields({})
```

## Multi-Account

Hosts can expose account-scoped namespaces. The functions are identical; only credentials differ.

```lua
app.integrations["freshworks-crm"].default.freshworks_crm_list_contacts({ page = 1 })
app.integrations["freshworks-crm"].eu_team.freshworks_crm_list_deals({ page = 1 })
```
