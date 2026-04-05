# Client for the Webflow v2 REST API covering sites, collections, items, webhooks, assets, and users — Lua API Reference

## webflow_create_item

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |
| `fields` | string | yes | Item field data as a JSON object. Keys should match the collection field slugs. |
| `is_draft` | boolean | no | Whether the item should be created as a draft (default false). |
| `is_archived` | boolean | no | Whether the item should be archived on creation (default false). |

### Example

```lua
local result = app.integrations.webflow.webflow_create_item({
  collection_id = ""
  fields = ""
  is_draft = true
})
```

## webflow_create_webhook

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |
| `trigger_type` | string | yes | The event trigger type (e.g. form_submission, site_publish, collection_item_created, collection_item_updated, collection_item_deleted). |
| `url` | string | yes | The callback URL to receive webhook payloads. |

### Example

```lua
local result = app.integrations.webflow.webflow_create_webhook({
  site_id = ""
  trigger_type = ""
  url = ""
})
```

## webflow_delete_item

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |
| `item_id` | string | yes | The ID of the item to delete. |

### Example

```lua
local result = app.integrations.webflow.webflow_delete_item({
  collection_id = ""
  item_id = ""
})
```

## webflow_delete_webhook

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |
| `webhook_id` | string | yes | The ID of the webhook to delete. |

### Example

```lua
local result = app.integrations.webflow.webflow_delete_webhook({
  site_id = ""
  webhook_id = ""
})
```

## webflow_get_collection

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |

### Example

```lua
local result = app.integrations.webflow.webflow_get_collection({
  collection_id = ""
})
```

## webflow_get_current_user

No description.

### Example

```lua
local result = app.integrations.webflow.webflow_get_current_user({
})
```

## webflow_get_item

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |
| `item_id` | string | yes | The ID of the item to retrieve. |

### Example

```lua
local result = app.integrations.webflow.webflow_get_item({
  collection_id = ""
  item_id = ""
})
```

## webflow_get_site

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |

### Example

```lua
local result = app.integrations.webflow.webflow_get_site({
  site_id = ""
})
```

## webflow_list_assets

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |

### Example

```lua
local result = app.integrations.webflow.webflow_list_assets({
  site_id = ""
})
```

## webflow_list_collections

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |

### Example

```lua
local result = app.integrations.webflow.webflow_list_collections({
  site_id = ""
})
```

## webflow_list_items

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |
| `limit` | integer | no | Maximum number of items to return (default 100). |
| `offset` | integer | no | Number of items to skip for pagination (default 0). |

### Example

```lua
local result = app.integrations.webflow.webflow_list_items({
  collection_id = ""
  limit = 0
  offset = 0
})
```

## webflow_list_sites

No description.

### Example

```lua
local result = app.integrations.webflow.webflow_list_sites({
})
```

## webflow_list_webhooks

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site. |

### Example

```lua
local result = app.integrations.webflow.webflow_list_webhooks({
  site_id = ""
})
```

## webflow_publish_site

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The ID of the Webflow site to publish. |

### Example

```lua
local result = app.integrations.webflow.webflow_publish_site({
  site_id = ""
})
```

## webflow_update_item

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The ID of the Webflow collection. |
| `item_id` | string | yes | The ID of the item to update. |
| `fields` | string | yes | Item field data to update as a JSON object. Keys should match the collection field slugs. |
| `is_draft` | boolean | no | Whether the item should be a draft (default false). |
| `is_archived` | boolean | no | Whether the item should be archived (default false). |

### Example

```lua
local result = app.integrations.webflow.webflow_update_item({
  collection_id = ""
  item_id = ""
  fields = ""
})
```

---

## Multi-Account Usage

If you have multiple webflow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.webflow.function_name({...})

-- Explicit default (portable across setups)
app.integrations.webflow.default.function_name({...})

-- Named accounts
app.integrations.webflow.work.function_name({...})
app.integrations.webflow.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
