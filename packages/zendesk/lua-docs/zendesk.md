# HTTP client for the Zendesk REST API v2 — Lua API Reference

## zendesk_add_tags

Add tags to a Zendesk ticket. These tags are appended to the existing tags on the ticket..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID to add tags to. |
| `tags` | array | yes | Array of tag strings to add. Example: [ |

### Example

```lua
local result = app.integrations.zendesk.zendesk_add_tags({
  ticket_id = 0
  tags = {}
})
```

## zendesk_apply_macro

Apply a macro to a Zendesk ticket. The macro actions will be applied to the ticket..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID to apply the macro to. |
| `macro_id` | integer | yes | The macro ID to apply. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_apply_macro({
  ticket_id = 0
  macro_id = 0
})
```

## zendesk_create_article

Create a new Help Center article in a specified section. Requires section_id, title, and body..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `section_id` | integer | yes | The ID of the section to create the article in. |
| `title` | string | yes | The title of the article. |
| `body` | string | yes | The HTML body content of the article. |
| `locale` | string | no | The locale of the article (e.g.  |
| `draft` | boolean | no | Whether the article should be created as a draft. Default: false. |
| `labels` | array | no | Array of label strings. Example: [ |

### Example

```lua
local result = app.integrations.zendesk.zendesk_create_article({
  section_id = 0
  title = ""
  body = ""
})
```

## zendesk_create_ticket

Create a new Zendesk ticket. Requires subject and description. Optionally set priority, type, tags, custom fields, requester, group, and assignee..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | The subject of the ticket. |
| `description` | string | yes | The initial comment/description of the ticket. |
| `requester_email` | string | no | Email address of the ticket requester. |
| `requester_name` | string | no | Name of the ticket requester. |
| `priority` | string | no | Priority of the ticket (urgent, high, normal, low). |
| `type` | string | no | Type of the ticket (problem, incident, question, task). |
| `tags` | array | no | Array of tag strings. Example: [ |
| `custom_fields` | array | no | Array of custom field objects with id and value. Example: [{ |
| `group_id` | integer | no | The ID of the group to assign the ticket to. |
| `assignee_id` | integer | no | The ID of the agent to assign the ticket to. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_create_ticket({
  subject = ""
  description = ""
  requester_email = ""
})
```

## zendesk_create_user

Create a new Zendesk user. Requires name and email. Optionally set role and phone..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The full name of the user. |
| `email` | string | yes | The email address of the user. |
| `role` | string | no | The role of the user (end-user, agent, admin). Default: end-user. |
| `phone` | string | no | The phone number of the user. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_create_user({
  name = ""
  email = ""
  role = ""
})
```

## zendesk_delete_ticket

Delete a Zendesk ticket by its ID. This action is irreversible..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ticket ID to delete. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_delete_ticket({
  id = 0
})
```

## zendesk_get_article

Get a specific Help Center article by its ID. Returns title, body, section, author, and metadata..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The article ID. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_get_article({
  id = 0
})
```

## zendesk_get_ticket

Get details for a specific Zendesk ticket by its ID. Returns subject, description, status, priority, assignee, and all fields..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ticket ID. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_get_ticket({
  id = 0
})
```

## zendesk_get_user

Get details for a specific Zendesk user by their ID. Returns name, email, role, and other profile information..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The user ID. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_get_user({
  id = 0
})
```

## zendesk_list_groups

List all Zendesk groups. Returns group IDs, names, and descriptions..

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_groups({
})
```

## zendesk_list_macros

List all available Zendesk macros. Returns macro IDs, titles, descriptions, and availability..

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_macros({
})
```

## zendesk_list_sections

List all Help Center sections. Returns section IDs, names, descriptions, and category associations..

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_sections({
})
```

## zendesk_list_ticket_comments

List all comments on a Zendesk ticket. Returns comment body, author, created date, and attachments..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID to list comments for. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_ticket_comments({
  ticket_id = 0
})
```

## zendesk_list_ticket_fields

List all custom and system ticket fields in Zendesk. Returns field IDs, titles, types, and options..

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_ticket_fields({
})
```

## zendesk_list_tickets

List Zendesk tickets with optional pagination and sorting. Returns ticket IDs, subjects, statuses, and basic info..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of tickets per page (1-100). Default: 25. |
| `page` | integer | no | Page number for offset pagination. |
| `sort_by` | string | no | Field to sort by (updated_at, created_at, priority, status, subject). |
| `sort_order` | string | no | Sort order (asc, desc). Default: desc. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_tickets({
  per_page = 0
  page = 0
  sort_by = ""
})
```

## zendesk_list_users

List Zendesk users with optional role filtering and pagination. Returns user IDs, names, emails, and roles..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `role` | string | no | Filter by role (end-user, agent, admin). |
| `per_page` | integer | no | Number of users per page. Default: 100. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_list_users({
  role = ""
  per_page = 0
  page = 0
})
```

## zendesk_search_articles

Search Zendesk Help Center articles by query. Optionally filter by section or category..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The search query string. |
| `section` | integer | no | Filter results to a specific section ID. |
| `category` | integer | no | Filter results to a specific category ID. |
| `per_page` | integer | no | Number of results per page. Default: 25. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_search_articles({
  query = ""
  section = 0
  category = 0
})
```

## zendesk_search_tickets

Search Zendesk tickets using query syntax. Examples:.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query using Zendesk query syntax. Example:  |
| `per_page` | integer | no | Number of results per page. Default: 25. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_search_tickets({
  query = ""
  per_page = 0
  page = 0
})
```

## zendesk_set_tags

Set tags on a Zendesk ticket. This replaces all existing tags on the ticket with the provided tags..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID to set tags on. |
| `tags` | array | yes | Array of tag strings to set (replaces all existing). Example: [ |

### Example

```lua
local result = app.integrations.zendesk.zendesk_set_tags({
  ticket_id = 0
  tags = {}
})
```

## zendesk_update_ticket

Update an existing Zendesk ticket. Can modify subject, priority, status, type, tags, custom fields, assignee, and group..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ticket ID to update. |
| `subject` | string | no | Updated subject of the ticket. |
| `priority` | string | no | Updated priority (urgent, high, normal, low). |
| `status` | string | no | Updated status (new, open, pending, hold, solved, closed). |
| `type` | string | no | Updated type (problem, incident, question, task). |
| `tags` | array | no | Array of tag strings to replace existing tags. |
| `custom_fields` | array | no | Array of custom field objects with id and value. Example: [{ |
| `assignee_id` | integer | no | The ID of the agent to assign the ticket to. |
| `group_id` | integer | no | The ID of the group to assign the ticket to. |

### Example

```lua
local result = app.integrations.zendesk.zendesk_update_ticket({
  id = 0
  subject = ""
  priority = ""
})
```
