# Client for the Phrase localization platform — Lua API Reference

## phrase_list_projects

List all Phrase projects the authenticated user has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of projects per page (default 25, max 100). |

### Example

```lua
local result = app.integrations.phrase.phrase_list_projects({
  page = 1
  per_page = 25
})
```

## phrase_get_project

Get details of a single Phrase project including name, slug, main format, and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID of the project to retrieve. |

### Example

```lua
local result = app.integrations.phrase.phrase_get_project({
  project_id = ""
})
```

## phrase_list_keys

List translation keys in a Phrase project. Optionally filter by name and control pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID. |
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of keys per page (default 25, max 100). |
| `q` | string | no | Search query to filter keys by name. |

### Example

```lua
local result = app.integrations.phrase.phrase_list_keys({
  project_id = ""
  page = 1
  per_page = 25
  q = ""
})
```

## phrase_get_key

Get a single translation key by ID, including name, description, tags, and plural settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID. |
| `key_id` | string | yes | The key ID. |

### Example

```lua
local result = app.integrations.phrase.phrase_get_key({
  project_id = ""
  key_id = ""
})
```

## phrase_list_translations

List translations in a Phrase project. Optionally filter by key or locale.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID. |
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of translations per page (default 25, max 100). |
| `key_id` | string | no | Filter translations by key ID. |
| `locale_id` | string | no | Filter translations by locale ID. |
| `q` | string | no | Search query to filter translations. |

### Example

```lua
local result = app.integrations.phrase.phrase_list_translations({
  project_id = ""
  page = 1
  per_page = 25
  key_id = ""
  locale_id = ""
  q = ""
})
```

## phrase_list_locales

List locales in a Phrase project. Returns locale IDs, codes, names, and default status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID. |
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of locales per page (default 25, max 100). |

### Example

```lua
local result = app.integrations.phrase.phrase_list_locales({
  project_id = ""
  page = 1
  per_page = 25
})
```

## phrase_get_current_user

Get the current authenticated Phrase user's profile, including username, name, and email.

### Example

```lua
local result = app.integrations.phrase.phrase_get_current_user({
})
```

---

## Multi-Account Usage

If you have multiple phrase accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.phrase.function_name({...})

-- Explicit default (portable across setups)
app.integrations.phrase.default.function_name({...})

-- Named accounts
app.integrations.phrase.work.function_name({...})
app.integrations.phrase.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
