# Wufoo Lua Reference

Namespace: `wufoo`

Wufoo exposes form, entry, report, user, comment, and webhook resources through
API v3. Configure an API key and a subdomain-specific base URL such as
`https://example.wufoo.com/api/v3`. The integration authenticates with HTTP
Basic auth using the API key as the username and `footastic` as the password.

## Forms and Fields

```lua
local forms = app.integrations.wufoo.list_forms({})

local form = app.integrations.wufoo.get_form({
  form_id = "z1abc234"
})

local fields = app.integrations.wufoo.list_fields({
  form_id = "z1abc234"
})
```

Use `list_fields` before `submit_entry` so agents can use the correct Wufoo
field API IDs such as `Field1` or `Field2`.

## Entries

```lua
local entries = app.integrations.wufoo.list_entries({
  form_id = "z1abc234",
  page = 0,
  page_size = 25,
  filters = {
    Filter1 = "Field1+Is_equal_to+Example",
    SortBy = "DateCreated",
    SortDirection = "DESC"
  }
})

local count = app.integrations.wufoo.count_entries({
  form_id = "z1abc234"
})

local entry = app.integrations.wufoo.get_entry({
  form_id = "z1abc234",
  entry_id = "123"
})

local created = app.integrations.wufoo.submit_entry({
  form_id = "z1abc234",
  fields = {
    Field1 = "Example Person",
    Field2 = "person@example.test"
  }
})
```

Wufoo API v3 lists entries under forms. `get_entry` therefore uses the form
entries endpoint with an `EntryId` filter and returns the filtered entries
response.

`submit_entry` sends form-encoded fields because Wufoo expects form-style entry
submissions. Returned data is the parsed Wufoo response, with submission errors
reported as tool errors.

## Comments

```lua
local comments = app.integrations.wufoo.list_form_comments({
  form_id = "z1abc234",
  params = { entryId = "123" }
})

local comment_count = app.integrations.wufoo.count_form_comments({
  form_id = "z1abc234"
})
```

## Reports

```lua
local reports = app.integrations.wufoo.list_reports({})

local report = app.integrations.wufoo.get_report({
  report_id = "r1abc234"
})

local report_entries = app.integrations.wufoo.list_report_entries({
  report_id = "r1abc234",
  params = { pageSize = 10 }
})

local report_count = app.integrations.wufoo.count_report_entries({
  report_id = "r1abc234"
})

local report_fields = app.integrations.wufoo.list_report_fields({
  report_id = "r1abc234"
})

local widgets = app.integrations.wufoo.list_report_widgets({
  report_id = "r1abc234"
})
```

Report IDs can be hashes or title identifiers accepted by the Wufoo API.

## Users

```lua
local users = app.integrations.wufoo.list_users({})
local current = app.integrations.wufoo.get_current_user({})
```

`get_current_user` is retained as a compatibility alias for the users endpoint;
Wufoo's API returns a `Users` collection.

## Webhooks

```lua
local webhook = app.integrations.wufoo.add_webhook({
  form_id = "z1abc234",
  url = "https://example.test/wufoo",
  handshake_key = "shared-secret",
  metadata = true
})

local deleted = app.integrations.wufoo.delete_webhook({
  form_id = "z1abc234",
  webhook_id = "webhookhash"
})
```

Webhook creation is a write operation and should be used carefully because Wufoo
limits integrations per form.

## Generic API

Use generic helpers for official Wufoo API v3 endpoints that do not yet have a
dedicated wrapper.

```lua
local raw = app.integrations.wufoo.api_get({
  path = "/forms/z1abc234/fields.json",
  params = { system = "true" }
})

local posted = app.integrations.wufoo.api_post({
  path = "/forms/z1abc234/entries.json",
  body = { Field1 = "Example" }
})
```

Available generic tools: `api_get`, `api_post`, `api_put`, and `api_delete`.
POST and PUT bodies are submitted as form-encoded data.
