# Client for the Intercom REST API covering conversations, contacts, and companies — Lua API Reference

## intercom_list_conversations

List Intercom conversations with pagination and sorting.
Returns conversation IDs, created dates, and state.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of conversations to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |
| `sort_order` | string | no | Sort order: "asc" or "desc". |
| `status` | string | no | Filter by conversation status: "open", "closed", or "all". |

### Example

```lua
local result = app.integrations.intercom.intercom_list_conversations({
  limit = 20
  starting_after = ""
  sort_order = "desc"
})
```

## intercom_get_conversation

Retrieve an Intercom conversation by its ID.
Returns the full conversation including message parts, contacts, and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Intercom conversation ID. |

### Example

```lua
local result = app.integrations.intercom.intercom_get_conversation({
  conversation_id = "12345"
})
```

## intercom_create_conversation

Create a new conversation in Intercom.
Requires a user_id (Intercom contact ID) and a message body.
Returns the created conversation with its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | Intercom contact ID (user) to create the conversation for. |
| `body` | string | yes | Initial message body for the conversation. |

### Example

```lua
local result = app.integrations.intercom.intercom_create_conversation({
  user_id = "67890"
  body = "Hello, I need help with my account."
})
```

## intercom_list_contacts

List Intercom contacts with pagination.
Returns contact IDs, emails, names, and roles.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.intercom.intercom_list_contacts({
  limit = 20
  starting_after = ""
})
```

## intercom_get_contact

Retrieve an Intercom contact by its ID.
Returns the contact's ID, email, name, phone, role, and custom attributes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID. |

### Example

```lua
local result = app.integrations.intercom.intercom_get_contact({
  contact_id = "67890"
})
```

## intercom_list_companies

List Intercom companies with pagination.
Returns company IDs, names, employee counts, and industry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of companies to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.intercom.intercom_list_companies({
  limit = 20
  starting_after = ""
})
```

## intercom_get_current_user

Retrieve the currently authenticated Intercom admin user.
Returns the admin's ID, name, email, and avatar.
Useful for identifying which workspace or token is in use.

### Example

```lua
local result = app.integrations.intercom.intercom_get_current_user({
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
