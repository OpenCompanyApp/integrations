# SendGrid — Lua API Reference

## sendgrid_send_email

Send an email through SendGrid. Supports HTML and plain-text content, CC, BCC,
reply-to, categories, and custom arguments for webhook tracking.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient email address |
| `from` | string | yes | Sender email address (must be a verified sender identity) |
| `subject` | string | yes | Email subject line |
| `html_content` | string | no | HTML body content |
| `plain_content` | string | no | Plain-text body content |
| `reply_to` | string | no | Reply-to email address |
| `cc` | array | no | CC recipient email addresses |
| `bcc` | array | no | BCC recipient email addresses |
| `categories` | array | no | Categories to attach to the email for analytics |
| `custom_args` | object | no | Custom arguments for event webhooks (key-value pairs) |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_send_email({
  to = "customer@example.com",
  from = "noreply@mycompany.com",
  subject = "Welcome!",
  html_content = "<h1>Hello!</h1><p>Thanks for signing up.</p>",
  categories = {"transactional", "welcome"},
  custom_args = { order_id = "12345" }
})
```

## sendgrid_list_contacts

List marketing contacts from SendGrid. Returns contact records with IDs, emails,
names, and custom fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 100) |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_list_contacts({
  limit = 50
})
```

## sendgrid_add_contact

Add a new contact or update an existing one in SendGrid. Uses a PUT upsert based
on the email address. Optionally set first name, last name, custom fields, and
assign the contact to one or more marketing lists.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address |
| `first_name` | string | no | The contact's first name |
| `last_name` | string | no | The contact's last name |
| `custom_fields` | object | no | Custom field values (key-value pairs) |
| `list_ids` | array | no | List IDs to add the contact to |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_add_contact({
  email = "jane@example.com",
  first_name = "Jane",
  last_name = "Doe",
  custom_fields = { company = "Acme" },
  list_ids = { "abc123", "def456" }
})
```

## sendgrid_search_contacts

Search SendGrid marketing contacts using a query string.
Example queries: `"email LIKE '%@example.com'"` or `"first_name = 'John'"`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query expression (e.g., `"email LIKE '%@example.com'"`) |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_search_contacts({
  query = "email LIKE '%@example.com'"
})
```

## sendgrid_delete_contact

Delete one or more contacts from SendGrid by providing their contact IDs.
This action is permanent and cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ids` | array | yes | Array of contact IDs to delete |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_delete_contact({
  ids = { "contact-id-1", "contact-id-2" }
})
```

## sendgrid_get_contact_by_email

Look up a SendGrid marketing contact by their email address.
Returns the contact record if found, including ID, name, and custom fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address to look up |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_get_contact_by_email({
  email = "jane@example.com"
})
```

## sendgrid_list_lists

List all marketing lists in the connected SendGrid account.
Returns each list's ID, name, and contact count.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of lists to return (default: 100) |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_list_lists({
  limit = 50
})
```

## sendgrid_create_list

Create a new marketing list in SendGrid. Returns the created list with its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new list |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_create_list({
  name = "Newsletter Subscribers"
})
```

## sendgrid_add_contact_to_list

Add one or more existing contacts to a SendGrid marketing list.
Provide the list ID and an array of contact IDs to add.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The marketing list ID |
| `contact_ids` | array | yes | Array of contact IDs to add to the list |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_add_contact_to_list({
  list_id = "abc123",
  contact_ids = { "contact-id-1", "contact-id-2" }
})
```

## sendgrid_remove_contact_from_list

Remove one or more contacts from a SendGrid marketing list.
The contacts are removed from the list but not deleted from SendGrid.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The marketing list ID |
| `contact_ids` | array | yes | Array of contact IDs to remove from the list |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_remove_contact_from_list({
  list_id = "abc123",
  contact_ids = { "contact-id-1" }
})
```

## sendgrid_list_sender_identities

List all verified sender identities in the connected SendGrid account.
Returns each sender's ID, nickname, email address, and verification status.

### Parameters

_None_

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_list_sender_identities({})
```

## sendgrid_get_email_stats

Get email delivery statistics from SendGrid. Returns metrics such as delivers,
opens, clicks, bounces, and spam reports. Requires a start_date, optionally
filtered by end_date and aggregated by day, week, or month.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | yes | Start date for the stats range in YYYY-MM-DD format |
| `end_date` | string | no | End date for the stats range in YYYY-MM-DD format |
| `aggregated_by` | string | no | Aggregation period: `"day"`, `"week"`, or `"month"` |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_get_email_stats({
  start_date = "2026-01-01",
  end_date = "2026-01-31",
  aggregated_by = "day"
})
```

## sendgrid_list_suppressions

List bounce suppressions (bounced email addresses) from SendGrid.
Optionally filter by start and end time (Unix timestamps) and limit results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_time` | integer | no | Start time as a Unix timestamp |
| `end_time` | integer | no | End time as a Unix timestamp |
| `limit` | integer | no | Maximum number of suppressions to return |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_list_suppressions({
  start_time = 1735689600,
  end_time = 1738368000,
  limit = 50
})
```

## sendgrid_add_suppression

Add one or more email addresses to the SendGrid suppression list.
Suppressed emails will not receive future emails from your account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `emails` | array | yes | Array of email addresses to suppress |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_add_suppression({
  emails = { "bounce@example.com", "unsubscribed@example.com" }
})
```

## sendgrid_get_templates

List email templates in the connected SendGrid account.
Returns each template's ID, name, type, and versions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of templates to return (default: 100) |

### Example

```lua
local result = app.integrations.sendgrid.sendgrid_get_templates({
  limit = 50
})
```
