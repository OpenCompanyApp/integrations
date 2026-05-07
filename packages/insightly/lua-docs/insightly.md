# Insightly CRM Lua Reference

Namespace: `app.integrations.insightly`

Use Insightly field names for create and update bodies. Most record fields are
uppercase, such as `FIRST_NAME`, `ORGANISATION_NAME`, `OPPORTUNITY_NAME`,
`PROJECT_NAME`, `TASK_ID`, `TITLE`, `BODY`, and `CUSTOMFIELDS`.

## Common Parameters

List and search tools commonly accept:

| Name | Type | Description |
| ---- | ---- | ----------- |
| `top` | integer | Maximum number of records to return. |
| `skip` | integer | Number of records to skip. |
| `brief` | boolean | Return only top-level fields when Insightly supports it. |
| `count_total` | boolean | Ask Insightly to include total count metadata. |

Field search tools accept `field_name`, `field_value`, and
`updated_after_utc`. Tag search tools require `tagName`.

## Core Records

Tools include list, get, create, update, delete, field search, and tag search
for contacts, organizations, leads, opportunities, and projects where the
official API exposes those operations.

```lua
local contact = app.integrations.insightly.create_contact({
  first_name = "Ada",
  last_name = "Example",
  email = "ada@example.test",
  phone = "+1-555-0100"
})

local contacts = app.integrations.insightly.search_contacts({
  field_name = "EMAIL_ADDRESS",
  field_value = "ada@example.test"
})

local opportunity = app.integrations.insightly.update_opportunity({
  id = 12345,
  OPPORTUNITY_NAME = "Renewal",
  BID_AMOUNT = 25000,
  OPPORTUNITY_STATE = "OPEN"
})
```

## Activities

Use task tools for agent follow-up work and event tools for calendar-style CRM
activity. Note creation is exposed through the official note-comment and note
update/read endpoints in this package; parent record note endpoints can be
added separately if a host needs them.

```lua
local task = app.integrations.insightly.create_task({
  TITLE = "Send renewal proposal",
  DUE_DATE = "2026-05-20T12:00:00Z",
  OPPORTUNITY_ID = 12345,
  RESPONSIBLE_USER_ID = 678
})

local event = app.integrations.insightly.create_event({
  TITLE = "Implementation call",
  START_DATE_UTC = "2026-05-21T15:00:00Z",
  END_DATE_UTC = "2026-05-21T15:30:00Z"
})
```

## Metadata

Metadata tools help agents choose valid IDs before writing records:

- `list_pipelines`, `get_pipeline`, `list_pipeline_stages`,
  `get_pipeline_stage`
- `list_activity_sets`, `get_activity_set`
- `list_task_categories`, `create_task_category`, `update_task_category`,
  `delete_task_category`
- `list_lead_sources`, `list_lead_statuses`, `list_opportunity_categories`,
  `list_project_categories`
- `list_custom_fields`, `search_custom_fields`
- `list_countries`, `list_currencies`, `list_tags`, `list_permissions`,
  `get_instance`

```lua
local fields = app.integrations.insightly.list_custom_fields({
  objectName = "Contacts"
})

local stages = app.integrations.insightly.list_pipeline_stages({})
```

## Return Shape

Tools return the decoded Insightly JSON response. Legacy hand-written list tools
for contacts, opportunities, and projects wrap results as `{ records, count }`
style arrays; endpoint tools return the API response directly.

## Multi-Account Usage

```lua
app.integrations.insightly.list_contacts({ top = 10 })
app.integrations.insightly.production.list_contacts({ top = 10 })
```
