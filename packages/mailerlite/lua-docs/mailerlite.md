# Mailerlite — Lua API Reference

## mailerlite_add_subscriber_to_group

Add a subscriber to a MailerLite group by providing the group ID and subscriber email..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `group_id` | string | yes | The group ID to add the subscriber to. |
| `email` | string | yes | Subscriber email address. |
| `name` | string | no | Subscriber name (used if creating a new subscriber). |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_add_subscriber_to_group({
  group_id = ""
  email = ""
  name = ""
})
```

## mailerlite_create_subscriber

Add a new subscriber to MailerLite. Provide an email address and optionally a name and custom fields..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Subscriber email address. |
| `name` | string | no | Subscriber name. |
| `fields` | string | no | Custom fields as key-value pairs (e.g., { |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_create_subscriber({
  email = ""
  name = ""
  fields = ""
})
```

## mailerlite_delete_subscriber

Delete a subscriber from MailerLite by their ID. This action is permanent..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscriber ID to delete. |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_delete_subscriber({
  id = ""
})
```

## mailerlite_get_current_user

Get the currently authenticated MailerLite account information. Useful for verifying API credentials..

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_get_current_user({
})
```

## mailerlite_get_subscriber

Get details for a single MailerLite subscriber by their ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscriber ID. |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_get_subscriber({
  id = ""
})
```

## mailerlite_list_groups

List subscriber groups (segments) from MailerLite. Supports pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1). |
| `limit` | integer | no | Number of groups per page (default: 25). |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_list_groups({
  page = 0
  limit = 0
})
```

## mailerlite_list_subscribers

List subscribers from MailerLite. Supports pagination and filtering by status (active, unsubscribed, etc.)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1). |
| `limit` | integer | no | Number of subscribers per page (default: 25, max: 100). |
| `status` | string | no | Filter by status: active, unsubscribed, unconfirmed, bounced, junk. |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_list_subscribers({
  page = 0
  limit = 0
  status = ""
})
```

## mailerlite_update_subscriber

Update an existing subscriber in MailerLite. Provide the subscriber ID and fields to update..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscriber ID. |
| `name` | string | no | Updated subscriber name. |
| `fields` | string | no | Updated custom fields as key-value pairs. |

### Example

```lua
local result = app.integrations.mailerlite.mailerlite_update_subscriber({
  id = ""
  name = ""
  fields = ""
})
```
