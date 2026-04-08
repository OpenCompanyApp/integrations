# Client for the Mailchimp Marketing API covering audiences, subscribers, campaigns, segments, and reports — Lua API Reference

## mailchimp_add_subscriber

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID to add the subscriber to. |
| `email` | string | yes | The subscriber\ |
| `status` | string | no | Subscription status: subscribed, unsubscribed, cleaned, or pending. |
| `merge_fields` | string | no | Merge field values (e.g. { |
| `tags` | array | no | Tag names to apply to the subscriber. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_add_subscriber({
  list_id = ""
  email = ""
  status = ""
})
```

## mailchimp_add_to_segment

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `segment_id` | string | yes | The segment ID to add the subscriber to. |
| `email` | string | yes | The subscriber\ |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_add_to_segment({
  list_id = ""
  segment_id = ""
  email = ""
})
```

## mailchimp_create_audience

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the audience. |
| `contact` | string | yes | Contact information for the audience (company, address1, city, state, zip, country). |
| `address1` | string | no | Street address. |
| `city` | string | no | City. |
| `state` | string | no | State or province. |
| `zip` | string | no | Postal / ZIP code. |
| `country` | string | no | Country code (e.g. US). |
| `permission_reminder` | string | yes | Permission reminder text explaining why the subscriber is on this list. |
| `email_type_option` | boolean | no | Whether to allow subscribers to choose HTML or plain-text email. |
| `campaign_defaults` | string | yes | Default values for campaigns created from this audience. |
| `from_email` | string | no | Default  |
| `subject` | string | no | Default email subject. |
| `language` | string | no | Default language code (e.g. en). |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_create_audience({
  name = ""
  contact = ""
  address1 = ""
})
```

## mailchimp_create_campaign

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Campaign type: regular, plaintext, absplit, rss, or variate. |
| `list_id` | string | yes | The audience (list) ID to send the campaign to. |
| `settings_subject` | string | no | The email subject line. |
| `settings_title` | string | no | Internal campaign title (visible in Mailchimp dashboard only). |
| `settings_from_name` | string | no | The  |
| `settings_reply_to` | string | no | The reply-to email address. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_create_campaign({
  type = ""
  list_id = ""
  settings_subject = ""
})
```

## mailchimp_get_audience

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The audience (list) ID. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_get_audience({
  id = ""
})
```

## mailchimp_get_campaign

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The campaign ID. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_get_campaign({
  id = ""
})
```

## mailchimp_get_campaign_report

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The campaign ID. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_get_campaign_report({
  id = ""
})
```

## mailchimp_get_current_user

No description.

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_get_current_user({
})
```

## mailchimp_get_subscriber

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `email` | string | yes | The subscriber\ |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_get_subscriber({
  list_id = ""
  email = ""
})
```

## mailchimp_list_audiences

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of audiences to return (max 1000). |
| `offset` | integer | no | Number of audiences to skip for pagination. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_list_audiences({
  count = 0
  offset = 0
})
```

## mailchimp_list_campaigns

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of campaigns to return. |
| `offset` | integer | no | Number of campaigns to skip for pagination. |
| `status` | string | no | Filter by campaign status. |
| `type` | string | no | Filter by campaign type. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_list_campaigns({
  count = 0
  offset = 0
  status = ""
})
```

## mailchimp_list_segments

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `count` | integer | no | Number of segments to return. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_list_segments({
  list_id = ""
  count = 0
})
```

## mailchimp_remove_subscriber

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `email` | string | yes | The subscriber\ |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_remove_subscriber({
  list_id = ""
  email = ""
})
```

## mailchimp_search_subscribers

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query — email address, name, or other subscriber data. |
| `list_id` | string | no | Optional audience (list) ID to scope the search. |
| `count` | integer | no | Number of results to return. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_search_subscribers({
  query = ""
  list_id = ""
  count = 0
})
```

## mailchimp_send_campaign

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The campaign ID to send. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_send_campaign({
  id = ""
})
```

## mailchimp_tag_subscriber

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `email` | string | yes | The subscriber\ |
| `tags` | array | yes | Array of tag objects, each with  |
| `status` | string | no |  |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_tag_subscriber({
  list_id = ""
  email = ""
  tags = {}
})
```

## mailchimp_update_campaign

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The campaign ID. |
| `settings` | string | yes | Campaign settings to update (e.g. subject_line, title, from_name, reply_to). |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_update_campaign({
  id = ""
  settings = ""
})
```

## mailchimp_update_subscriber

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The audience (list) ID. |
| `email` | string | yes | The subscriber\ |
| `merge_fields` | string | no | Merge field values to update (e.g. { |
| `status` | string | no | New subscription status: subscribed, unsubscribed, cleaned, or pending. |

### Example

```lua
local result = app.integrations.mailchimp.mailchimp_update_subscriber({
  list_id = ""
  email = ""
  merge_fields = ""
})
```

---

## Multi-Account Usage

If you have multiple mailchimp accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mailchimp.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mailchimp.default.function_name({...})

-- Named accounts
app.integrations.mailchimp.work.function_name({...})
app.integrations.mailchimp.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
