# Quickbase Lua Reference

Namespace: `quickbase`

Quickbase tools target the REST API at `https://api.quickbase.com/v1`. Configure
a user token and realm hostname. The integration sends `Authorization:
Bearer <token>` and `QB-Realm-Hostname: <realm>`.

## Apps

```lua
local apps = app.integrations.quickbase.list_apps({
  params = { name = "Operations" }
})

local app_meta = app.integrations.quickbase.get_app({ appId = "bqxxx" })
```

Write tools include `create_app`, `copy_app`, and `delete_app`. Use delete
tools carefully; some realms require the app name as confirmation.

## Tables And Fields

```lua
local tables = app.integrations.quickbase.list_tables({ appId = "bqxxx" })
local table = app.integrations.quickbase.get_table({ tableId = "brxxx" })

local fields = app.integrations.quickbase.list_fields({
  tableId = "brxxx",
  params = { includeFieldPerms = true }
})

local field = app.integrations.quickbase.get_field({
  tableId = "brxxx",
  fieldId = 6
})
```

Write tools include `create_table`, `update_table`, `delete_table`,
`create_field`, `update_field`, and `delete_field`.

## Records

```lua
local records = app.integrations.quickbase.list_records({
  tableId = "brxxx",
  where = "{6.EX.'Open'}",
  select = {3, 6, 7},
  options = { skip = 0, top = 100 }
})

local created = app.integrations.quickbase.create_record({
  tableId = "brxxx",
  fields = {
    { fieldId = 6, value = "Open" }
  }
})

local upserted = app.integrations.quickbase.upsert_records({
  tableId = "brxxx",
  data = {
    { [6] = { value = "Open" } }
  },
  mergeFieldId = 3,
  fieldsToReturn = {3, 6}
})
```

`delete_records({ tableId, where })` deletes every record matching the Quickbase
query expression. Build and review `where` clauses carefully.

## Reports And Relationships

```lua
local reports = app.integrations.quickbase.list_reports({ tableId = "brxxx" })
local report = app.integrations.quickbase.get_report({
  tableId = "brxxx",
  reportId = "7"
})
local rows = app.integrations.quickbase.run_report({
  tableId = "brxxx",
  reportId = "7",
  body = { skip = 0, top = 100 }
})
```

Relationship tools include `list_relationships`, `create_relationship`, and
`delete_relationship`.

## User And Generic API

```lua
local user = app.integrations.quickbase.get_current_user({})

local raw = app.integrations.quickbase.api_get({
  path = "/fields",
  params = { tableId = "brxxx" }
})
```

Available generic tools: `api_get`, `api_post`, and `api_delete`. Use them for
documented REST endpoints not yet wrapped directly.
