# Close CRM Lua API Reference

Namespace: `close`

Close tools call the Close REST API at `https://api.close.com/api/v1` using HTTP Basic auth with the API key as the username and an empty password. Outputs are normalized only where older list tools already wrapped Close pagination; newer endpoint tools return the Close JSON object or list response directly.

## Common IDs

- Leads use IDs such as `lead_abc123`.
- Contacts use IDs such as `cont_abc123`.
- Opportunities use IDs such as `oppo_abc123`.
- Tasks use IDs such as `task_abc123`.
- Users use IDs such as `user_abc123`.

## Leads

```lua
local leads = app.integrations.close.list_leads({
  query = "status:Potential",
  limit = 25,
  skip = 0,
})

local lead = app.integrations.close.get_lead({ id = "lead_example" })

local created = app.integrations.close.create_lead({
  name = "Example Corp",
  url = "https://example.test",
  contacts = {
    {
      name = "Pat Example",
      emails = {{ email = "pat@example.test", type = "office" }},
    },
  },
})

local updated = app.integrations.close.update_lead({
  id = "lead_example",
  status_id = "stat_example",
})
```

`delete_lead` permanently deletes the lead and associated Close child records:

```lua
app.integrations.close.delete_lead({ id = "lead_example" })
```

## Contacts

```lua
local contacts = app.integrations.close.list_contacts({
  lead_id = "lead_example",
  limit = 25,
})

local contact = app.integrations.close.get_contact({ id = "cont_example" })

local created = app.integrations.close.create_contact({
  lead_id = "lead_example",
  name = "Sam Contact",
  title = "VP Sales",
  emails = {{ email = "sam@example.test", type = "office" }},
  phones = {{ phone = "+15550101010", type = "office" }},
})

local updated = app.integrations.close.update_contact({
  id = "cont_example",
  title = "Head of Sales",
})

app.integrations.close.delete_contact({ id = "cont_example" })
```

## Opportunities

```lua
local opportunities = app.integrations.close.list_opportunities({
  lead_id = "lead_example",
  status_id = "stat_example",
  _limit = 25,
})

local opportunity = app.integrations.close.get_opportunity({ id = "oppo_example" })

local created = app.integrations.close.create_opportunity({
  lead_id = "lead_example",
  status_id = "stat_example",
  note = "Initial deal",
  value = 250000,
  value_period = "one_time",
  expected_close_date = "2026-06-30",
  confidence = 60,
})

local updated = app.integrations.close.update_opportunity({
  id = "oppo_example",
  confidence = 75,
})

app.integrations.close.delete_opportunity({ id = "oppo_example" })
```

## Tasks

Close task list filters accept fields such as `lead_id`, `assigned_to`, `is_complete`, `_type`, date filters, `_limit`, and `_skip`. Use `_type = "all"` when you want system task types in addition to lead tasks.

```lua
local tasks = app.integrations.close.list_tasks({
  lead_id = "lead_example",
  assigned_to = "user_example",
  is_complete = false,
  _type = "all",
})

local created = app.integrations.close.create_task({
  text = "Follow up with buyer",
  lead_id = "lead_example",
  assignee_id = "user_example",
  date = "2026-05-15",
})

local task = app.integrations.close.get_task({ id = "task_example" })

local updated = app.integrations.close.update_task({
  id = "task_example",
  is_complete = true,
})

app.integrations.close.delete_task({ id = "task_example" })
```

## Activities And Notes

`list_activities` lists activity records across types. Note-specific tools map to `/activity/note/`.

```lua
local activities = app.integrations.close.list_activities({
  lead_id = "lead_example",
  type = "note",
  limit = 25,
})

local notes = app.integrations.close.list_notes({
  lead_id = "lead_example",
  _limit = 25,
})

local note = app.integrations.close.create_note({
  lead_id = "lead_example",
  note = "Buyer asked for implementation timeline.",
})

local fetched = app.integrations.close.get_note({ id = "acti_example" })

local updated = app.integrations.close.update_note({
  id = "acti_example",
  note = "Updated implementation timeline note.",
})

app.integrations.close.delete_note({ id = "acti_example" })
```

## Users

```lua
local me = app.integrations.close.get_current_user({})

local users = app.integrations.close.list_users({
  _limit = 50,
})

local user = app.integrations.close.get_user({ id = "user_example" })

local availability = app.integrations.close.list_user_availability({})
```

## Statuses And Pipelines

Lead statuses:

```lua
local statuses = app.integrations.close.list_lead_statuses({})

local created = app.integrations.close.create_lead_status({
  label = "Qualified",
})

app.integrations.close.update_lead_status({
  id = "stat_example",
  label = "Qualified Inbound",
})

app.integrations.close.delete_lead_status({ id = "stat_example" })
```

Opportunity statuses:

```lua
local statuses = app.integrations.close.list_opportunity_statuses({})

local created = app.integrations.close.create_opportunity_status({
  label = "Negotiation",
  type = "active",
  pipeline_id = "pipe_example",
})

app.integrations.close.update_opportunity_status({
  id = "stat_example",
  label = "Contracting",
})

app.integrations.close.delete_opportunity_status({ id = "stat_example" })
```

Pipelines:

```lua
local pipelines = app.integrations.close.list_pipelines({})

local pipeline = app.integrations.close.create_pipeline({
  name = "Outbound Sales",
})

app.integrations.close.update_pipeline({
  id = "pipe_example",
  name = "Enterprise Sales",
})

app.integrations.close.delete_pipeline({ id = "pipe_example" })
```

## Multi-Account

Hosts can expose account-scoped namespaces. The functions are the same; only the resolved Close credentials differ.

```lua
app.integrations.close.default.list_leads({ query = "Acme" })
app.integrations.close.enterprise.list_opportunities({ _limit = 10 })
```
