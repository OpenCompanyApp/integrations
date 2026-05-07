# Attio CRM Lua API Reference

Namespace: `app.integrations.attio`

This integration manages Attio CRM records, objects, attributes, lists, entries, notes, tasks, and webhooks through the Attio REST API. Tools return Attio's parsed JSON response directly, usually with the primary payload under `data`.

## Raw API Helpers

Use raw helpers for newer or less common Attio endpoints:

| Tool | Method |
|------|--------|
| `api_get` | GET |
| `api_post` | POST |
| `api_patch` | PATCH |
| `api_put` | PUT |
| `api_delete` | DELETE |

```lua
local result = app.integrations.attio.api_get({
  path = "/v2/lists"
})
```

## Records And Objects

| Tool | Purpose |
|------|---------|
| `list_objects` | List object definitions |
| `get_object` | Get one object definition |
| `list_records` | Query records for an object |
| `get_record` | Get one record |
| `create_record` | Create a record |
| `update_record` | Update record values |
| `delete_record` | Delete a record |
| `list_record_entries` | List list entries attached to a record |

```lua
local companies = app.integrations.attio.list_records({
  object_id = "companies",
  limit = 25,
  filters = { name = "Acme" }
})

local created = app.integrations.attio.create_record({
  object_id = "companies",
  data = {
    name = "Example Corp",
    website = "https://example.test"
  }
})

local updated = app.integrations.attio.update_record({
  object_id = "companies",
  record_id = "891dcbfc-9141-415d-9b2a-2238a6cc012d",
  values = {
    website = "https://example.test"
  }
})
```

## Attributes

| Tool | Purpose |
|------|---------|
| `list_attributes` | List attributes for an object or list |
| `get_attribute` | Get one attribute |
| `create_attribute` | Create an object or list attribute |

```lua
local attrs = app.integrations.attio.list_attributes({
  target = "objects",
  identifier = "companies"
})
```

For `target`, use `objects` for object attributes or `lists` for list attributes.

## Lists And Entries

| Tool | Purpose |
|------|---------|
| `list_lists` | List Attio lists |
| `get_list` | Get one list |
| `create_list` | Create a list |
| `update_list` | Update a list |
| `list_entries` | Query entries in a list |
| `create_entry` | Add a record to a list |
| `get_entry` | Get one list entry |
| `update_entry` | Update entry values |
| `delete_entry` | Delete an entry |

```lua
local entries = app.integrations.attio.list_entries({
  list_id = "sales-prospects",
  limit = 50,
  filter = { name = "Ada Lovelace" }
})

local entry = app.integrations.attio.create_entry({
  list_id = "sales-prospects",
  parent_object = "people",
  parent_record_id = "891dcbfc-9141-415d-9b2a-2238a6cc012d",
  entry_values = {
    status = "In Progress"
  }
})
```

`update_entry` uses Attio's PUT endpoint, which overwrites multiselect values.

## Notes, Tasks, And Webhooks

| Tool | Purpose |
|------|---------|
| `list_notes` | List notes globally or for a record |
| `create_note` | Create a note |
| `list_tasks` | List tasks |
| `create_task` | Create a task |
| `update_task` | Update a task |
| `delete_task` | Delete a task |
| `list_webhooks` | List webhooks |

```lua
local notes = app.integrations.attio.list_notes({
  parent_object = "people",
  parent_record_id = "891dcbfc-9141-415d-9b2a-2238a6cc012d"
})

local task = app.integrations.attio.create_task({
  content_plaintext = "Follow up",
  deadline_at = "2026-05-15",
  linked_records = {
    {
      target_object_id = "people",
      target_record_id = "891dcbfc-9141-415d-9b2a-2238a6cc012d"
    }
  }
})
```

## Account Context

`list_workspaces` and `get_current_user` help confirm which Attio account and workspace the token can access.

If multiple Attio accounts are configured, use account-specific namespaces:

```lua
local result = app.integrations.attio.accounts.sales.list_records({
  object_id = "companies"
})
```

## Safety Notes

- Use fake examples such as `example.test` in generated docs and tests.
- Record, entry, and task deletes are destructive.
- Attio create/update payloads usually wrap fields under `data`; first-class tools do that wrapping when you pass first-class parameters.
