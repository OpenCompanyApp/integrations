# Client for the Intercom REST API covering contacts, conversations, admins, tags, notes, and companies — Lua API Reference

## intercom_create_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | no | Contact email address. |
| `name` | string | no | Contact full name. |
| `phone` | string | no | Contact phone number. |
| `role` | string | no | Contact role:  |
| `custom_attributes` | string | no | Custom attributes as key-value pairs. |

### Example

```lua
local result = app.integrations.intercom.intercom_create_contact({
  email = ""
  name = ""
  phone = ""
})
```

## intercom_create_conversation

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | Intercom contact ID (user) to create the conversation for. |
| `body` | string | yes | Initial message body for the conversation. |

### Example

```lua
local result = app.integrations.intercom.intercom_create_conversation({
  user_id = ""
  body = ""
})
```

## intercom_create_note

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID to attach the note to. |
| `body` | string | yes | Note body text. |

### Example

```lua
local result = app.integrations.intercom.intercom_create_note({
  contact_id = ""
  body = ""
})
```

## intercom_delete_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID to delete. |

### Example

```lua
local result = app.integrations.intercom.intercom_delete_contact({
  contact_id = ""
})
```

## intercom_get_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID. |

### Example

```lua
local result = app.integrations.intercom.intercom_get_contact({
  contact_id = ""
})
```

## intercom_get_conversation

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Intercom conversation ID. |

### Example

```lua
local result = app.integrations.intercom.intercom_get_conversation({
  conversation_id = ""
})
```

## intercom_list_admins

No description.

### Example

```lua
local result = app.integrations.intercom.intercom_list_admins({
})
```

## intercom_list_companies

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of companies to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.intercom.intercom_list_companies({
  limit = 0
  starting_after = ""
})
```

## intercom_list_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.intercom.intercom_list_contacts({
  limit = 0
  starting_after = ""
})
```

## intercom_list_conversations

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of conversations to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |
| `sort_order` | string | no | Sort order:  |

### Example

```lua
local result = app.integrations.intercom.intercom_list_conversations({
  limit = 0
  starting_after = ""
  sort_order = ""
})
```

## intercom_list_tags

No description.

### Example

```lua
local result = app.integrations.intercom.intercom_list_tags({
})
```

## intercom_reply_conversation

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Intercom conversation ID. |
| `message_type` | string | yes | Type of reply:  |
| `body` | string | yes | Reply message body. |
| `admin_id` | string | no | Intercom admin ID (required for admin replies). |

### Example

```lua
local result = app.integrations.intercom.intercom_reply_conversation({
  conversation_id = ""
  message_type = ""
  body = ""
})
```

## intercom_search_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | array | yes | Search query with operator and value array. Example: { |
| `pagination_limit` | integer | no | Maximum number of results to return (default 20). |
| `pagination_after` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.intercom.intercom_search_contacts({
  query = {}
  pagination_limit = 0
  pagination_after = ""
})
```

## intercom_tag_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Tag name to apply. |
| `contact_ids` | array | yes | Array of Intercom contact IDs to tag. |

### Example

```lua
local result = app.integrations.intercom.intercom_tag_contacts({
  name = ""
  contact_ids = {}
})
```

## intercom_update_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID to update. |
| `name` | string | no | Updated contact name. |
| `email` | string | no | Updated contact email. |
| `phone` | string | no | Updated contact phone number. |
| `custom_attributes` | string | no | Custom attributes to update as key-value pairs. |

### Example

```lua
local result = app.integrations.intercom.intercom_update_contact({
  contact_id = ""
  name = ""
  email = ""
})
```

---

## Multi-Account Usage

If you have multiple intercom accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.intercom.function_name({...})

-- Explicit default (portable across setups)
app.integrations.intercom.default.function_name({...})

-- Named accounts
app.integrations.intercom.work.function_name({...})
app.integrations.intercom.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
