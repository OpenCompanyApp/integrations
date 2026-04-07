# Client for the Airtable REST API — Lua API Reference

## airtable_list_bases

List all Airtable bases the token has access to.

### Example

```lua
local result = app.integrations.airtable.airtable_list_bases({})
```

### Response

Returns an object with a `bases` array, each containing `id`, `name`, `permissionLevel`, and other base metadata.

---

## airtable_get_base

Get details for a single Airtable base by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g., `"appXXXXXXXXXXXX"`). |

### Example

```lua
local result = app.integrations.airtable.airtable_get_base({
  base_id = "appXXXXXXXXXXXX"
})
```

### Response

Returns the base object with `id`, `name`, `permissionLevel`, and other metadata.

---

## airtable_list_records

List records from an Airtable table with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g., `"appXXXXXXXXXXXX"`). |
| `table` | string | yes | Table ID or name. |
| `view` | string | no | View name or ID to filter records by the view's filters. |
| `filter_by_formula` | string | no | Airtable formula expression to filter records (e.g., `"{Status} = 'Done'"`). |
| `max_records` | integer | no | Maximum number of records to return. |
| `offset` | string | no | Pagination offset from a previous response. |
| `fields` | string | no | Comma-separated list of field names to return. |
| `sort` | string | no | JSON array of sort objects, e.g. `[{"field":"Name","direction":"asc"}]`. |

### Example

```lua
local result = app.integrations.airtable.airtable_list_records({
  base_id = "appXXXXXXXXXXXX",
  table = "Contacts",
  filter_by_formula = "{Status} = 'Active'",
  max_records = 100
})
```

### Response

Returns an object with `records` array and optional `offset` for pagination.

---

## airtable_get_record

Get a single Airtable record by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g., `"appXXXXXXXXXXXX"`). |
| `table` | string | yes | Table ID or name. |
| `record_id` | string | yes | Record ID (e.g., `"recXXXXXXXXXXXX"`). |

### Example

```lua
local result = app.integrations.airtable.airtable_get_record({
  base_id = "appXXXXXXXXXXXX",
  table = "Contacts",
  record_id = "recXXXXXXXXXXXX"
})
```

### Response

Returns the record object with `id`, `createdTime`, and `fields`.

---

## airtable_create_record

Create a new record in an Airtable table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g., `"appXXXXXXXXXXXX"`). |
| `table` | string | yes | Table ID or name. |
| `fields` | string | yes | JSON object of field name → value pairs (e.g., `{"Name":"John","Age":30}`). |

### Example

```lua
local result = app.integrations.airtable.airtable_create_record({
  base_id = "appXXXXXXXXXXXX",
  table = "Contacts",
  fields = '{"Name":"John Doe","Email":"john@example.com","Age":30}'
})
```

### Response

Returns the created record object with `id`, `createdTime`, and `fields`.

---

## airtable_list_views

List views for an Airtable base.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g., `"appXXXXXXXXXXXX"`). |

### Example

```lua
local result = app.integrations.airtable.airtable_list_views({
  base_id = "appXXXXXXXXXXXX"
})
```

### Response

Returns the views available in the base.

---

## airtable_get_current_user

Get the profile of the currently authenticated Airtable user. Useful for verifying credentials and displaying account information.

### Example

```lua
local result = app.integrations.airtable.airtable_get_current_user({})
```

### Response

Returns the authenticated user object with `id`, `name`, `email`, and other profile fields.

---

## Multi-Account Usage

If you have multiple Airtable accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.airtable.airtable_list_bases({})

-- Explicit default (portable across setups)
app.integrations.airtable.default.airtable_list_bases({})

-- Named accounts
app.integrations.airtable.work.airtable_list_bases({})
app.integrations.airtable.personal.airtable_list_bases({})
```

All functions are identical across accounts — only the credentials differ.
