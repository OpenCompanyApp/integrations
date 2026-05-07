# Affinity Lua API Reference

Namespace: `app.integrations.affinity`

This integration targets Affinity API v2. List tools usually accept `cursor`,
`limit`, `fieldIds`, `fieldTypes`, or a `params` object. Write tools accept a
`payload` object.

## Common Patterns

List persons:

```lua
local result = app.integrations.affinity.list_contacts({
  limit = 100
})
```

Get company field values:

```lua
local result = app.integrations.affinity.list_organization_field_values({
  company_id = "company_test",
  fieldTypes = "global,relationship-intelligence"
})
```

Update a list-entry field:

```lua
local result = app.integrations.affinity.update_list_entry_field({
  list_id = "list_test",
  list_entry_id = "entry_test",
  field_id = "field_test",
  value = "Qualified"
})
```

Semantic search:

```lua
local result = app.integrations.affinity.semantic_search({
  payload = {
    ["entity-type"] = "person",
    query = "founders in fintech"
  }
})
```

## Coverage

Tools include persons, companies, opportunities, lists, list entries, saved
views, notes, calls, emails, meetings, chat messages, transcripts, semantic
search, and raw API helpers.

## Raw API Helpers

```lua
local result = app.integrations.affinity.api_get({
  path = "/persons",
  params = {
    limit = 50
  }
})
```

The `path` must be relative. `/persons` is normalized to `/v2/persons`; pass an
explicit `/v1/...` path for documented legacy endpoints.
